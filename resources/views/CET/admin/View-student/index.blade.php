@extends('CET.layouts.header')
@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- Search Form -->
            <h3 class="text-center">Search Student by Last Name or Student ID</h3>
            <form action="{{ route('students.search') }}" method="POST">
                @csrf
                <div class="input-group mb-3">
                    <input type="text" name="last_name" class="form-control" placeholder="Enter Student Last Name" value="{{ old('last_name') }}" aria-label="Student Last Name">
                    <input type="text" name="student_id" class="form-control" placeholder="Enter Student ID" value="{{ old('student_id') }}" aria-label="Student ID">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">Search</button>
                    </div>
                </div>
            </form>

            <!-- Display error message if no student found -->
            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Display Student Information if a student is found -->
            @if(isset($students) && $students->isNotEmpty())
                <div class="container mt-4 p-4 border rounded shadow">
                    <h3 class="text-center">Student Data Profiles</h3>
                    @foreach($students as $student)
                        <!-- General Information -->
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="name">Full Name</label>
                                <input type="text" id="name" class="form-control" 
                                       value="{{ $student->last_name }}, {{ $student->first_name }} {{ $student->middle_name ?? '' }}" 
                                       readonly>
                            </div>
                            <div class="col-md-3">
                                <label for="student_id">Student ID</label>
                                <input type="text" id="student_id" class="form-control" value="{{ $student->student_id }}" readonly>
                            </div>
                        </div>

                        <!-- Student Details -->
                        <div class="form-group row">
                            <div class="col-md-3">
                                <label for="school_year">School Year</label>
                                <input type="text" id="school_year" class="form-control" value="{{ $student->school_year }}" readonly>
                            </div>
                            <div class="col-md-3">
                                <label for="age">Age</label>
                                <input type="text" id="age" class="form-control" value="{{ $student->age }}" readonly>
                            </div>
                            <div class="col-md-3">
                                <label for="sex">Sex</label>
                                <input type="text" id="sex" class="form-control" value="{{ $student->sex }}" readonly>
                            </div>
                            <div class="col-md-3">
                                <label for="program">Program</label>
                                <input type="text" id="program" class="form-control" value="{{ $student->program }}" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-3">
                                <label for="college_year_level">College Year Level</label>
                                <input type="text" id="college_year_level" class="form-control" value="{{ $student->college_year_level }}" readonly>
                            </div>
                            <div class="col-md-3">
                                <label for="student_type">Student Type</label>
                                <input type="text" id="student_type" class="form-control" value="{{ $student->student_type }}" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-8">
                                <label for="address">Address</label>
                                <input type="text" id="address" class="form-control" value="{{ $student->address }}" readonly>
                            </div>
                            <div class="col-md-4">
                                <label for="email">Email</label>
                                <input type="text" id="email" class="form-control" value="{{ $student->email }}" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="contact_no">Contact No.</label>
                                <input type="text" id="contact_no" class="form-control" value="{{ $student->contact_no }}" readonly>
                            </div>
                        </div>

                        <!-- Family Information -->
                        <hr>
                        <h4 class="text-center">Family Information</h4>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="father_name">Father's Name</label>
                                <input type="text" id="father_name" class="form-control" value="{{ $student->father_name }}" readonly>
                            </div>
                            <div class="col-md-6">
                                <label for="father_contact_no">Father's Contact No</label>
                                <input type="text " id="father_contact_no" class="form-control" value="{{ $student->father_contact_no }}" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="mother_name">Mother's Name</label>
                                <input type="text" id="mother_name" class="form-control" value="{{ $student->mother_name }}" readonly>
                            </div>
                            <div class="col-md-6">
                                <label for="mother_contact_no">Mother's Contact No.</label>
                                <input type="text" id="mother_contact_no" class="form-control" value="{{ $student->mother_contact_no }}" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="guardian_name">Guardian</label>
                                <input type="text" id="guardian_name" class="form-control" value="{{ $student->guardian_name }}" readonly>
                            </div>
                            <div class="col-md-6">
                                <label for="guardian_contact_no">Guardian's Contact No.</label>
                                <input type="text" id="guardian_contact_no" class="form-control" value="{{ $student->guardian_contact_no }}" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="guardian_address">Guardian's Address</label>
                            <input type="text" id="guardian_address" class="form-control" value="{{ $student->guardian_address }}" readonly>
                        </div>

                        <!-- Educational Background -->
                        <hr>
                        <h4 class="text-center">Educational Background</h4>

                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="high_school_name">High School Name</label>
                                <input type="text" id="high_school_name" class="form-control" value="{{ $student->high_school_name }}" readonly>
                            </div>
                            <div class="col-md-6">
                                <label for="high_school_address">High School Address</label>
                                <input type="text" id="high_school_address" class="form-control" value="{{ $student->high_school_address }}" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="elementary_school_name">Elementary School Name</label>
                                <input type="text" id="elementary_school_name" class="form-control" value="{{ $student->elementary_school_name }}" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="elementary_school_address">Elementary School Address</label>
                                <input type="text" id="elementary_school_address" class="form-control" value="{{ $student->elementary_school_address }}" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="previous_college">Previous College</label>
                                <input type="text" id="previous_college" class="form-control" value="{{ $student->previous_college }}" readonly>
                            </div>
                            <div class="col-md-6">
                                <label for="highest_level_completed">Highest Level Completed</label>
                                <input type="text" id="highest_level_completed" class="form-control" value="{{ $student->highest_level_completed }}" readonly>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="form-group row mt-3">
                            <div class="col-md-6">
                                <a href="{{ route('students.edit', $student->id) }}" class="btn btn-warning btn-block">
                                    Update
                                </a>
                            </div>
                            <div class="col-md-6">
                                <form action="{{ route('students.destroy', $student->id) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-block" 
                                            onclick="return confirm('Are you sure you want to delete this student?')">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @elseif(isset($students) && $students->isEmpty())
                <div class="alert alert-warning">
                    No students found with the given criteria.
                </div>
            @endif
        </div>
    </div>
</div>

<style>
/* General Styles */
body {
    font-family: 'Arial', sans-serif;
    background-color: #f8f9fa;
}

.container {
    margin-top: 20px;
}

/* Search Form Styles */
.input-group {
    margin-bottom: 20px;
}

.input-group .form-control {
    border-radius: 0.5rem; /* More rounded corners */
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    transition: box-shadow 0.3s ease; /* Smooth transition for hover effect */
}

.input-group .form-control:focus {
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.5); /* Highlight on focus */
    border-color: #007bff; /* Change border color on focus */
}

.input-group .btn {
    border-radius: 0.5rem; /* More rounded corners */
    transition: background-color 0.3s ease; /* Smooth transition for hover effect */
}

.input-group .btn:hover {
    background-color: #0056b3; /* Darker blue on hover */
}

/* Alert Styles */
.alert {
    margin-top: 20px;
    border-radius: 0.5rem; /* Rounded corners for alerts */
}

/* Student Data Profiles Styles */
.border {
    border: 1px solid #dee2e6;
    border-radius: 0.5rem; /* Rounded corners */
}

.shadow {
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
}

h3, h4 {
    color: #343a40;
    margin-bottom: 15px; /* Space below headings */
}

.form-group {
    margin-bottom: 20px; /* Increased spacing for better readability */
}

.form-control[readonly] {
    background-color: #e9ecef;
    border: 1px solid #ced4da;
}

/* Action Buttons */
.btn-block {
    width: 100%;
}

.btn-warning {
    background-color: #ffc107;
    border-color: #ffc107;
    transition: background-color 0.3s ease; /* Smooth transition for hover effect */
}

.btn-warning:hover {
    background-color: #e0a800; /* Darker yellow on hover */
}

.btn-danger {
    background-color: #dc3545;
    border-color: #dc3545;
    transition: background-color 0.3s ease; /* Smooth transition for hover effect */
}

.btn-danger:hover {
    background-color: #c82333; /* Darker red on hover */
}

/* Responsive Styles */
@media (max-width: 768px) {
    .col-md-6, .col-md-3 {
        flex: 0 0 100%;
        max-width: 100%;
    }
}
</style>
@endsection