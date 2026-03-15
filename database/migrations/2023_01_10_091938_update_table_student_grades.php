<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $driver = Schema::getConnection()->getDriverName();

        if ($driver !== 'sqlite') {
            if (Schema::hasColumn('student_grades', 'assignment_plan_task_id')) {
                Schema::table('student_grades', function (Blueprint $table) {
                    $table->dropForeign(['assignment_plan_task_id']);
                    $table->dropColumn('assignment_plan_task_id');
                });
            }

            if (Schema::hasColumn('student_grades', 'criteria_level_id')) {
                Schema::table('student_grades', function (Blueprint $table) {
                    $table->dropForeign(['criteria_level_id']);
                    $table->dropColumn('criteria_level_id');
                });
            }
        }

        if (! Schema::hasColumn('student_grades', 'published')) {
            Schema::table('student_grades', function (Blueprint $table) {
                $table->boolean('published')->default(false)->after('assignment_id');
            });
        }

        Schema::create('student_grade_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_grade_id')->constrained('student_grades');
            $table->foreignId('assignment_plan_task_id')->constrained('assignment_plan_tasks');
            $table->foreignId('criteria_level_id')->constrained('criteria_levels');
            $table->timestampsTz();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
