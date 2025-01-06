<?php

namespace App\Exports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithTitle;

class StudentsExport implements FromCollection, WithHeadings, WithColumnFormatting, WithTitle
{
    protected $schoolYear;
    protected $program;
    protected $collegeYearLevel;

    // Constructor to pass the filter criteria
    public function __construct($schoolYear, $program, $collegeYearLevel)
    {
        $this->schoolYear = $schoolYear;
        $this->program = $program;
        $this->collegeYearLevel = $collegeYearLevel;
    }

    // Fetching the data from the database based on school year and program
    public function collection()
    {
        return Student::where('school_year', $this->schoolYear)
                      ->where('program', $this->program)
                      ->where('college_year_level', $this->collegeYearLevel)
                      ->get([
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
                          'high_school_address', // Ensure this is included
                          'previous_college',
                          'highest_level_completed',
                          'college_year_level',
                          'student_type',
                          'elementary_school_name', // Ensure this is included
                          'elementary_school_address', // Ensure this is included
                      ]);
    }

    // Defining the headings for the Excel file
    public function headings(): array
    {
        return [
            'School Year',
            'Last Name',
            'First Name',
            'Middle Name',
            'Student ID',
            'Age',
            'Sex',
            'Program',
            'Address',
            'Email',
            'Contact No',
            'Father Name',
            'Father Contact No',
            'Mother Name',
            'Mother Contact No',
            'Guardian Name',
            'Guardian Contact No',
            'Guardian Address',
            'High School Name',
            'High School Address', // Ensure this matches the data being exported
            'Previous College',
            'Highest Level Completed',
            'College Year Level',
            'Student Type',
            'Elementary School Name', // Ensure this matches the data being exported
            'Elementary School Address', // Ensure this matches the data being exported
        ];
    }

    // Formatting the Excel file's columns (optional)
    public function columnFormats(): array
    {
        return [
            'A' => 'string',  // School Year
            'B' => 'string',  // Last Name
            'C' => 'string',  // First Name
            'D' => 'string',  // Middle Name
            'E' => 'string',  // Student ID
            'F' => 'integer',  // Age
            'G' => 'string',  // Sex
            'H' => 'string',  // Program
            'I' => 'string',  // Address
            'J' => 'string',  // Email
            'K' => 'string',  // Contact No
            'L' => 'string',  // Father Name
            'M' => 'string',  // Father Contact No
            'N' => 'string',  // Mother Name
            'O' => 'string',  // Mother Contact No
            'P' => 'string',  // Guardian Name
            'Q' => 'string',  // Guardian Contact No
            'R' => 'string',  // Guardian Address
            'S' => 'string',   // High School Name
            'T' => 'string',  // High School Address
            'U' => 'string',  // Previous College
            'V' => 'string',  // Highest Level Completed
            'W' => 'string',  // College Year Level
            'X' => 'string',  // Student Type
            'Y' => 'string',  // Elementary School Name
            'Z' => 'string',  // Elementary School Address
        ];
    }

    // Title of the sheet
    public function title(): string
    {
        return "Students in {$this->program} ({$this->schoolYear})";
    }
}