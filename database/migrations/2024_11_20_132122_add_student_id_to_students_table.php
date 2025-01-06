<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStudentIdToStudentsTable extends Migration
{
    public function up()
    {
        Schema::table('students', function (Blueprint $table) {
            // Add 'student_id' column only if it doesn't already exist
            if (!Schema::hasColumn('students', 'student_id')) {
                $table->string('student_id')->nullable(); // or 'not null' depending on your need
            }
        });
    }

    public function down()
    {
        Schema::table('students', function (Blueprint $table) {
            // Dropping 'student_id' column if the migration is rolled back
            $table->dropColumn('student_id');
        });
    }
}
