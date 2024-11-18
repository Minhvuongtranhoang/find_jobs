<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern Recruiter Dashboard</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('css/admin-recruiter.css') }}" rel="stylesheet">
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
            <a href="{{ route('recruiter.applications.index') }}" class="nav-link {{ request()->routeIs('recruiter.applications.*') ? 'active' : '' }}" target="_self">
              <i class="fas fa-file-alt"></i>
              Applications
          </a>
            <a href="#" class="nav-link">
                <i class="fas fa-users"></i>
                Candidates
            </a>
            <a href="{{ url('job-seeker/home') }}" class="nav-link">
                <i class="fas fa-chart-bar"></i>
                Reports
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
            @yield('content')
      </div>


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
