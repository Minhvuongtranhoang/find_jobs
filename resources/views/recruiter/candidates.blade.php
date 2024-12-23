<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Candidates</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="styleSheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="styleSheet">
    <style>
        /* Include the same styles as in recruiter.blade.php */
        :root {
            --primary-rgb: 59, 113, 202;
            --secondary-rgb: 24, 40, 72;
            --sidebar-width: 280px;
            --topbar-height: 70px;
            --transition-speed: 0.3s;
        }

        body {
            min-height: 100vh;
            background-color: #f8f9fa;
            font-family: 'Inter', sans-serif;
            overflow-x: hidden;
        }

        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            background: linear-gradient(145deg,
                rgba(var(--primary-rgb), 0.95) 0%,
                rgba(var(--secondary-rgb), 0.95) 100%);
            backdrop-filter: blur(10px);
            transition: transform var(--transition-speed) ease;
            z-index: 1040;
            overflow-y: auto;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 3px;
        }

        .brand {
            height: var(--topbar-height);
            display: flex;
            align-items: center;
            padding: 0 1.5rem;
            color: white;
            font-size: 1.5rem;
            font-weight: 600;
            letter-spacing: 0.5px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .brand i {
            font-size: 1.75rem;
            margin-right: 0.75rem;
        }

        .nav-menu {
            padding: 1.5rem 1rem;
        }

        .nav-link {
            color: rgba(255, 255, 255, 0.8);
            padding: 0.875rem 1.25rem;
            border-radius: 10px;
            margin-bottom: 0.5rem;
            transition: all var(--transition-speed) ease;
            font-weight: 500;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
        }

        .nav-link i {
            width: 1.5rem;
            font-size: 1.1rem;
            margin-right: 1rem;
            text-align: center;
        }

        .nav-link:hover {
            color: white;
            background: rgba(255, 255, 255, 0.1);
            transform: translateX(5px);
        }

        .nav-link.active {
            color: white;
            background: rgba(255, 255, 255, 0.15);
        }

        .nav-link.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 4px;
            background: white;
            border-radius: 0 2px 2px 0;
        }

        .main-content {
            margin-left: var(--sidebar-width);
            padding: 2rem;
            min-height: 100vh;
            transition: margin var(--transition-speed) ease;
        }

        .topbar {
            height: var(--topbar-height);
            background: white;
            position: sticky;
            top: 0;
            left: var(--sidebar-width);
            right: 0;
            z-index: 1030;
            display: flex;
            align-items: center;
            padding: 0 2rem;
            margin: -2rem -2rem 2rem;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.04);
        }

        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
            transition: transform var(--transition-speed) ease,
                      box-shadow var(--transition-speed) ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background: none;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            padding: 1.5rem;
        }

        .card-body {
            padding: 1.5rem;
        }

        .form-control, .form-select {
            padding: 0.75rem 1rem;
            border-radius: 10px;
            border: 2px solid #edf2f7;
            font-size: 0.95rem;
            transition: all var(--transition-speed) ease;
        }

        .form-control:focus, .form-select:focus {
            border-color: rgba(var(--primary-rgb), 0.5);
            box-shadow: 0 0 0 4px rgba(var(--primary-rgb), 0.1);
        }

        .btn {
            padding: 0.75rem 1.5rem;
            border-radius: 10px;
            font-weight: 500;
            transition: all var(--transition-speed) ease;
        }

        .btn-primary {
            background: rgb(var(--primary-rgb));
            border: none;
        }

        .btn-primary:hover {
            background: rgba(var(--primary-rgb), 0.9);
            transform: translateY(-2px);
        }

        .status-badge {
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-size: 0.875rem;
            font-weight: 500;
        }

        .status-approved {
            background: #dcfce7;
            color: #166534;
        }

        .status-pending {
            background: #fef3c7;
            color: #92400e;
        }

        .status-rejected {
            background: #fee2e2;
            color: #991b1b;
        }

        .table {
            margin-bottom: 0;
        }

        .table th {
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.5px;
            padding: 1rem 1.5rem;
            background: #f8fafc;
            border-bottom: 2px solid #edf2f7;
        }

        .table td {
            padding: 1rem 1.5rem;
            vertical-align: middle;
        }

        .toggle-sidebar {
            display: none;
            position: fixed;
            top: 1rem;
            left: 1rem;
            z-index: 1050;
            padding: 0.5rem;
            border-radius: 10px;
            background: rgb(var(--primary-rgb));
            border: none;
            color: white;
            box-shadow: 0 4px 12px rgba(var(--primary-rgb), 0.3);
        }

        .search-box {
            position: relative;
            max-width: 400px;
        }

        .search-box .form-control {
            padding-left: 3rem;
            background: #f8fafc;
            border: none;
        }

        .search-box i {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
        }

        @media (max-width: 1199.98px) {
            :root {
                --sidebar-width: 240px;
            }
        }

        @media (max-width: 991.98px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
                padding-top: calc(var(--topbar-height) + 2rem);
            }

            .toggle-sidebar {
                display: block;
            }

            .topbar {
                left: 0;
            }
        }

        @media (max-width: 767.98px) {
            .main-content {
                padding: 1rem;
            }

            .topbar {
                padding: 0 1rem;
                margin: -1rem -1rem 1rem;
            }

            .card-body {
                padding: 1rem;
            }

            .table-responsive .table {
                min-width: 800px;
            }
        }

        .fade-in {
            animation: fadeIn 0.3s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1035;
            backdrop-filter: blur(4px);
            transition: opacity var(--transition-speed) ease;
        }

        @media (max-width: 991.98px) {
            .sidebar-overlay.show {
                display: block;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar Toggle Button -->
    <button class="toggle-sidebar">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="brand">
            <i class="fas fa-building"></i>
            Recruiter Pro
        </div>
        <nav class="nav-menu">
            <a href="{{ route('recruiter.dashboard') }}" class="nav-link {{ request()->routeIs('recruiter.dashboard') ? 'active' : '' }}">
                <i class="fas fa-home"></i>
                Dashboard
            </a>
            <a href="{{ route('recruiter.jobs.index') }}" class="nav-link {{ request()->routeIs('recruiter.jobs.*') ? 'active' : ''}}">
                <i class="fas fa-briefcase"></i>
                Manage Jobs
            </a>
            <a href="{{ route('recruiter.applications.index') }}" class="nav-link {{ request()->routeIs('recruiter.applications.*') ? 'active' : '' }}">
                <i class="fas fa-file-alt"></i>
                Applications
            </a>
            <a href="{{ route('recruiter.candidates.index') }}" class="nav-link {{ request()->routeIs('recruiter.candidates.*') ? 'active' : '' }}">
                <i class="fas fa-users"></i>
                Candidates
            </a>
            <a href="#" class="nav-link">
                <i class="fas fa-chart-bar"></i>
                Reports
            </a>
            <a href="#" class="nav-link">
                <i class="fas fa-calendar"></i>
                Schedule
            </a>
            <a href="#" class="nav-link">
                <i class="fas fa-cog"></i>
                Settings
            </a>

            <form action="{{route('logout')}}" method="POST" class="mt-auto">
                @csrf
                <button class="nav-link text-danger">
                    <i class="fas fa-sign-out-alt"></i>
                    Logout
                </button>
            </form>
        </nav>
    </div>

    <!-- Overlay for Mobile -->
    <div class="sidebar-overlay"></div>

    <div class="main-content">
        <div class="topbar">
            <div class="d-flex align-items-center justify-content-between w-100">
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" class="form-control" placeholder="Search...">
                </div>
                <div class="d-flex align-items-center gap-3">
                    <button class="btn btn-light position-relative">
                        <i class="fas fa-bell"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            3
                        </span>
                    </button>
                    <div class="dropdown">
                        <button class="btn btn-light rounded-circle" data-bs-toggle="dropdown">
                            <i class="fas fa-user"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('recruiter.company.edit')}} {{ request()->routeIs('recruiter.company.*') ? 'active' : ''}}"><i class="fas fa-user me-2"></i>Profile</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i>Settings</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger" href="#"><i class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <h1 class="mb-4">Candidates</h1>
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Candidate List</h5>
                </div>
                <div class="card-body">
                    <table class="table table-responsive">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Example row -->
                            <tr>
                                <td>John Doe</td>
                                <td>john.doe@example.com</td>
                                <td>(123) 456-7890</td>
                                <td><span class="status-badge status-approved">Approved</span></td>
                                <td>
                                    <button class="btn btn-sm btn-primary">View</button>
                                    <button class="btn btn-sm btn-danger">Delete</button>
                                </td>
                            </tr>
                            <!-- Add more rows as needed -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
<script>
    document.querySelector('.toggle-sidebar').addEventListener('click', function() {
        document.querySelector('.sidebar').classList.toggle('show');
        document.querySelector('.sidebar-overlay').classList.toggle('show');
    });

    document.querySelector('.sidebar-overlay').addEventListener('click', function() {
        document.querySelector('.sidebar').classList.remove('show');
        document.querySelector('.sidebar-overlay').classList.remove('show');
    });

    window.addEventListener('resize', function() {
        if (window.innerWidth > 991.98) {
            document.querySelector('.sidebar').classList.remove('show');
            document.querySelector('.sidebar-overlay').classList.remove('show');
        }
    });

    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    document.querySelectorAll('.card').forEach(function(card) {
        card.classList.add('fade-in');
    });
</script>
</body>
</html>
