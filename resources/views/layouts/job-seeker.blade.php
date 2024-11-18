<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Portal</title>
    <!-- Bootstrap CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">

<!-- Font Awesome (nếu cần) -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

<!-- Custom CSS -->
<link href="{{ asset('css/job-seeker.css') }}" rel="stylesheet">

<!-- Bootstrap Select CSS -->
{{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select/dist/css/bootstrap-select.min.css"> --}}

<!-- jQuery (Load before any Bootstrap JS or Select JS) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>

<!-- Bootstrap Select JS -->
{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap-select/dist/js/bootstrap-select.min.js"></script> --}}



</head>

<body>
    <!-- Modern Header -->
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
<<<<<<< HEAD
            <a class="navbar-brand" href="{{ route('home') }}">Seek a<span class="highlight">Job</span></a>
=======
            <a class="navbar-brand" href="{{ route('home') }}"><img src="{{ asset('storage/company-logos/logo.png') }}"
                    style="height: 50px; width: 50px;"></a>
>>>>>>> d7fef1c9e8b51ffff71d1b08b830a42bc4f16323
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">Trang chủ</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="jobsDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">Việc làm</a>
                        <ul class="dropdown-menu" aria-labelledby="jobsDropdown">
                            <li><a class="dropdown-item" href="{{ route('saved-jobs') }}">Công việc đã lưu</a></li>
                            <li><a class="dropdown-item" href="{{ route('latest-jobs') }}">Công việc mới nhất</a></li>
                            <li><a class="dropdown-item" href="{{ route('job-applications') }}">Công việc đã ứng
                                    tuyển</a></li>
                            <li><a class="dropdown-item" href="#">Công việc phù hợp</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="companiesDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">Công ty</a>
                        <ul class="dropdown-menu" aria-labelledby="companiesDropdown">
                            <li><a class="dropdown-item" href="{{ route('companies.index') }}">Danh sách công ty</a>
                            </li>
                            <li><a class="dropdown-item" href="{{ route('companies.top') }}">Công ty Hàng đầu</a></li>
                            <li><a class="dropdown-item" href="#">Công ty Công nghệ</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('help') }}">Trợ giúp</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('contact') }}">Liên lạc</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('about') }}">Về chúng tôi</a>
                    </li>
                </ul>
                <div class="d-flex gap-2">
                    @auth
                        <!-- Hiển thị tên người dùng khi đã đăng nhập -->
                        <div class="dropdown">
                            <button class="btn btn-outline-primary dropdown-toggle" type="button" id="userMenu"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                {{ Auth::user()->JobSeeker->full_name ?? 'Người dùng' }}

                            </button>
                            <ul class="dropdown-menu" aria-labelledby="userMenu">
                                <li><a class="dropdown-item" href="{{ route('profile') }}">Thông tin cá nhân</a></li>
                                <li><a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Đăng
                                        xuất</a></li>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </ul>
                        </div>
                    @else
                        <!-- Hiển thị nút Đăng nhập và Đăng ký khi chưa đăng nhập -->
                        <button class="btn btn-outline-primary" onclick="window.location.href='{{ route('login') }}'">Đăng
                            nhập</button>
                        <button class="btn btn-primary"
                            onclick="window.location.href='{{ route('register.job-seeker') }}'">Đăng ký</button>
                    @endauth
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
                    <h5 class="mb-4">Về Seek a Job</h5>
                    <p>Nền tảng tuyển dụng IT hàng đầu Việt Nam, kết nối ứng viên với các cơ hội việc làm tốt nhất từ
                        những công ty công nghệ hàng đầu.</p>
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
                        <li class="mb-2"><a href="#" class="text-light text-decoration-none">Trang chủ</a>
                        </li>
                        <li class="mb-2"><a href="#" class="text-light text-decoration-none">Việc làm</a>
                        </li>
                        <li class="mb-2"><a href="#" class="text-light text-decoration-none">Công ty</a></li>
                        <li class="mb-2"><a href="#" class="text-light text-decoration-none">Trợ giúp</a>
                        </li>
                        <li class="mb-2"><a href="#" class="text-light text-decoration-none">Liên lạc</a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <h5 class="mb-4">Danh mục việc làm</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#" class="text-light text-decoration-none">Frontend
                                Development</a></li>
                        <li class="mb-2"><a href="#" class="text-light text-decoration-none">Backend
                                Development</a></li>
                        <li class="mb-2"><a href="#" class="text-light text-decoration-none">Full Stack
                                Development</a></li>
                        <li class="mb-2"><a href="#" class="text-light text-decoration-none">DevOps
                                Engineering</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h5 class="mb-4">Liên hệ</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><i class="fas fa-map-marker-alt me-2"></i>Tòa nhà Innovation, Khu Công nghệ
                            cao, Hà Nội</li>
                        <li class="mb-2"><i class="fas fa-phone me-2"></i>(+84) 123-456-789</li>
                        <li class="mb-2"><i class="fas fa-envelope me-2"></i>seekajob2024@gmail.com</li>
                    </ul>
                </div>
            </div>
            <hr class="my-4">
            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-start">
                    <p class="mb-0">&copy; 2024 Seek a Job. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <a href="{{ route('terms-of-service') }}" class="text-light text-decoration-none me-3">Điều khoản
                        sử dụng</a>
                    <a href="{{ route('privacy-policy') }}" class="text-light text-decoration-none">Chính sách bảo
                        mật</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    

    <script>
        // Initialize tooltips
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        const tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });

        // Favorite job functionality

        function toggleFavorite(jobId, element) {
            $.ajax({
                url: '{{ route('save-job') }}',
                type: 'POST',
                data: {
                    job_id: jobId,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.status === 'saved') {
                        $(element).find('i').removeClass('far').addClass('fas'); // Đổi trái tim rỗng thành đầy
                    } else if (response.status === 'removed') {
                        $(element).find('i').removeClass('fas').addClass('far'); // Đổi trái tim đầy thành rỗng
                    }
                },
                error: function() {
                    alert('Vui Lòng Đăng Nhập');
                }
            });
        }



        // Smooth scroll
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
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
