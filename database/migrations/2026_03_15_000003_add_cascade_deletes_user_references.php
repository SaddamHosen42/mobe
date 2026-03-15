<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // student_data.id → users (PK/FK combo — drop and re-add with cascade)
        Schema::table('student_data', function (Blueprint $table) {
            $table->dropForeign(['id']);
            $table->foreign('id')->references('id')->on('users')->onDelete('cascade');
        });

        // syllabi.creator_user_id → users
        Schema::table('syllabi', function (Blueprint $table) {
            $table->dropForeign(['creator_user_id']);
            $table->foreign('creator_user_id')->references('id')->on('users')->onDelete('cascade');
        });

        // courses.creator_user_id → users
        Schema::table('courses', function (Blueprint $table) {
            $table->dropForeign(['creator_user_id']);
            $table->foreign('creator_user_id')->references('id')->on('users')->onDelete('cascade');
        });

        // course_classes.creator_user_id → users
        Schema::table('course_classes', function (Blueprint $table) {
            $table->dropForeign(['creator_user_id']);
            $table->foreign('creator_user_id')->references('id')->on('users')->onDelete('cascade');
        });

        // join_classes.student_user_id → users
        Schema::table('join_classes', function (Blueprint $table) {
            $table->dropForeign(['student_user_id']);
            $table->foreign('student_user_id')->references('id')->on('users')->onDelete('cascade');
        });

        // student_grades.student_user_id → users
        Schema::table('student_grades', function (Blueprint $table) {
            $table->dropForeign(['student_user_id']);
            $table->foreign('student_user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        $tables = [
            'student_data'   => 'id',
            'syllabi'        => 'creator_user_id',
            'courses'        => 'creator_user_id',
            'course_classes' => 'creator_user_id',
            'join_classes'   => 'student_user_id',
            'student_grades' => 'student_user_id',
        ];

        foreach ($tables as $table => $column) {
            Schema::table($table, function (Blueprint $blueprint) use ($column) {
                $blueprint->dropForeign([$column]);
                $blueprint->foreign($column)->references('id')->on('users');
            });
        }
    }
};
