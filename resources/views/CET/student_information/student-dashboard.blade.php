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

@section('css')
<style>
    /* Global Body Styles */
    body {
        font-family: 'Poppins', sans-serif; /* Modern, clean font */
        background-color: #f3f6f9; /* Subtle gray for a polished look */
        margin: 0;
        color: #2e2e2e; /* Neutral text color */
    }

    /* Dashboard Container */
    .dashboard-container {
        padding: 20px;
        display: flex;
        justify-content: center;
        align-items: flex-start;
        min-height: 100vh;
    }

    /* Stats Section */
    .dashboard-stats {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); /* Flexible grid layout */
        gap: 20px; /* Space between cards */
        width: 100%;
        max-width: 1200px; /* Limit the width of the grid */
        margin: 0 auto; /* Center the grid */
    }

    /* Stat Card Design */
    .stat-card {
        background: #ffffff;
        padding: 40px;
        margin: 0;
        text-align: center;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        color: #2e2e2e;
        transition: transform 0.3s ease, box-shadow 0.3s ease, background-color 0.3s ease;
        text-decoration: none; /* Remove underline from links */
        position: relative; /* For pseudo-element positioning */
        overflow: hidden; /* To contain the pseudo-element */
    }

    .stat-card h3 {
        font-size: 1.8rem; /* Increased font size for better visibility */
        font-weight: 600;
        margin-bottom: 15px;
        color: #333333;
    }

    /* Hover Effect */
    .stat-card:hover {
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        background: linear-gradient(135deg , #ffffff, #eceff1); /* Subtle gradient */
        transform: translateY(-5px); /* Lift effect */
    }

    /* Pseudo-element for card decoration */
    .stat-card::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.05); /* Light overlay */
        border-radius: 12px;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .stat-card:hover::after {
        opacity: 1; /* Show overlay on hover */
    }

    /* Mobile Responsive */
    @media (max-width: 768px) {
        .stat-card {
            padding: 30px;
        }

        .stat-card h3 {
            font-size: 1.6rem; /* Adjust font size for smaller screens */
        }
    }
</style>
@endsection 