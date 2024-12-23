<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - @yield('title', 'Find Jobs')</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="styleSheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="styleSheet">
    <link href="{{ asset('css/admin-recruiter.css') }}"rel="styleSheet">
</head>
<body>
    <!-- Sidebar Toggle Button -->
    <button class="toggle-sidebar">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
      <div class="brand">
        <i class="fas fa-building"></i>
        Admin Pro
      </div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link dropdown-toggle {{ request()->routeIs('admin.users.*') ? 'active' : '' }}" href="#" id="userManagementDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-users"></i>
                    <span>User Management</span>
                </a>
                <ul class="dropdown-menu" aria-labelledby="userManagementDropdown">
                  <li><a class="dropdown-item" href="{{ route('admin.users.recruiters') }}">Recruiter</a></li>
                  <li><a class="dropdown-item" href="{{ route('admin.users.jobseekers') }}">Jobseeker</a></li>
                  <li><a class="dropdown-item" href="">Ban Account</a></li>

              </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.jobs.pending') ? 'active' : '' }}" href="{{ route('admin.jobs.pending') }}">
                    <i class="fas fa-clock"></i>
                    <span>Pending Jobs</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.jobs.approved') ? 'active' : '' }}" href="{{ route('admin.jobs.approved') }}">
                    <i class="fas fa-check-circle"></i>
                    <span>Approved Jobs</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}" href="{{ route('admin.categories.index') }}">
                    <i class="fas fa-tags"></i>
                    <span>Categories</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.reports.*') ? 'active' : '' }}" href="{{ route('admin.reports.index') }}">
                    <i class="fas fa-flag"></i>
                    <span>Reports Management</span>
                </a>

            <li class="nav-item">
                <a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </a>
            </li>
        </ul>
    </div>

    <!-- Overlay for Mobile -->
    <div class="sidebar-overlay"></div>

    <!-- Main Content -->
    <div class="main-content" id="main-content">
        @yield('content')
    </div>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle Sidebar
        document.querySelector('.toggle-sidebar').addEventListener('click', function() {
            document.querySelector('.sidebar').classList.toggle('show');
            document.querySelector('.sidebar-overlay').classList.toggle('show');
        });

        // Close Sidebar on Overlay Click
        document.querySelector('.sidebar-overlay').addEventListener('click', function() {
            document.querySelector('.sidebar').classList.remove('show');
            document.querySelector('.sidebar-overlay').classList.remove('show');
        });

        // Handle Window Resize
        window.addEventListener('resize', function() {
            if (window.innerWidth > 991.98) {
                document.querySelector('.sidebar').classList.remove('show');
                document.querySelector('.sidebar-overlay').classList.remove('show');
            }
        });

        // Initialize Tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });

        // Add fade-in animation to cards
        document.querySelectorAll('.card').forEach(function(card) {
            card.classList.add('fade-in');
        });
    </script>

    @stack('scripts')
</body>
</html>
