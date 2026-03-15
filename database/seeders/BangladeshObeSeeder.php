<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class BangladeshObeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();

        DB::transaction(function () use ($now) {
            $adminId = DB::table('users')->insertGetId([
                'name' => 'Ahsan Habib',
                'email' => 'admin@gmail.com',
                'email_verified_at' => $now,
                'password' => Hash::make('password'),
                'role' => 'admin',
                'profile_completed' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ]);

            $teachers = [
                ['name' => 'Dr. Farhana Rahman', 'email' => 'farhana.rahman@cse.edu.bd'],
                ['name' => 'Md. Saifur Islam', 'email' => 'saifur.islam@cse.edu.bd'],
                ['name' => 'Nusrat Jahan', 'email' => 'nusrat.jahan@cse.edu.bd'],
            ];

            $teacherIds = [];
            foreach ($teachers as $teacher) {
                $teacherIds[] = DB::table('users')->insertGetId([
                    'name' => $teacher['name'],
                    'email' => $teacher['email'],
                    'email_verified_at' => $now,
                    'password' => Hash::make('password'),
                    'role' => 'teacher',
                    'profile_completed' => true,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            }

            $studentNames = [
                'Abdullah Al Noman',
                'Tanvir Hasan',
                'Nafisa Islam',
                'Sadia Akter',
                'Rakibul Hasan',
                'Jannatul Ferdous',
                'Mehedi Hasan',
                'Shahriar Kabir',
                'Tasnim Ara',
                'Fariha Tabassum',
            ];

            $studentIds = [];
            foreach ($studentNames as $index => $studentName) {
                $studentId = DB::table('users')->insertGetId([
                    'name' => $studentName,
                    'email' => 'student' . ($index + 1) . '@cse.edu.bd',
                    'email_verified_at' => $now,
                    'password' => Hash::make('password'),
                    'role' => 'student',
                    'profile_completed' => true,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);

                $studentIds[] = $studentId;

                DB::table('student_data')->insert([
                    'id' => $studentId,
                    'student_id_number' => '2202' . str_pad((string) ($index + 1), 3, '0', STR_PAD_LEFT),
                ]);
            }

            $facultyDepartmentMap = [
                [
                    'faculty' => 'Faculty of Engineering and Technology',
                    'departments' => [
                        'Department of Computer Science and Engineering',
                        'Department of Software Engineering',
                    ],
                ],
                [
                    'faculty' => 'Faculty of Science and Information Technology',
                    'departments' => [
                        'Department of Information and Communication Technology',
                        'Department of Data Science and Artificial Intelligence',
                    ],
                ],
                [
                    'faculty' => 'Faculty of Cyber and Digital Systems',
                    'departments' => [
                        'Department of Cyber Security and Digital Forensics',
                    ],
                ],
            ];

            $studyProgramsByDepartment = [];
            foreach ($facultyDepartmentMap as $facultyEntry) {
                $facultyId = DB::table('faculties')->insertGetId([
                    'name' => $facultyEntry['faculty'],
                ]);

                foreach ($facultyEntry['departments'] as $departmentName) {
                    $departmentId = DB::table('departments')->insertGetId([
                        'faculty_id' => $facultyId,
                        'name' => $departmentName,
                    ]);

                    $studyProgramsByDepartment[$departmentName] = DB::table('study_programs')->insertGetId([
                        'department_id' => $departmentId,
                        'name' => 'B.Sc. in ' . str_replace('Department of ', '', $departmentName),
                    ]);
                }
            }

            $courses = [
                [
                    'department' => 'Department of Computer Science and Engineering',
                    'name' => 'Object Oriented Programming',
                    'code' => 'CSE-111',
                    'course_credit' => 3,
                    'lab_credit' => 1,
                    'short_description' => 'C++ based object-oriented design with classes, inheritance, and polymorphism.',
                    'minimal_requirement' => 'Fundamentals of programming and basic discrete mathematics.',
                    'study_material_summary' => 'UML basics, C++ problem sets, and weekly coding labs on OOP patterns.',
                    'learning_media' => 'Live coding sessions, IDE lab demonstrations, and peer code reviews.',
                    'assignment_style' => 'Object-oriented implementation and design report',
                    'focus' => 'design clean classes and reusable software components',
                ],
                [
                    'department' => 'Department of Computer Science and Engineering',
                    'name' => 'Data Structures and Algorithms',
                    'code' => 'CSE-221',
                    'course_credit' => 3,
                    'lab_credit' => 1,
                    'short_description' => 'Algorithm design and complexity analysis using core data structures.',
                    'minimal_requirement' => 'Structured programming and mathematical logic.',
                    'study_material_summary' => 'Sorting/searching analysis, trees, graphs, and algorithmic problem solving drills.',
                    'learning_media' => 'Algorithm walkthroughs, contest-style exercises, and whiteboard tracing.',
                    'assignment_style' => 'Algorithm implementation and complexity analysis',
                    'focus' => 'solve computational problems efficiently',
                ],
                [
                    'department' => 'Department of Software Engineering',
                    'name' => 'Database Management Systems',
                    'code' => 'SWE-231',
                    'course_credit' => 3,
                    'lab_credit' => 1,
                    'short_description' => 'Relational design, SQL optimization, normalization, and transaction control.',
                    'minimal_requirement' => 'Basic programming and familiarity with data modeling concepts.',
                    'study_material_summary' => 'ER modeling, SQL labs, indexing, ACID properties, and query optimization tasks.',
                    'learning_media' => 'Hands-on SQL lab sessions and schema design workshops.',
                    'assignment_style' => 'Schema design, SQL development, and performance tuning',
                    'focus' => 'model robust relational databases and write optimized SQL',
                ],
                [
                    'department' => 'Department of Information and Communication Technology',
                    'name' => 'Computer Networks',
                    'code' => 'ICT-341',
                    'course_credit' => 3,
                    'lab_credit' => 1,
                    'short_description' => 'Network layers, routing, switching, protocols, and performance fundamentals.',
                    'minimal_requirement' => 'Digital logic and operating system basics.',
                    'study_material_summary' => 'OSI/TCP-IP mapping, subnetting practice, routing labs, and packet analysis.',
                    'learning_media' => 'Packet tracer simulations, protocol demonstrations, and lab experiments.',
                    'assignment_style' => 'Network configuration and protocol analysis',
                    'focus' => 'configure and troubleshoot enterprise-grade network setups',
                ],
                [
                    'department' => 'Department of Data Science and Artificial Intelligence',
                    'name' => 'Machine Learning Fundamentals',
                    'code' => 'DSAI-351',
                    'course_credit' => 3,
                    'lab_credit' => 1,
                    'short_description' => 'Supervised and unsupervised learning with model evaluation techniques.',
                    'minimal_requirement' => 'Probability, linear algebra, and Python programming.',
                    'study_material_summary' => 'Regression/classification workflows, feature engineering, and model validation labs.',
                    'learning_media' => 'Jupyter-based labs, dataset exploration, and project presentations.',
                    'assignment_style' => 'Model development and performance reporting',
                    'focus' => 'build and evaluate practical machine learning models',
                ],
                [
                    'department' => 'Department of Cyber Security and Digital Forensics',
                    'name' => 'Cyber Security and Ethical Hacking',
                    'code' => 'CYB-361',
                    'course_credit' => 3,
                    'lab_credit' => 1,
                    'short_description' => 'Security principles, vulnerability assessment, secure configuration, and ethical testing.',
                    'minimal_requirement' => 'Networking concepts and basic Linux command-line familiarity.',
                    'study_material_summary' => 'Threat modeling, secure hardening labs, and incident response case studies.',
                    'learning_media' => 'Sandbox security labs, penetration testing demonstrations, and blue-team exercises.',
                    'assignment_style' => 'Security audit and mitigation implementation',
                    'focus' => 'identify vulnerabilities and propose secure mitigations',
                ],
            ];

            $syllabiPerCourse = 2;
            $classesPerSyllabus = 2;
            $assignmentsPerSyllabus = 3;
            $tasksPerAssignment = 3;

            foreach ($courses as $courseIndex => $course) {
                $teacherId = $teacherIds[$courseIndex % count($teacherIds)];

                $courseStudyProgramId = $studyProgramsByDepartment[$course['department']];

                $courseId = DB::table('courses')->insertGetId([
                    'study_program_id' => $courseStudyProgramId,
                    'creator_user_id' => $adminId,
                    'name' => $course['name'],
                    'code' => $course['code'],
                    'course_credit' => $course['course_credit'],
                    'lab_credit' => $course['lab_credit'],
                    'type' => 'mandatory',
                    'short_description' => $course['short_description'],
                    'minimal_requirement' => $course['minimal_requirement'],
                    'study_material_summary' => $course['study_material_summary'],
                    'learning_media' => $course['learning_media'],
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);

                for ($syllabusNo = 1; $syllabusNo <= $syllabiPerCourse; $syllabusNo++) {
                    $syllabusId = DB::table('syllabi')->insertGetId([
                        'course_id' => $courseId,
                        'title' => $course['name'] . ' - OBE Syllabus ' . $syllabusNo,
                        'author' => 'CSE Curriculum Committee, Bangladesh',
                        'head_of_study_program' => 'Dr. Mahmudul Hasan, Head of CSE',
                        'creator_user_id' => $teacherId,
                    ]);

                    $iloIds = [];
                    for ($iloPosition = 1; $iloPosition <= 3; $iloPosition++) {
                        $iloIds[] = DB::table('intended_learning_outcomes')->insertGetId([
                            'syllabus_id' => $syllabusId,
                            'position' => $iloPosition,
                            'code' => 'ILO-' . $course['code'] . '-S' . $syllabusNo . '-' . $iloPosition,
                            'description' => $iloPosition === 1
                                ? 'Demonstrate theoretical understanding of foundational computing concepts.'
                                : 'Apply problem-solving skills to real software engineering tasks.',
                        ]);
                    }

                    $cloIds = [];
                    for ($cloPosition = 1; $cloPosition <= 4; $cloPosition++) {
                        $cloIds[] = DB::table('course_learning_outcomes')->insertGetId([
                            'ilo_id' => $iloIds[($cloPosition - 1) % count($iloIds)],
                            'syllabus_id' => $syllabusId,
                            'position' => $cloPosition,
                            'code' => 'CLO-' . $course['code'] . '-S' . $syllabusNo . '-' . $cloPosition,
                            'description' => 'Achieve CLO ' . $cloPosition . ' for ' . $course['name'] . ' through theory and lab activities.',
                        ]);
                    }

                    $lloIds = [];
                    for ($lloPosition = 1; $lloPosition <= 6; $lloPosition++) {
                        $lloIds[] = DB::table('lesson_learning_outcomes')->insertGetId([
                            'clo_id' => $cloIds[($lloPosition - 1) % count($cloIds)],
                            'syllabus_id' => $syllabusId,
                            'position' => $lloPosition,
                            'code' => 'LLO-' . $course['code'] . '-S' . $syllabusNo . '-' . $lloPosition,
                            'description' => 'Complete practical lesson outcome ' . $lloPosition . ' aligned with course outcomes.',
                        ]);
                    }

                    $learningPlanIds = [];
                    for ($week = 1; $week <= 6; $week++) {
                        $learningPlanIds[] = DB::table('learning_plans')->insertGetId([
                            'syllabus_id' => $syllabusId,
                            'week_number' => $week,
                            'llo_id' => $lloIds[$week - 1],
                            'study_material' => 'Week ' . $week . ' lecture note and lab worksheet for ' . $course['code'] . '.',
                            'learning_method' => 'Interactive lecture + guided coding practice.',
                            'estimated_time' => '3 hours lecture + 2 hours lab',
                            'created_at' => $now,
                            'updated_at' => $now,
                        ]);
                    }

                    $assignmentPlans = [];
                    for ($assignmentNo = 1; $assignmentNo <= $assignmentsPerSyllabus; $assignmentNo++) {
                        $assignmentPlanId = DB::table('assignment_plans')->insertGetId([
                            'syllabus_id' => $syllabusId,
                            'objective' => 'Assess how students can ' . $course['focus'] . ' in assignment ' . $assignmentNo . '.',
                            'title' => $course['code'] . ' S' . $syllabusNo . ' Assignment ' . $assignmentNo,
                            'is_group_assignment' => false,
                            'assignment_style' => $course['assignment_style'],
                            'description' => 'Implement and explain a ' . strtolower($course['name']) . ' solution for assignment ' . $assignmentNo . '.',
                            'output_instruction' => 'Submit source code and sample output.',
                            'submission_instruction' => 'Submit through LMS in PDF and source archive format.',
                            'deadline_instruction' => 'Submission deadline is strict; late penalty applies.',
                            'created_at' => $now,
                            'updated_at' => $now,
                        ]);

                        $rubricId = DB::table('rubrics')->insertGetId([
                            'assignment_plan_id' => $assignmentPlanId,
                            'title' => 'Rubric for ' . $course['code'] . ' S' . $syllabusNo . ' Assignment ' . $assignmentNo,
                            'created_at' => $now,
                            'updated_at' => $now,
                        ]);

                        $assignmentTaskIds = [];
                        $criteriaIds = [];

                        for ($taskNo = 1; $taskNo <= $tasksPerAssignment; $taskNo++) {
                            $assignmentTaskId = DB::table('assignment_plan_tasks')->insertGetId([
                                'assignment_plan_id' => $assignmentPlanId,
                                'criteria_id' => null,
                                'code' => $course['code'] . '-S' . $syllabusNo . '-A' . $assignmentNo . '-T' . $taskNo,
                                'description' => 'Complete task ' . $taskNo . ' for assignment ' . $assignmentNo . '.',
                            ]);

                            $assignmentTaskIds[] = $assignmentTaskId;

                            $criteriaId = DB::table('criterias')->insertGetId([
                                'rubric_id' => $rubricId,
                                'llo_id' => $lloIds[($taskNo - 1) % count($lloIds)],
                                'title' => 'Task ' . $taskNo . ' Evaluation',
                                'description' => 'Evaluate correctness, efficiency, and code quality.',
                                'max_point' => 10,
                                'created_at' => $now,
                                'updated_at' => $now,
                            ]);

                            $criteriaIds[] = $criteriaId;

                            DB::table('criteria_levels')->insert([
                                ['criteria_id' => $criteriaId, 'point' => 10, 'title' => 'Excellent', 'description' => 'Accurate and optimized solution.'],
                                ['criteria_id' => $criteriaId, 'point' => 8, 'title' => 'Good', 'description' => 'Mostly correct with minor issues.'],
                                ['criteria_id' => $criteriaId, 'point' => 6, 'title' => 'Fair', 'description' => 'Partially correct; needs improvement.'],
                                ['criteria_id' => $criteriaId, 'point' => 4, 'title' => 'Needs Improvement', 'description' => 'Major conceptual or implementation errors.'],
                            ]);

                            DB::table('grading_plans')->insert([
                                'learning_plan_id' => $learningPlanIds[($taskNo - 1) % count($learningPlanIds)],
                                'assignment_plan_task_id' => $assignmentTaskId,
                            ]);
                        }

                        foreach ($assignmentTaskIds as $taskIdx => $assignmentTaskId) {
                            DB::table('assignment_plan_tasks')
                                ->where('id', $assignmentTaskId)
                                ->update(['criteria_id' => $criteriaIds[$taskIdx]]);
                        }

                        $assignmentPlans[] = [
                            'assignment_plan_id' => $assignmentPlanId,
                            'assignment_no' => $assignmentNo,
                            'assignment_task_ids' => $assignmentTaskIds,
                            'criteria_ids' => $criteriaIds,
                        ];
                    }

                    for ($classNo = 1; $classNo <= $classesPerSyllabus; $classNo++) {
                        $sectionCode = chr(64 + $classNo);
                        $courseClassId = DB::table('course_classes')->insertGetId([
                            'course_id' => $courseId,
                            'syllabus_id' => $syllabusId,
                            'name' => $course['code'] . ' Section ' . $sectionCode,
                            'thumbnail_img' => null,
                            'class_code' => str_replace('-', '', $course['code']) . $sectionCode . '26S' . $syllabusNo,
                            'creator_user_id' => $teacherId,
                            'settings' => json_encode([
                                'llo_threshold' => 60,
                                'attendance_weight' => 10,
                                'assignment_weight' => 40,
                                'final_exam_weight' => 50,
                            ]),
                            'created_at' => $now,
                            'updated_at' => $now,
                        ]);

                        foreach ($studentIds as $studentId) {
                            DB::table('join_classes')->insert([
                                'course_class_id' => $courseClassId,
                                'student_user_id' => $studentId,
                            ]);
                        }

                        foreach ($assignmentPlans as $assignmentPlanData) {
                            $assignmentNo = $assignmentPlanData['assignment_no'];
                            $assignedDate = Carbon::now()->subDays(18 - ($assignmentNo * 2) - $classNo);
                            $dueDate = Carbon::now()->addDays(6 + ($assignmentNo * 3) + $classNo);

                            $assignmentId = DB::table('assignments')->insertGetId([
                                'assignment_plan_id' => $assignmentPlanData['assignment_plan_id'],
                                'course_class_id' => $courseClassId,
                                'assigned_date' => $assignedDate,
                                'due_date' => $dueDate,
                                'note' => 'Practice real-world CSE problem solving in OBE format.',
                            ]);

                            foreach ($studentIds as $studentIndex => $studentId) {
                                $studentGradeId = DB::table('student_grades')->insertGetId([
                                    'student_user_id' => $studentId,
                                    'assignment_id' => $assignmentId,
                                    'published' => true,
                                    'created_at' => $now,
                                    'updated_at' => $now,
                                ]);

                                foreach ($assignmentPlanData['assignment_task_ids'] as $taskIdx => $assignmentTaskId) {
                                    $criteriaId = $assignmentPlanData['criteria_ids'][$taskIdx];
                                    $criteriaLevels = DB::table('criteria_levels')
                                        ->where('criteria_id', $criteriaId)
                                        ->orderByDesc('point')
                                        ->get();

                                    $levelIndex = ($studentIndex + $taskIdx + $assignmentNo + $classNo + $syllabusNo) % $criteriaLevels->count();
                                    $selectedLevel = $criteriaLevels[$levelIndex];

                                    DB::table('student_grade_details')->insert([
                                        'student_grade_id' => $studentGradeId,
                                        'assignment_plan_task_id' => $assignmentTaskId,
                                        'criteria_level_id' => $selectedLevel->id,
                                        'created_at' => $now,
                                        'updated_at' => $now,
                                    ]);
                                }
                            }
                        }
                    }
                }
            }
        });
    }
}
