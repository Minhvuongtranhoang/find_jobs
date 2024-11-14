<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Portal</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('css/job-seeker.css') }}" rel="stylesheet">
</head>
<body>
  <!-- Modern Header -->
<nav class="navbar navbar-expand-lg sticky-top">
  <div class="container">
      <a class="navbar-brand" href="#">JobPortal</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
          <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav me-auto">
              <li class="nav-item">
                  <a class="nav-link" href="#">Trang chủ</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" ilid="jobsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Việc làm</a>
                <ul class="dropdown-menu" aria-labelledby="jobsDropdown">
                    <li><a class="dropdown-item" href="#">Công việc đã lưu</a></li>
                    <li><a class="dropdown-item" href="#">Công việc mới nhất</a></li>
                    <li><a class="dropdown-item" href="#">Công việc đã ứng tuyển</a></li>
                    <li><a class="dropdown-item" href="#">Công việc phù hợp</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" ilid="jobsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Công ty</a>
              <ul class="dropdown-menu" aria-labelledby="jobsDropdown">
                  <li><a class="dropdown-item" href="#">Danh sách công ty</a></li>
                  <li><a class="dropdown-item" href="#">Công ty Hàng đầu</a></li>
                  <li><a class="dropdown-item" href="#">Công ty Công nghệ</a></li>
              </ul>
            </li>
              <li class="nav-item">
                  <a class="nav-link" href="#">Trợ giúp</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Liên lạc</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Về chúng tôi</a>
              </li>
          </ul>
          <div class="d-flex gap-2">
              <button class="btn btn-outline-primary" onclick="window.location.href='{{ route('login') }}'">Đăng nhập</button>
              <button class="btn btn-primary">Đăng ký</button>
          </div>
      </div>
  </div>
</nav>

<div class="main-content">
  @yield('content')
</div>

<!-- Enhanced Footer -->
<footer class="bg-dark text-light py-5">
  <div class="container">
      <div class="row">
          <div class="col-lg-4 mb-4">
              <h5 class="mb-4">Về JobPortal</h5>
              <p>Nền tảng tuyển dụng IT hàng đầu Việt Nam, kết nối ứng viên với các cơ hội việc làm tốt nhất từ những công ty công nghệ hàng đầu.</p>
              <div class="mt-4">
                  <a href="#" class="btn btn-outline-light me-2"><i class="fab fa-facebook-f"></i></a>
                  <a href="#" class="btn btn-outline-light me-2"><i class="fab fa-twitter"></i></a>
                  <a href="#" class="btn btn-outline-light me-2"><i class="fab fa-linkedin-in"></i></a>
                  <a href="#" class="btn btn-outline-light"><i class="fab fa-instagram"></i></a>
              </div>
          </div>
          <div class="col-lg-2 col-md-6 mb-4">
              <h5 class="mb-4">Liên kết</h5>
              <ul class="list-unstyled">
                  <li class="mb-2"><a href="#" class="text-light text-decoration-none">Trang chủ</a></li>
                  <li class="mb-2"><a href="#" class="text-light text-decoration-none">Việc làm</a></li>
                  <li class="mb-2"><a href="#" class="text-light text-decoration-none">Công ty</a></li>
                  <li class="mb-2"><a href="#" class="text-light text-decoration-none">Trợ giúp</a></li>
                  <li class="mb-2"><a href="#" class="text-light text-decoration-none">Liên lạc</a></li>
              </ul>
          </div>
          <div class="col-lg-3 col-md-6 mb-4">
              <h5 class="mb-4">Danh mục việc làm</h5>
              <ul class="list-unstyled">
                  <li class="mb-2"><a href="#" class="text-light text-decoration-none">Frontend Development</a></li>
                  <li class="mb-2"><a href="#" class="text-light text-decoration-none">Backend Development</a></li>
                  <li class="mb-2"><a href="#" class="text-light text-decoration-none">Full Stack Development</a></li>
                  <li class="mb-2"><a href="#" class="text-light text-decoration-none">DevOps Engineering</a></li>
              </ul>
          </div>
          <div class="col-lg-3 col-md-6">
              <h5 class="mb-4">Liên hệ</h5>
              <ul class="list-unstyled">
                  <li class="mb-2"><i class="fas fa-map-marker-alt me-2"></i>Tòa nhà Innovation, Khu Công nghệ cao, Hà Nội</li>
                  <li class="mb-2"><i class="fas fa-phone me-2"></i>(+84) 123-456-789</li>
                  <li class="mb-2"><i class="fas fa-envelope me-2"></i>contact@jobportal.vn</li>
              </ul>
          </div>
      </div>
      <hr class="my-4">
      <div class="row align-items-center">
          <div class="col-md-6 text-center text-md-start">
              <p class="mb-0">&copy; 2024 JobPortal. All rights reserved.</p>
          </div>
          <div class="col-md-6 text-center text-md-end">
              <a href="#" class="text-light text-decoration-none me-3">Điều khoản sử dụng</a>
              <a href="#" class="text-light text-decoration-none">Chính sách bảo mật</a>
          </div>
      </div>
  </div>
</footer>

<!-- Scripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
<script>
// Initialize tooltips
const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
const tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl);
});

// Favorite job functionality
document.querySelectorAll('.favorite-icon').forEach(icon => {
    icon.addEventListener('click', function() {
        const heart = this.querySelector('i');
        heart.classList.toggle('far');
        heart.classList.toggle('fas');
        heart.classList.toggle('text-danger');
    });
});

// Smooth scroll
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        document.querySelector(this.getAttribute('href')).scrollIntoView({
            behavior: 'smooth'
        });
    });
});
</script>
@stack('scripts')
</body>
</html>
