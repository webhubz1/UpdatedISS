@extends('CET.layouts.header')

@section('content')
<div class="content">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Dashboard</h1>
                </div>
                <div class="col-sm-6 d-flex justify-content-end align-items-center">
                    <!-- You can add buttons or links here if needed -->
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 mt-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="dashboard-container">
                                <!-- Main Content -->
                                <section class="dashboard-stats">
                                    <a href="{{ route('students.program', ['program' => 'BSIT', 'school_year' => date('Y')]) }}" class="stat-card">
                                        <h3>BSIT</h3>
                                    </a>
                                    <a href="{{ route('students.program', ['program' => 'COMSCI', 'school_year' => date('Y')]) }}" class="stat-card">
                                        <h3>COMSCI</h3>
                                    </a>
                                    <a href="{{ route('students.program', ['program' => 'BLIS', 'school_year' => date('Y')]) }}" class="stat-card">
                                        <h3>BLIS</h3>
                                    </a>
                                    <a href="{{ route('students.program', ['program' => 'ENGINEERING', 'school_year' => date('Y')]) }}" class="stat-card">
                                        <h3>ENGINEERING</h3>
                                    </a>
                                </section>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
@endsection

