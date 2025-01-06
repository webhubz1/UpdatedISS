<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSchoolYearToStudentsTable extends Migration
{
    public function up()
    {
        // Check if the column doesn't already exist before adding it
        if (!Schema::hasColumn('students', 'school_year')) {
            Schema::table('students', function (Blueprint $table) {
                $table->string('school_year')->nullable();
            });
        }
    }

    public function down()
    {
        // Only drop the column if it exists
        Schema::table('students', function (Blueprint $table) {
            if (Schema::hasColumn('students', 'school_year')) {
                $table->dropColumn('school_year');
            }
        });
    }
}
