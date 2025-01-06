<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\StudentsExport;

class StudentInformationController extends Controller
{
    // Show the student dashboard view
    public function studentInformation()
    {
        return view('CET.student_information.student-dashboard');
    }

    public function create()
    {
        return view('CET.admin.Add-student.index'); // Ensure this view exists
    }

    // Store the student data
    public function store(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'school_year' => 'required|string|max:10',
            'last_name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'student_id' => 'required|unique:students,student_id',  // Ensure unique student_id
            'age' => 'required|integer|min:1',
            'sex' => 'required|in:Male,Female',
            'program' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
            'contact_no' => 'required|string|max:15',
            'father_name' => 'required|string|max:255',
            'father_contact_no' => 'nullable|string|max:15',
            'mother_name' => 'required|string|max:255',
            'mother_contact_no' => 'nullable|string|max:15',
            'guardian_name' => 'required|string|max:255',
            'guardian_contact_no' => 'nullable|string|max:15',
            'guardian_address' => 'nullable|string|max:255',
            'elementary_school_name' => 'required|string|max:255',
            'elementary_school_address' => 'nullable|string|max:255',
            'high_school_name' => 'required|string|max:255',
            'high_school_address' => 'nullable|string|max:255',
            'previous_college' => 'nullable|string|max:255',
            'highest_level_completed' => 'required|string',
            'college_year_level' => 'required|string|max:255',
            'student_type' => 'nullable|string|max:255',

        ]);
    
        // Create the student without generating the student number
        $student = Student::create($validatedData);
    
        if ($student) {
            return response()->json([
                'success' => true,
                'message' => 'Student added successfully.',
                'student_id' => $student->id // Send the student ID in the response
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Failed to add student.',
                'errors' => 'There was an issue with saving the student to the database.' // More detailed error message
            ]);
        }
    }

    // Show the form to view a student (if needed, you can add logic here for listing students)

    // Search for a student by name (first, last, or middle)
    public function searchStudent(Request $request)
    {
        // Validate the search request, allowing for first name, last name, middle name, or student id search
        $request->validate([
            'last_name' => 'nullable|string|max:255',
            'first_name' => 'nullable|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'student_id' => 'nullable|exists:students,student_id|string|max:255', // Add validation for student_id
        ]);

        // Initialize query builder
        $query = Student::query();

        // Define search conditions in an array to make it dynamic
        $conditions = [
            'student_id' => 'like',
            'last_name' => 'like',
            'first_name' => 'like',
            'middle_name' => 'like',
        ];

        // Loop through conditions and apply filters dynamically
        foreach ($conditions as $field => $operator) {
            if ($request->filled($field)) {
                $query->where($field, $operator, '%' . $request->$field . '%');
            }
        }

        // Execute the query to get matching students
        $students = $query->get();

        // If no students are found, return an error message
        if ($students->isEmpty()) {
            return redirect()->back()->with('error', 'No students found matching the search criteria.');
        }

        // Return the students to the view
        return view('CET.admin.View-Student.index', compact('students'));
    }

    public function index()
{
    $students = Student::all();
    return view('CET.admin.View-Student.index', compact('students'));
}

public function edit($id)
{
    $student = Student::findOrFail($id);
    return view('CET.admin.View-Student.edit', compact('student'));
}

public function update(Request $request, $id)
{
    $validatedData = $request->validate([
        'school_year' => 'required|string|max:10',
        'last_name' => 'required|string|max:255',
        'first_name' => 'required|string|max:255',
        'middle_name' => 'nullable|string|max:255',
        'age' => 'required|integer|min:1',
        'sex' => 'required|in:Male,Female',
        'program' => 'required|string|max:255',
        'address' => 'required|string|max:255',
        'email' => 'required|email|unique:students,email,' . $id,
        'contact_no' => 'required|string|max:15',
        'father_name' => 'required|string|max:255',
        'mother_name' => 'required|string|max:255',
        'guardian_name' => 'required|string|max:255',
        'guardian_contact_no' => 'nullable|string|max:15',
        'guardian_address' => 'nullable|string|max:255',
        'elementary_school_name' => 'required|string|max:255',
        'elementary_school_address' => 'nullable|string|max:255',
         'high_school_name' => 'required|string|max:255',
        'high_school_address' => 'nullable|string|max:255',
        'previous_college' => 'nullable|string|max:255',
        'highest_level_completed' => 'required|string',
        'college_year_level' => 'required|string|max:255',
        'student_type' => 'nullable|string|max:255',

    ]);

    $student = Student::findOrFail($id);
    $student->update($validatedData);

    return redirect()->route('students.index')->with('success', 'Student updated successfully.');
}

public function destroy($id)
{
    $student = Student::findOrFail($id);
    $student->delete();

    return redirect()->route('students.index')->with('success', 'Student deleted successfully.');
}


    // Get total number of students
    public function totalStudents()
    {
        $totalStudents = Student::count();
        return view('home', compact('totalStudents')); // Removed debug output
    }

    // Export students data
    public function export(Request $request)
    {
        // Retrieve filter values from the request
        $schoolYear = $request->input('school_year');
        $program = $request->input('program');
        $collegeYearLevel = $request->input('college_year_level');

        // Pass the required arguments to the export class
        return Excel::download(
            new StudentsExport($schoolYear, $program, $collegeYearLevel), 
            'students.xlsx'
        );
    }

    // Get students by program
    public function studentsByProgram(Request $request, $program)
    {
        // Retrieve the filtered values from the request
        $schoolYear = $request->input('school_year');
        $yearLevel = $request->input('college_year_level');

        // Build the query to filter students based on selected criteria
        $query = Student::where('program', $program);

        // Apply school year filter if provided
        if ($schoolYear) {
            $query->where('school_year', $schoolYear);
        }

        // Apply college year level filter if provided
        if ($yearLevel) {
            $query->where('college_year_level', $yearLevel);
        }

        // Get the filtered students
        $students = $query->get();

        // Calculate the total students count after filtering
        $totalStudents = $students->count();

        // Pass the data to the view
        return view('CET.admin.View-Student.program', compact('students', 'totalStudents', 'program', 'schoolYear', 'yearLevel'));
    }

    // Show student profile
    public function showStudentProfile($id)
    {
        $student = Student::findOrFail($id); // Fetch student data by ID

        // Pass student data to the view
        return view('admin.View-Student.search', compact('student'));
    }

    // Show student edit form
    public function show($id)
    {
        $student = Student::findOrFail($id); // Fetch student or return 404
        return view('CET.admin.View-Student.edit', compact('student')); // Pass data to the view
    }
    public function addStudent()
    {
        // You can return a view to add a new student, for example
        return view('CET.admin.Add-student.index');
    }

    public function viewStudent()
    {
        return view('CET.admin.View-Student.index'); // Show the view student form
    }

    

    
}