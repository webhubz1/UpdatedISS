@extends('CET.layouts.header')

@section('content')
<div class="container" style="padding: 20px;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="background: rgba(255, 255, 255, 0.9); border-radius: 10px; padding: 20px;">
                <div class="text-center mb-4">
                    <h1>Student Information</h1>
                </div>

                <!-- Display validation errors -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Edit Student Form -->
                <form id="studentForm" action="{{ route('students.update', $student->id) }}" method="POST">
                    @csrf
                    @method('PUT') <!-- Indicate that this is an update request -->

                    <div class="form-group">
                        <label for="school_year">School Year:</label>
                        <select name="school_year" class="form-control" required>
                            @for ($year = 2023; $year <= 2040; $year++)
                                <option value="{{ $year }}-{{ $year + 1 }}" 
                                    {{ old('school_year', $student->school_year) == "$year-".($year + 1) ? 'selected' : '' }}>
                                    {{ $year }}-{{ $year + 1 }}
                                </option>
                            @endfor
                        </select>
                    </div>  

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="last_name">Last Name:</label>
                                <input type="text" name="last_name" class="form-control" placeholder="Last Name" value="{{ old('last_name', $student->last_name) }}" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="first_name">First Name:</label>
                                <input type="text" name="first_name" class="form-control" placeholder="First Name" value="{{ old('first_name', $student->first_name) }}" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="middle_name">Middle Name:</label>
                                <input type="text" name="middle_name" class="form-control" placeholder="Middle Name" value="{{ old('middle_name', $student->middle_name) }}">
                            </div>
                        </div>
                    </div>

                    <!-- Student ID (read-only for editing purposes) -->
                    <div class="form-group">
                        <label for="student_id">Student ID</label>
                        <input type="text" name="student_id" id="student_id" class="form-control" value="{{ old('student_id', $student->student_id) }}" required readonly>
                    </div>
                    
                    <div class="form-group">
                        <label for="college_year_level">College Year Level</label>
                        <select id="college_year_level" name="college_year_level" class="form-control">
                            <option value="1st Year" {{ old('college_year_level', $student->college_year_level) == '1st Year' ? 'selected' : '' }}>1st Year</option>
                            <option value="2nd Year" {{ old('college_year_level', $student->college_year_level) == '2nd Year' ? 'selected' : '' }}>2nd Year</option>
                            <option value="3rd Year" {{ old('college_year_level', $student->college_year_level) == '3rd Year' ? 'selected' : '' }}>3rd Year</option>
                            <option value="4th Year" {{ old('college_year_level', $student->college_year_level) == '4th Year' ? 'selected' : '' }}>4th Year</option>
 </select>
                    </div>

                    <!-- Student Type -->
                    <div class="form-group">
                        <label for="student_type">Student Type (Optional):</label>
                        <select name="student_type" id="student_type" class="form-control">
                            <option value="">Select Student Type</option>
                            <option value="New Student" {{ old('student_type', $student->student_type) == 'New Student' ? 'selected' : '' }}>New Student</option>
                            <option value="Returning Student" {{ old('student_type', $student->student_type) == 'Returning Student' ? 'selected' : '' }}>Returning Student</option>
                            <option value="Continuing Student" {{ old('student_type', $student->student_type) == 'Continuing Student' ? 'selected' : '' }}>Continuing Student</option>
                            <option value="Transfer Student" {{ old('student_type', $student->student_type) == 'Transfer Student' ? 'selected' : '' }}>Transfer Student</option>
                            <option value="Working Student" {{ old('student_type', $student->student_type) == 'Working Student' ? 'selected' : '' }}>Working Student</option>
                        </select>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="age">Age:</label>
                                <input type="number" name="age" class="form-control" placeholder="Age" value="{{ old('age', $student->age) }}" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="sex">Sex:</label>
                                <select name="sex" class="form-control" required>
                                    <option value="Male" {{ old('sex', $student->sex) == 'Male' ? 'selected' : '' }}>Male</option>
                                    <option value="Female" {{ old('sex', $student->sex) == 'Female' ? 'selected' : '' }}>Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="program">Program:</label>
                                <select name="program" class="form-control" required>
                                    <option value="BSIT" {{ old('program', $student->program) == 'BSIT' ? 'selected' : '' }}>BSIT</option>
                                    <option value="Engineering" {{ old('program', $student->program) == 'Engineering' ? 'selected' : '' }}>Engineering</option>
                                    <option value="BLIS" {{ old('program', $student->program) == 'BLIS' ? 'selected' : '' }}>BLIS</option>
                                    <option value="COMSCI" {{ old('program', $student->program) == 'COMSCI' ? 'selected' : '' }}>COMSCI</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="address">Address:</label>
                        <input type="text" name="address" class="form-control" placeholder="Address" value="{{ old('address', $student->address) }}" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Email (Optional):</label>
                                <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email', $student->email) }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="contact_no">Contact No.:</label>
                                <input type="text" name="contact_no" class="form-control" placeholder="Contact No." value="{{ old('contact_no', $student->contact_no) }}" required>
                            </div>
                        </div>
                    </div>

                    <h3>Family Information</h3>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="father_name">Father's Name:</label>
                                <input type="text" name="father_name" class="form-control" placeholder="Father's Name" value="{{ old('father_name', $student->father_name) }}" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="father_contact_no">Father's Contact No.:</label>
                                <input type="text" name="father_contact_no" class="form-control" placeholder="Father's Contact No." value="{{ old('father_contact_no', $student->father_contact_no) }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="mother_name">Mother's Name:</label>
                                <input type="text" name="mother_name" class="form-control" placeholder="Mother's Name" value="{{ old('mother_name', $student->mother_name) }}" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="mother_contact_no">Mother's Contact No.:</label>
                                <input type="text" name="mother_contact_no" class="form-control" placeholder="Mother's Contact No." value="{{ old('mother_contact_no', $student->mother_contact_no) }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="guardian_name">Guardian:</label>
                                <input type="text" name="guardian_name" class="form-control" placeholder="Guardian's Name" value="{{ old('guardian_name', $student->guardian_name) }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="guardian_contact_no">Guardian's Contact No.:</label>
                                <input type="text" name="guardian_contact_no" class="form-control" placeholder="Guardian's Contact No." value="{{ old('guardian_contact_no', $student->guardian_contact_no) }}">
                            </div>
                        </div>
                    </div>

                    <h3>Educational Background</h3>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="high_school_name">High School Name:</label>
                                <input type="text" name="high_school_name" class="form-control" placeholder="High School Name" value="{{ old('high_school_name', $student->high_school_name) }}" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="high_school_address">High School Address:</label>
                                <input type="text" name="high_school_address" class="form-control" placeholder="High School Address" value="{{ old('high_school_address', $student->high_school_address) }}" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="elementary_school_name">Elementary School Name:</label>
                                <input type="text" name="elementary_school_name" class="form-control" placeholder="Elementary School Name" value="{{ old('elementary_school_name', $student->elementary_school_name) }}" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="elementary_school_address">Elementary School Address:</label>
                                <input type="text" name="elementary_school_address" class="form-control" placeholder="Elementary School Address" value="{{ old('elementary_school_address', $student->elementary_school_address) }}" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="previous_college">Previous College:</label>
                        <input type="text" name="previous_college" class="form-control" placeholder="Previous College" value="{{ old('previous_college', $student->previous_college) }}">
                    </div>

                    <div class="form-group">
                        <label for="highest_level_completed">Highest Level Completed:</label>
                        <select name="highest_level_completed" class="form-control" required>
                            <option value="High School" {{ old('highest_level_completed', $student->highest_level_completed) == 'High School' ? 'selected' : '' }}>High School</option>
                            <option value="College" {{ old('highest_level_completed', $student->highest_level_completed) == 'College' ? 'selected' : '' }}>College</option>
                        </select>
                    </div>

                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-success">Update Student Info</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
 </div>
@endsection