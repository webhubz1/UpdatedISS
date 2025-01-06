@extends('CET.layouts.header')

@section('content')
<div class="container">
    <!-- Form to filter by school year -->
    <div class="card mb-4">
        <div class="card-header">
            <h3 class="card-title">Filter Students</h3>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('students.program', ['program' => $program]) }}">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="school_year">School Year:</label>
                            <select name="school_year" id="school_year" class="form-control">
                                <option value="">Select School Year</option>
                                @foreach (range(2023, 2030) as $year)
                                    <option value="{{ $year }}-{{ $year + 1 }}" {{ request('school_year') == "{$year}-" . ($year + 1) ? 'selected' : '' }}>
                                        {{ $year }}-{{ $year + 1 }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="college_year_level">College Year Level:</label>
                            <select name="college_year_level" id="college_year_level" class="form-control">
                                <option value="">Select College Year Level</option>
                                <option value="1st Year" {{ request('college_year_level') == '1st Year' ? 'selected' : '' }}>1st Year</option>
                                <option value="2nd Year" {{ request('college_year_level') == '2nd Year' ? 'selected' : '' }}>2nd Year</option>
                                <option value="3rd Year" {{ request('college_year_level') == '3rd Year' ? 'selected' : '' }}>3rd Year</option>
                                <option value="4th Year" {{ request('college_year_level') == '4th Year' ? 'selected' : '' }}>4th Year</option>
                            </select>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Filter</button>
            </form>
        </div>
    </div>

    <!-- Displaying program and school year details only if filtered -->
    @if(request('school_year'))
        <div class="card mb-4">
            <div class="card-header">
                <h2>{{ $program }} Students</h2>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <h4>School Year: <strong>{{ request('school_year') }}</strong></h4>
                    <h4>Year Level: <strong>{{ request('college_year_level') }}</strong></h4>
                </div>

                <div class="total-students mb-3">
                    <h3>Total Students: <strong>{{ $totalStudents }}</strong></h3>
                </div>

                <!-- Student list organized in a table format -->
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Student ID</th>
                            <th>Year Level</th>
                            <th>School Year</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($students as $student)
                            <tr>
                                <td>{{ $student->first_name }} {{ $student->last_name }}</td>
                                <td>{{ $student->student_id }}</td>
                                <td>{{ $student->college_year_level }}</td>
                                <td>{{ $student->school_year }}</td>
                                <td>
                                    <a href="{{ route('student.show', $student->id) }}" class="btn btn-info">View</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Export button only shown if there are students -->
                <div class="mb-4">
    <a href="{{ route('students.export', [
        'school_year' => request('school_year'),
        'program' => $program,
        'college_year_level' => request('college_year_level')
    ]) }}" class="btn btn-success">Export to Excel</a>
</div>
    @else
        <!-- Optionally show a message when no filter is applied -->
        <div class="alert alert-warning">
            <p>No school year selected. Please filter to see the data.</p>
        </div>
    @endif
</div>
@endsection