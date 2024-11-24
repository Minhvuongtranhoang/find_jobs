<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Portal</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome (nếu cần) -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ asset('css/job-seeker.css') }}" rel="stylesheet">

    <!-- jQuery (Load before any Bootstrap JS or Select JS) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>

    <!-- Quill Editor Styles -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

    <!-- Quill Editor Script -->
    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>


</head>

<body>
    <!-- Modern Header -->
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <!-- Container thông báo -->
            <div id="notification"
                style="display: none; position: fixed; top: 20px; right: 20px; background-color: #4CAF50; color: white; padding: 10px 20px; border-radius: 5px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); z-index: 9999;">
                <span id="notification-message"></span>
                <span id="notification-close"
                    style="cursor: pointer; margin-left: 10px; font-weight: bold;">&times;</span>
            </div>
            <a class="navbar-brand" href="{{ route('home') }}">Seek a<span class="highlight">Job</span></a>
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
                    <div class="notification-wrapper">
                        <div class="notification-icon" onclick="toggleNotificationMenu()">
                            <i class="fa fa-bell"></i>
                            <span class="notification-badge" id="notificationBadge">0</span>
                        </div>
                        <div class="notification-menu" id="notificationMenu">
                            <h4>Thông báo</h4>
                            <ul id="notificationList">
                                <li>Không có thông báo mới</li>
                            </ul>
                        </div>
                    </div>
                    
                    

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
                        <button class="btn btn-outline-primary"
                            onclick="window.location.href='{{ route('login') }}'">Đăng
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


        //=====================================================================================================
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
                        showNotification('Đã lưu công việc vào danh sách yêu thích!', 'success');
                    } else if (response.status === 'removed') {
                        $(element).find('i').removeClass('fas').addClass('far'); // Đổi trái tim đầy thành rỗng
                        showNotification('Đã xóa công việc khỏi danh sách yêu thích!', 'success');
                    }
                },
                error: function() {
                    showNotification('Vui lòng đăng nhập để lưu công việc.', 'error');
                }
            });
        }

        function showNotification(message, type) {
            var notification = $('#notification');
            var notificationMessage = $('#notification-message');

            notificationMessage.text(message);

            // Thay đổi màu nền dựa trên trạng thái thành công hoặc lỗi
            if (type === 'success') {
                notification.css('background-color', '#4CAF50'); // Xanh cho thành công
            } else {
                notification.css('background-color', '#f44336'); // Đỏ cho lỗi
            }

            // Hiển thị thông báo
            notification.fadeIn();

            // Tự động ẩn sau 4 giây
            setTimeout(function() {
                notification.fadeOut();
            }, 4000);

            // Chức năng đóng thông báo
            $('#notification-close').click(function() {
                notification.fadeOut();
            });
        }


        //====================================================================================
        //Smooth scroll
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });


        //==============================================================================
        // Ajax for jobs
        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();

            let url = $(this).attr('href');
            fetchJobs(url);
        });

        function fetchJobs(url) {
            $.ajax({
                url: url,
                type: 'GET',
                success: function(response) {
                    $('#job-list').html(response.jobs);
                    $('#pagination-container').html(response.pagination);
                },
                error: function(xhr) {
                    console.error("Error fetching jobs:", xhr.responseText);
                }
            });
        }


        //============================================================
        //Quill for texteditor
        // Khởi tạo Quill Editor
        var quill = new Quill('#editor', {
            theme: 'snow',
            placeholder: 'Nhập thư ứng tuyển của bạn...',
            modules: {
                toolbar: [
                    [{
                        'header': '1'
                    }, {
                        'header': '2'
                    }, {
                        'font': []
                    }],
                    [{
                        'list': 'ordered'
                    }, {
                        'list': 'bullet'
                    }],
                    ['bold', 'italic', 'underline'],
                    [{
                        'align': []
                    }],
                    ['link']
                ]
            }
        });

        // Lưu nội dung Quill vào textarea khi form submit
        $('form').submit(function() {
            var coverLetterContent = quill.root.innerHTML;
            $('#cover_letter').val(coverLetterContent); // Truyền nội dung vào textarea ẩn
        });
        //============================================================

        document.addEventListener("DOMContentLoaded", function() {
            const form = document.getElementById('applyForm');
            const notification = document.getElementById('notification');

            form.addEventListener('submit', async function(event) {
                event.preventDefault(); // Ngăn form gửi yêu cầu mặc định

                const formData = new FormData(form);

                try {
                    const response = await fetch(form.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                .getAttribute('content')
                        }
                    });

                    const result = await response
                        .json(); // Nếu server không trả về JSON, đoạn này sẽ gây lỗi.

                    console.log("Response status:", response.status); // In mã trạng thái HTTP
                    console.log("Response JSON:", result); // In dữ liệu JSON từ server

                    if (response.ok && result.status === 'applied') {
                        showNotification("Ứng tuyển thành công!", "success");
                        form.reset();
                        bootstrap.Modal.getInstance(document.getElementById('applyModal')).hide();
                    } else if (result.status === 'already_applied') {
                        showNotification("Bạn đã ứng tuyển công việc này trước đó.", "info");
                    } else {
                        showNotification("Có lỗi xảy ra. Vui lòng thử lại.", "error");
                    }
                } catch (error) {
                    console.error("Error:", error); // In lỗi chi tiết ra console
                    showNotification("Có lỗi xảy ra trong hệ thống.", "error");
                }

            });

            function showNotification(message, type = 'success') {
                const notificationMessage = document.getElementById('notification-message');

                notificationMessage.textContent = message;

                if (type === 'success') {
                    notification.style.backgroundColor = '#4CAF50'; // Xanh lá
                } else if (type === 'error') {
                    notification.style.backgroundColor = '#f44336'; // Đỏ
                } else if (type === 'info') {
                    notification.style.backgroundColor = '#2196F3'; // Xanh dương
                }

                notification.style.display = 'block';

                setTimeout(() => {
                    notification.style.display = 'none';
                }, 5000);
            }

            document.getElementById('notification-close').addEventListener('click', () => {
                notification.style.display = 'none';
            });
        });

        //========================================================================
        function toggleNotificationMenu() {
            const menu = document.getElementById('notificationMenu');
            if (menu.style.display === 'block') {
                menu.style.display = 'none';
            } else {
                menu.style.display = 'block';
            }
        }

        // Đóng menu nếu click ra ngoài
        document.addEventListener('click', function(event) {
            const menu = document.getElementById('notificationMenu');
            const icon = document.querySelector('.notification-icon');
            if (!menu.contains(event.target) && !icon.contains(event.target)) {
                menu.style.display = 'none';
            }
        });

        document.addEventListener('DOMContentLoaded', function () {
    const notificationMenu = document.getElementById('notificationMenu');
    const notificationBadge = document.getElementById('notificationBadge');
    const notificationList = document.getElementById('notificationList');

    // Mở/Đóng menu
    function toggleNotificationMenu() {
        if (notificationMenu.style.display === 'block') {
            notificationMenu.style.display = 'none';
        } else {
            notificationMenu.style.display = 'block';
            fetchNotifications();
        }
    }

    // Đóng menu khi click ra ngoài
    document.addEventListener('click', function (event) {
        if (!notificationMenu.contains(event.target) && 
            !document.querySelector('.notification-icon').contains(event.target)) {
            notificationMenu.style.display = 'none';
        }
    });

    // Lấy danh sách thông báo từ server
    async function fetchNotifications() {
        try {
            const response = await fetch('/notifications');
            const notifications = await response.json();

            // Cập nhật danh sách thông báo
            notificationList.innerHTML = '';
            if (notifications.length > 0) {
                notifications.forEach(notification => {
                    const listItem = document.createElement('li');
                    listItem.textContent = notification.title;

                    // Đánh dấu là đã đọc khi click
                    listItem.addEventListener('click', () => markAsRead(notification.id));

                    notificationList.appendChild(listItem);
                });

                notificationBadge.textContent = notifications.filter(n => !n.is_read).length;
            } else {
                notificationList.innerHTML = '<li>Không có thông báo mới</li>';
                notificationBadge.textContent = '0';
            }
        } catch (error) {
            console.error('Lỗi khi lấy thông báo:', error);
        }
    }

    // Đánh dấu thông báo là đã đọc
    async function markAsRead(notificationId) {
        try {
            const response = await fetch(`/notifications/${notificationId}/read`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            });

            if (response.ok) {
                fetchNotifications(); // Refresh danh sách
            }
        } catch (error) {
            console.error('Lỗi khi đánh dấu thông báo:', error);
        }
    }

    // Gắn sự kiện vào icon
    window.toggleNotificationMenu = toggleNotificationMenu;
});

        //========================================================================
        document.addEventListener('DOMContentLoaded', function () {
    const notificationMenu = document.getElementById('notificationMenu');
    const notificationBadge = document.getElementById('notificationBadge');
    const notificationList = document.getElementById('notificationList');

    // Mở/Đóng menu
    function toggleNotificationMenu() {
        if (notificationMenu.style.display === 'block') {
            notificationMenu.style.display = 'none';
        } else {
            notificationMenu.style.display = 'block';
            fetchNotifications();
        }
    }

    // Đóng menu khi click ra ngoài
    document.addEventListener('click', function (event) {
        if (!notificationMenu.contains(event.target) && 
            !document.querySelector('.notification-icon').contains(event.target)) {
            notificationMenu.style.display = 'none';
        }
    });

    // Lấy danh sách thông báo từ server
    async function fetchNotifications() {
        try {
            const response = await fetch('/notifications');
            const notifications = await response.json();

            // Cập nhật danh sách thông báo
            notificationList.innerHTML = '';
            if (notifications.length > 0) {
                notifications.forEach(notification => {
                    const listItem = document.createElement('li');
                    const title = document.createElement('strong');
                    title.textContent = notification.title; // Title in đậm
                    const content = document.createElement('p');
                    content.textContent = notification.content; // Content dưới title
                    
                    // Đánh dấu là đã đọc khi click
                    listItem.addEventListener('click', () => markAsRead(notification.id));

                    listItem.appendChild(title);
                    listItem.appendChild(content);
                    notificationList.appendChild(listItem);
                });

                notificationBadge.textContent = notifications.filter(n => !n.is_read).length;
            } else {
                notificationList.innerHTML = '<li>Không có thông báo mới</li>';
                notificationBadge.textContent = '0';
            }
        } catch (error) {
            console.error('Lỗi khi lấy thông báo:', error);
        }
    }

    // Đánh dấu thông báo là đã đọc
    async function markAsRead(notificationId) {
        try {
            const response = await fetch(`/notifications/${notificationId}/read`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            });

            if (response.ok) {
                fetchNotifications(); // Refresh danh sách
            }
        } catch (error) {
            console.error('Lỗi khi đánh dấu thông báo:', error);
        }
    }

    // Gắn sự kiện vào icon
    window.toggleNotificationMenu = toggleNotificationMenu;
});

    </script>
    @stack('scripts')
</body>

</html>
