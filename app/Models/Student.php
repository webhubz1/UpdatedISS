<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory; // Don't forget to include the HasFactory trait

    protected $fillable = [
        'school_year', 
        'last_name', 
        'first_name', 
        'middle_name', 
        'student_id', 
        'age', 
        'sex', 
        'program', 
        'address', 
        'email', 
        'contact_no', 
        'father_name', 
        'father_contact_no', 
        'mother_name', 
        'mother_contact_no', 
        'guardian_name', 
        'guardian_contact_no', 
        'guardian_address', 
        'high_school_name',  
        'high_school_address',
        'previous_college', 
        'highest_level_completed', 
        'college_year_level', 
        'student_type', 
        'elementary_school_name', 
        'elementary_school_address',

        
    ];

    
}