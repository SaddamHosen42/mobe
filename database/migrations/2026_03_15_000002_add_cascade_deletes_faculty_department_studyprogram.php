<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // departments.faculty_id → faculties
        Schema::table('departments', function (Blueprint $table) {
            $table->dropForeign(['faculty_id']);
            $table->foreign('faculty_id')->references('id')->on('faculties')->onDelete('cascade');
        });

        // study_programs.department_id → departments
        Schema::table('study_programs', function (Blueprint $table) {
            $table->dropForeign(['department_id']);
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
        });

        // courses.study_program_id → study_programs
        Schema::table('courses', function (Blueprint $table) {
            $table->dropForeign(['study_program_id']);
            $table->foreign('study_program_id')->references('id')->on('study_programs')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->dropForeign(['study_program_id']);
            $table->foreign('study_program_id')->references('id')->on('study_programs');
        });

        Schema::table('study_programs', function (Blueprint $table) {
            $table->dropForeign(['department_id']);
            $table->foreign('department_id')->references('id')->on('departments');
        });

        Schema::table('departments', function (Blueprint $table) {
            $table->dropForeign(['faculty_id']);
            $table->foreign('faculty_id')->references('id')->on('faculties');
        });
    }
};
