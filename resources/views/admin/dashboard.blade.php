@extends('layouts.admin')

@section('content')

    <nav class="navbar navbar-expand-lg navbar-light bg-white mb-4 shadow-sm">
        <div class="container-fluid">
            <button class="btn" id="sidebar-toggle">
                <i class="fas fa-bars"></i>
            </button>
            <div class="d-flex">
                <div class="dropdown">
                    <a class="btn btn-light dropdown-toggle" href="#" role="button" id="notificationDropdown" data-bs-toggle="dropdown">
                        <i class="fas fa-bell"></i>
                        <span class="badge bg-danger">3</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="notificationDropdown">
                        <li><a class="dropdown-item" href="#">New job application</a></li>
                        <li><a class="dropdown-item" href="#">New user registration</a></li>
                        <li><a class="dropdown-item" href="#">Pending job approval</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    @if(request()->routeIs('admin.dashboard'))
    <div class="container-fluid">
        <!-- Statistics Cards -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card stat-card bg-primary text-white">
                    <div class="card-body">
                        <h5 class="card-title">Job Seekers</h5>
                        <h2 class="mb-0">{{ \App\Models\User::where('role', 'job_seeker')->count() }}</h2>
                        <small>Total registered job seekers</small>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card stat-card bg-success text-white">
                    <div class="card-body">
                        <h5 class="card-title">Recruiters</h5>
                        <h2 class="mb-0">{{ \App\Models\User::where('role', 'recruiter')->count() }}</h2>
                        <small>Total registered recruiters</small>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card stat-card bg-warning text-white">
                    <div class="card-body">
                        <h5 class="card-title">Active Jobs</h5>
                        <h2 class="mb-0">{{ \App\Models\Job::where('status', 'approved')->count() }}</h2>
                        <small>Currently active job postings</small>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card stat-card bg-info text-white">
                    <div class="card-body">
                        <h5 class="card-title">Categories</h5>
                        <h2 class="mb-0">{{ \App\Models\Category::count() }}</h2>
                        <small>Total job categories</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Row -->
        <div class="row">
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Job Applications Trend</h5>
                        <div id="applicationsChart"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Popular Categories</h5>
                        <div id="categoriesChart"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection

@push('scripts')
<!-- Include ApexCharts library -->
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Sidebar Toggle
        document.getElementById('sidebar-toggle').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('sidebar-collapsed');
            document.getElementById('main-content').classList.toggle('main-content-expanded');
        });

        // Mobile Sidebar
        if (window.innerWidth <= 768) {
            document.getElementById('sidebar').classList.add('sidebar-collapsed');
            document.getElementById('main-content').classList.add('main-content-expanded');
        }

        // Initialize Charts if on dashboard
        if (document.getElementById('applicationsChart')) {
            // Applications Trend Chart
            var applicationsOptions = {
                series: [{
                    name: 'Applications',
                    data: [30, 40, 35, 50, 49, 60, 70]
                }],
                chart: {
                    type: 'area',
                    height: 350,
                    toolbar: {
                        show: false
                    }
                },
                stroke: {
                    curve: 'smooth'
                },
                xaxis: {
                    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul']
                },
                yaxis: {
                    title: {
                        text: 'Number of Applications'
                    }
                },
                tooltip: {
                    shared: true
                }
            };
            new ApexCharts(document.getElementById('applicationsChart'), applicationsOptions).render();

            // Categories Pie Chart
            var categoriesOptions = {
                series: [44, 55, 13, 43, 22],
                chart: {
                    type: 'pie',
                    height: 350
                },
                labels: ['Technology', 'Marketing', 'Sales', 'Design', 'Others'],
                responsive: [{
                    breakpoint: 480,
                    options: {
                        chart: {
                            width: 200
                        },
                        legend: {
                            position: 'bottom'
                        }
                    }
                }]
            };
            new ApexCharts(document.getElementById('categoriesChart'), categoriesOptions).render();
        }
    });
</script>
@endpush
