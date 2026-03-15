<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // course_classes.course_id → courses
        Schema::table('course_classes', function (Blueprint $table) {
            $table->dropForeign(['course_id']);
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
        });

        // course_classes.syllabus_id → syllabi
        Schema::table('course_classes', function (Blueprint $table) {
            $table->dropForeign(['syllabus_id']);
            $table->foreign('syllabus_id')->references('id')->on('syllabi')->onDelete('cascade');
        });

        // syllabi.course_id → courses
        Schema::table('syllabi', function (Blueprint $table) {
            $table->dropForeign(['course_id']);
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
        });

        // join_classes.course_class_id → course_classes
        Schema::table('join_classes', function (Blueprint $table) {
            $table->dropForeign(['course_class_id']);
            $table->foreign('course_class_id')->references('id')->on('course_classes')->onDelete('cascade');
        });

        // assignments.course_class_id → course_classes
        Schema::table('assignments', function (Blueprint $table) {
            $table->dropForeign(['course_class_id']);
            $table->foreign('course_class_id')->references('id')->on('course_classes')->onDelete('cascade');
        });

        // assignments.assignment_plan_id → assignment_plans
        Schema::table('assignments', function (Blueprint $table) {
            $table->dropForeign(['assignment_plan_id']);
            $table->foreign('assignment_plan_id')->references('id')->on('assignment_plans')->onDelete('cascade');
        });

        // student_grades.assignment_id → assignments
        Schema::table('student_grades', function (Blueprint $table) {
            $table->dropForeign(['assignment_id']);
            $table->foreign('assignment_id')->references('id')->on('assignments')->onDelete('cascade');
        });

        // student_grade_details.student_grade_id → student_grades
        Schema::table('student_grade_details', function (Blueprint $table) {
            $table->dropForeign(['student_grade_id']);
            $table->foreign('student_grade_id')->references('id')->on('student_grades')->onDelete('cascade');
        });

        // student_grade_details.assignment_plan_task_id → assignment_plan_tasks
        Schema::table('student_grade_details', function (Blueprint $table) {
            $table->dropForeign(['assignment_plan_task_id']);
            $table->foreign('assignment_plan_task_id')->references('id')->on('assignment_plan_tasks')->onDelete('cascade');
        });

        // student_grade_details.criteria_level_id → criteria_levels
        Schema::table('student_grade_details', function (Blueprint $table) {
            $table->dropForeign(['criteria_level_id']);
            $table->foreign('criteria_level_id')->references('id')->on('criteria_levels')->onDelete('cascade');
        });

        // intended_learning_outcomes.syllabus_id → syllabi
        Schema::table('intended_learning_outcomes', function (Blueprint $table) {
            $table->dropForeign(['syllabus_id']);
            $table->foreign('syllabus_id')->references('id')->on('syllabi')->onDelete('cascade');
        });

        // course_learning_outcomes.ilo_id → intended_learning_outcomes
        Schema::table('course_learning_outcomes', function (Blueprint $table) {
            $table->dropForeign(['ilo_id']);
            $table->foreign('ilo_id')->references('id')->on('intended_learning_outcomes')->onDelete('cascade');
        });

        // course_learning_outcomes.syllabus_id → syllabi
        Schema::table('course_learning_outcomes', function (Blueprint $table) {
            $table->dropForeign(['syllabus_id']);
            $table->foreign('syllabus_id')->references('id')->on('syllabi')->onDelete('cascade');
        });

        // lesson_learning_outcomes.clo_id → course_learning_outcomes
        Schema::table('lesson_learning_outcomes', function (Blueprint $table) {
            $table->dropForeign(['clo_id']);
            $table->foreign('clo_id')->references('id')->on('course_learning_outcomes')->onDelete('cascade');
        });

        // lesson_learning_outcomes.syllabus_id → syllabi
        Schema::table('lesson_learning_outcomes', function (Blueprint $table) {
            $table->dropForeign(['syllabus_id']);
            $table->foreign('syllabus_id')->references('id')->on('syllabi')->onDelete('cascade');
        });

        // learning_plans.syllabus_id → syllabi
        Schema::table('learning_plans', function (Blueprint $table) {
            $table->dropForeign(['syllabus_id']);
            $table->foreign('syllabus_id')->references('id')->on('syllabi')->onDelete('cascade');
        });

        // learning_plans.llo_id → lesson_learning_outcomes
        Schema::table('learning_plans', function (Blueprint $table) {
            $table->dropForeign(['llo_id']);
            $table->foreign('llo_id')->references('id')->on('lesson_learning_outcomes')->onDelete('cascade');
        });

        // assignment_plans.syllabus_id → syllabi
        Schema::table('assignment_plans', function (Blueprint $table) {
            $table->dropForeign(['syllabus_id']);
            $table->foreign('syllabus_id')->references('id')->on('syllabi')->onDelete('cascade');
        });

        // rubrics.assignment_plan_id → assignment_plans
        Schema::table('rubrics', function (Blueprint $table) {
            $table->dropForeign(['assignment_plan_id']);
            $table->foreign('assignment_plan_id')->references('id')->on('assignment_plans')->onDelete('cascade');
        });

        // criterias.rubric_id → rubrics
        Schema::table('criterias', function (Blueprint $table) {
            $table->dropForeign(['rubric_id']);
            $table->foreign('rubric_id')->references('id')->on('rubrics')->onDelete('cascade');
        });

        // criterias.llo_id → lesson_learning_outcomes
        Schema::table('criterias', function (Blueprint $table) {
            $table->dropForeign(['llo_id']);
            $table->foreign('llo_id')->references('id')->on('lesson_learning_outcomes')->onDelete('cascade');
        });

        // criteria_levels.criteria_id → criterias
        Schema::table('criteria_levels', function (Blueprint $table) {
            $table->dropForeign(['criteria_id']);
            $table->foreign('criteria_id')->references('id')->on('criterias')->onDelete('cascade');
        });

        // assignment_plan_tasks.assignment_plan_id → assignment_plans
        Schema::table('assignment_plan_tasks', function (Blueprint $table) {
            $table->dropForeign(['assignment_plan_id']);
            $table->foreign('assignment_plan_id')->references('id')->on('assignment_plans')->onDelete('cascade');
        });

        // assignment_plan_tasks.criteria_id → criterias (nullable)
        Schema::table('assignment_plan_tasks', function (Blueprint $table) {
            $table->dropForeign(['criteria_id']);
            $table->foreign('criteria_id')->references('id')->on('criterias')->onDelete('set null');
        });

        // grading_plans.learning_plan_id → learning_plans
        Schema::table('grading_plans', function (Blueprint $table) {
            $table->dropForeign(['learning_plan_id']);
            $table->foreign('learning_plan_id')->references('id')->on('learning_plans')->onDelete('cascade');
        });

        // grading_plans.assignment_plan_task_id → assignment_plan_tasks
        Schema::table('grading_plans', function (Blueprint $table) {
            $table->dropForeign(['assignment_plan_task_id']);
            $table->foreign('assignment_plan_task_id')->references('id')->on('assignment_plan_tasks')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        $fksToRestore = [
            'course_classes'              => ['course_id', 'syllabus_id'],
            'syllabi'                     => ['course_id'],
            'join_classes'                => ['course_class_id'],
            'assignments'                 => ['course_class_id', 'assignment_plan_id'],
            'student_grades'              => ['assignment_id'],
            'student_grade_details'       => ['student_grade_id', 'assignment_plan_task_id', 'criteria_level_id'],
            'intended_learning_outcomes'  => ['syllabus_id'],
            'course_learning_outcomes'    => ['ilo_id', 'syllabus_id'],
            'lesson_learning_outcomes'    => ['clo_id', 'syllabus_id'],
            'learning_plans'              => ['syllabus_id', 'llo_id'],
            'assignment_plans'            => ['syllabus_id'],
            'rubrics'                     => ['assignment_plan_id'],
            'criterias'                   => ['rubric_id', 'llo_id'],
            'criteria_levels'             => ['criteria_id'],
            'assignment_plan_tasks'       => ['assignment_plan_id', 'criteria_id'],
            'grading_plans'               => ['learning_plan_id', 'assignment_plan_task_id'],
        ];

        foreach ($fksToRestore as $table => $columns) {
            Schema::table($table, function (Blueprint $table) use ($columns) {
                foreach ($columns as $column) {
                    $table->dropForeign([$column]);
                }
            });
        }
    }
};
