@extends('CET.layouts.header')

@section('content')
<div class="container-fluid" style="background-image: url('{{ asset('logo.png') }}'); background-size: cover; background-position: center; padding: 20px; min-height: 100vh;">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card" style="background: rgba(255, 255, 255, 0.9); border-radius: 10px; padding: 20px;">
                <div class="text-center mb-4">
                    <h1 style="color: black;">ENROLLMENT FORM</h1>
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

                <!-- Enrollment Form -->
                <form id="studentForm" action="{{ route('students.store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="school_year">School Year:</label>
                        <select name="school_year" class="form-control form-control-sm" required>
                            @for ($year = 2023; $year <= 2040; $year++)
                                <option value="{{ $year }}-{{ $year + 1 }}" {{ old('school_year') == "$year-".($year + 1) ? 'selected' : '' }}>
                                    {{ $year }}-{{ $year + 1 }}
                                </option>
                            @endfor
                        </select>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="last_name">Last Name:</label>
                                <input type="text" name="last_name" class="form-control" placeholder="Last Name" value="{{ old('last_name') }}" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="first_name">First Name:</label>
                                <input type="text" name="first_name" class="form-control" placeholder="First Name" value="{{ old('first_name') }}" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="middle_name">Middle Name:</label>
                                <input type="text" name="middle_name" class="form-control" placeholder="Middle Name" value="{{ old('middle_name') }}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="student_id">Student ID</label>
                        <input type="text" name="student_id" id="student_id" class="form-control" value="{{ old('student_id') }}" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="college_year_level">College Year Level</label>
                        <select id="college_year_level" name="college_year_level" class="form-control" required>
                            <option value="">Select Year Level</option>
                            <option value="1st Year">1st Year</option>
                            <option value="2nd Year">2nd Year</option>
                            <option value="3rd Year">3rd Year</option>
                            <option value="4th Year">4th Year</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="student_type">Student Type (Optional):</label>
                        <select name="student_type" id="student_type" class="form-control">
                            <option value="">Select Student Type</option>
                            <option value="New Student" {{ old('student_type') == 'New Student' ? 'selected' : '' }}>New Student</option>
                            <option value="Returning Student" {{ old('student_type') == 'Returning Student' ? 'selected' : '' }}>Returning Student</option>
                            <option value="Continuing Student" {{ old('student_type') == 'Continuing Student' ? 'selected' : '' }}>Continuing Student</option>
                            <option value="Transfer Student" {{ old('student_type') == 'Transfer Student' ? 'selected' : '' }}>Transfer Student</option>
                            <option value="Working Student" {{ old('student_type') == 'Working Student' ? 'selected' : '' }}>Working Student</option>
                        </select>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="age">Age:</label>
                                <input type="number" name="age" class="form-control" placeholder="Age" value="{{ old('age') }}" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="sex">Sex:</label>
                                <select name="sex" class="form-control" required>
                                    <option value="Male" {{ old('sex') == 'Male' ? 'selected' : '' }}>Male</option>
                                    <option value="Female" {{ old('sex') == 'Female' ? 'selected' : '' }}>Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="program">Program:</label>
                                <select name="program" class="form-control" required>
                                    <option value="BSIT" {{ old('program') == 'BSIT' ? 'selected' : '' }}>BSIT</option>
                                    <option value="Engineering" {{ old('program') == 'Engineering' ? 'selected' : '' }}>Engineering</option>
                                    <option value="BLIS" {{ old('program') == 'BLIS' ? 'selected' : '' }}>BLIS</option>
                                    <option value="COMSCI" {{ old('program') == 'COMSCI' ? 'selected' : '' }}>COMSCI</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="address">Address:</label>
                        <input type="text" name="address" class="form-control" placeholder="Address" value="{{ old('address') }}" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="contact_no">Contact No.:</label>
                                <input type="text" name="contact_no" class="form-control" placeholder="Contact No." value="{{ old('contact_no') }}" required>
                            </div>
                        </div>
                    </div>

                    <h3 style="color: black;">Family Information</h3>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="father_name">Father's Name:</label>
                                <input type="text" name="father_name" class="form-control" placeholder="Father's Name" value="{{ old('father_name') }}" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="father_contact_no">Father's Contact No.:</label>
                                <input type="text" name="father_contact_no" class="form-control" placeholder="Father's Contact No." value="{{ old('father_contact_no') }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="mother_name">Mother's Name:</label>
                                <input type="text" name="mother_name" class="form-control" placeholder="Mother's Name" value="{{ old('mother_name') }}" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="mother_contact_no">Mother's Contact No.:</label>
                                <input type="text" name="mother_contact_no" class="form-control" placeholder="Mother's Contact No." value="{{ old('mother_contact_no') }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="guardian_name">Guardian:</label>
                                <input type="text" name="guardian_name" class="form-control" placeholder="Guardian's Name" value="{{ old('guardian_name') }}" required>
                            </div>
                    
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="guardian_contact_no">Guardian Contact No.:</label>
                                <input type="text" name="guardian_contact_no" class="form-control" placeholder="Guardian's Contact No." value="{{ old('guardian_contact_no') }}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="guardian_address">Guardian Address:</label>
                        <input type="text" name="guardian_address" class="form-control" placeholder="Guardian's Address" value="{{ old('guardian_address') }}">
                    </div>

                    <h3 style="color: black;">Educational Background</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="high_school_name">High School Name:</label>
                                <input type="text" name="high_school_name" class="form-control" placeholder="High School Name" value="{{ old('high_school_name') }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="high_school_address">High School Address:</label>
                                <input type="text" name="high_school_address" class="form-control" placeholder="High School Address" value="{{ old('high_school_address') }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="elementary_school_name">Elementary School Name:</label>
                                <input type="text" name="elementary_school_name" class="form-control" placeholder="Elementary School Name" value="{{ old('elementary_school_name') }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="elementary_school_address">Elementary School Address:</label>
                                <input type="text" name="elementary_school_address" class="form-control" placeholder="Elementary School Address" value="{{ old('elementary_school_address') }}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="previous_college">Previous College (if applicable):</label>
                        <input type="text" name="previous_college" class="form-control" placeholder="Previous College" value="{{ old('previous_college') }}">
                    </div>
                    <div class="form-group">
                        <label for="highest_level_completed">Highest Level Completed:</label>
                        <select name="highest_level_completed" class="form-control" required>
                            <option value="High School" {{ old('highest_level_completed') == 'High School' ? 'selected' : '' }}>High School</option>
                            <option value="Undergraduate" {{ old('highest_level_completed') == 'Undergraduate' ? 'selected' : '' }}>Undergraduate</option>
                            <option value="Graduate" {{ old('highest_level_completed') == 'Graduate' ? 'selected' : '' }}>Graduate</option>
                        </select>
                    </div>

                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">Add Student</button>
                    </div>
                </form>

                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                <script>
                    document.getElementById('studentForm').addEventListener('submit', function(event) {
                        event.preventDefault();
                        var form = event.target;
                        var formData = new FormData(form);

                        fetch(form.action, {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success!',
                                    text: 'Student added successfully.',
                                }).then(() => {
                                    window.location.href = "{{ route('students.create') }}";
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error!',
                                    text: data.message,
                                });
                            }
                        })
                        .catch(error => {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: 'An error occurred while processing your request.',
                            });
                        });
                    });
                </script>
            </div>
        </div>
    </div>
</div>
@endsection