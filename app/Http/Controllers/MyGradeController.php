<?php

namespace App\Http\Controllers;

use App\Models\CourseClass;
use App\Models\StudentGrade;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MyGradeController extends Controller
{
    public function index(){
        $user = User::findOrfail(Auth::user()->id);
        $allGradesForCurrentUser = StudentGrade::select('assignments.course_class_id', 'assignments.id',
            DB::raw('SUM(criteria_levels.point) as point'))
            ->join('student_grade_details', 'student_grade_details.student_grade_id', '=', 'student_grades.id')
            ->join('assignments', 'student_grades.assignment_id', '=', 'assignments.id')
            ->join('criteria_levels', 'student_grade_details.criteria_level_id', '=', 'criteria_levels.id')
            ->groupBy('assignments.course_class_id', 'assignments.id')
            ->where('student_user_id', $user->id)
            ->get();

        // Get total max points per class by summing max_point per assignment plan task
        // (joining through student_grades ensures we only count graded assignments)
        $allMaxPointsForCurrentUser = StudentGrade::select('assignments.course_class_id',
            DB::raw('SUM(criterias.max_point) as max_point'))
            ->join('assignments', 'student_grades.assignment_id', '=', 'assignments.id')
            ->join('assignment_plans', 'assignments.assignment_plan_id', '=', 'assignment_plans.id')
            ->join('assignment_plan_tasks', 'assignment_plan_tasks.assignment_plan_id', '=', 'assignment_plans.id')
            ->join('criterias', 'criterias.id', '=', 'assignment_plan_tasks.criteria_id')
            ->groupBy('assignments.course_class_id')
            ->where('student_user_id', $user->id)
            ->get();

        $userClasses = $user->joinedClasses()->get();
        $overallCollected = 0;
        $overallMax = 0;

        foreach ($userClasses as $userClass){
            $courseAssignmentGrades = $allGradesForCurrentUser->filter(function ($grade) use ($userClass) {
                return $grade->course_class_id == $userClass->id;
            });
            $gradedAssignmentCount = $courseAssignmentGrades->count();
            $totalAssignmentCount = $userClass->assignments()->count();
            $userClass->gradingProgress = $totalAssignmentCount > 0
                ? round($gradedAssignmentCount / $totalAssignmentCount * 100, 2)
                : 0;

            $totalCollected = $courseAssignmentGrades->sum('point');
            $maxPointRecord = $allMaxPointsForCurrentUser->firstWhere('course_class_id', $userClass->id);
            $totalMax = $maxPointRecord ? $maxPointRecord->max_point : 0;
            $userClass->grade = $totalMax > 0 ? round($totalCollected / $totalMax * 100, 2) : 0;
            $userClass->letterGrade = $this->_getLetterGrade($userClass->grade);

            $overallCollected += $totalCollected;
            $overallMax += $totalMax;
        }

        $overallGrade = $overallMax > 0 ? round($overallCollected / $overallMax * 100, 2) : 0;
        $overallLetterGrade = $this->_getLetterGrade($overallGrade);

        return view('mygrade.index', compact('userClasses', 'overallGrade', 'overallLetterGrade'));
    }

    public function show(CourseClass $courseClass){

        $courseClass->load('assignments.assignmentPlan.assignmentPlanTasks.criteria.lessonLearningOutcome.courseLearningOutcome');

        $studentGrades = StudentGrade::where('student_user_id', Auth::user()->id)
            ->whereHas('assignment', function ($query) use ($courseClass) {
                $query->where('course_class_id', $courseClass->id);
            })
            ->with(['assignment' => function ($query) use ($courseClass) {
                $query->with('assignmentPlan.assignmentPlanTasks.criteria')
                    ->where('course_class_id', $courseClass->id);
            }])
            ->with('studentGradeDetails.criteriaLevel.criteria.lessonLearningOutcome.courseLearningOutcome')
            ->orderBy('assignment_id', 'asc')
            ->get();

        // Assignments Grades
        $assignmentGrades = $courseClass->assignments->map(function ($assignment) use ($studentGrades) {
            $studentGrade = $studentGrades->firstWhere('assignment_id', $assignment->id);
            if ($studentGrade) {
                $assignment->isGraded = true;
                $assignment->collectedPoints = $studentGrade->studentGradeDetails->sum('criteriaLevel.point');
                $assignment->maxPoints = $assignment->assignmentPlan->assignmentPlanTasks->sum('criteria.max_point');
            } else {
                $assignment->isGraded = false;
                $assignment->collectedPoints = 0;
            }

            return $assignment;
        });

        // LLOs
        $studentGradeDetails = $studentGrades->map(function ($studentGrade) {
            return $studentGrade->studentGradeDetails;
        })->flatten();

        // Collect all assignment plan tasks across all assignments in the class
        $allAssignmentPlanTasks = $courseClass->assignments->flatMap(function ($assignment) {
            return $assignment->assignmentPlan->assignmentPlanTasks;
        });

        $lessonLearningOutcomes = $courseClass->syllabus->lessonLearningOutcomes()->get();
        foreach ($lessonLearningOutcomes as $llo){
            $llo->collectedPoints = $studentGradeDetails->filter(function ($studentGradeDetail) use ($llo) {
                return $studentGradeDetail->criteriaLevel->criteria->lessonLearningOutcome->id == $llo->id;
            })->sum('criteriaLevel.point');

            $llo->maxPoint = $allAssignmentPlanTasks->filter(function ($task) use ($llo) {
                return $task->criteria->llo_id == $llo->id;
            })->sum('criteria.max_point');
        }

        // CLOs
        $courseLearningOutcomes = $courseClass->syllabus->courseLearningOutcomes()->get();
        foreach ($courseLearningOutcomes as $clo){
            $clo->collectedPoints = $studentGradeDetails->filter(function ($studentGradeDetail) use ($clo) {
                return $studentGradeDetail->criteriaLevel->criteria->lessonLearningOutcome->clo_id == $clo->id;
            })->sum('criteriaLevel.point');

            $clo->maxPoint = $allAssignmentPlanTasks->filter(function ($task) use ($clo) {
                return optional($task->criteria->lessonLearningOutcome)->clo_id == $clo->id;
            })->sum('criteria.max_point');
        }

        // PLOs
        $intendedLearningOutcomes = $courseClass->syllabus->intendedLearningOutcomes()->get();
        foreach ($intendedLearningOutcomes as $ilo){
            $ilo->collectedPoints = $studentGradeDetails->filter(function ($studentGradeDetail) use ($ilo) {
                return $studentGradeDetail->criteriaLevel->criteria->lessonLearningOutcome->courseLearningOutcome->ilo_id == $ilo->id;
            })->sum('criteriaLevel.point');

            $ilo->maxPoint = $allAssignmentPlanTasks->filter(function ($task) use ($ilo) {
                return optional(optional($task->criteria->lessonLearningOutcome)->courseLearningOutcome)->ilo_id == $ilo->id;
            })->sum('criteria.max_point');
        }

        return view('mygrade.show', [
            'courseClass' => $courseClass,
            'assignments' => $assignmentGrades,
            'lessonLearningOutcomes' => $lessonLearningOutcomes,
            'courseLearningOutcomes' => $courseLearningOutcomes,
            'intendedLearningOutcomes' => $intendedLearningOutcomes,
        ]);
    }

    public function _getLetterGrade($point)
    {
        if ($point >= 80) {
            return 'A+';
        } elseif ($point >= 75) {
            return 'A';
        } elseif ($point >= 70) {
            return 'A-';
        } elseif ($point >= 65) {
            return 'B+';
        } elseif ($point >= 60) {
            return 'B';
        } elseif ($point >= 55) {
            return 'B-';
        } elseif ($point >= 50) {
            return 'C+';
        } elseif ($point >= 45) {
            return 'C';
        } elseif ($point >= 40) {
            return 'D';
        } else {
            return 'F';
        }
    }
}
