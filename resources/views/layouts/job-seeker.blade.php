<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seek a Job</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="styleSheet">

    <!-- Font Awesome (nếu cần) -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="styleSheet">

    <!-- Custom CSS -->
    <link href="{{ asset('css/job-seeker.css') }}" rel="styleSheet">

    <!-- jQuery (Load before any Bootstrap JS or Select JS) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>

    <!-- Quill Editor Styles -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="styleSheet">

    <link rel="styleSheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">

    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    <!-- Quill Editor Script -->
    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>

    @stack('styles')

</head>

<body>
    <!-- Modern Header -->
    <nav class="navbar navbar-expand-lg sticky-top">
      <div class="container">
          <!-- Notification Container -->
          <div id="notification" style="display: none; position: fixed; top: 20px; right: 20px; background-color: #4CAF50; color: white; padding: 10px 20px; border-radius: 5px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); z-index: 9999;">
              <span id="notification-message"></span>
              <span id="notification-close" style="cursor: pointer; margin-left: 10px; font-weight: bold;">&times;</span>
          </div>

          <!-- Brand -->
          <a class="navbar-brand" href="{{ route('home') }}">
              Seek a<span class="highlight">Job</span>
          </a>

          <!-- Mobile Toggle Button -->
          <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
          </button>

          <!-- Main Navigation -->
          <div class="collapse navbar-collapse" id="navbarNav">
              <ul class="navbar-nav me-auto my-2 my-lg-0">
                  <li class="nav-item">
                      <a class="nav-link" href="{{ route('home') }}">Trang chủ</a>
                  </li>

                  <!-- Jobs Dropdown -->
                  <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#" id="jobsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                          Việc làm
                      </a>
                      <ul class="dropdown-menu" aria-labelledby="jobsDropdown">
                          <li><a class="dropdown-item" href="{{ route('saved-jobs') }}">Công việc đã lưu</a></li>
                          <li><a class="dropdown-item" href="{{ route('latest-jobs') }}">Công việc mới nhất</a></li>
                          <li><a class="dropdown-item" href="{{ route('job-applications') }}">Công việc đã ứng tuyển</a></li>
                          <li><a class="dropdown-item" href="{{ route('companies.index') }}">Danh sách công ty</a></li>
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

              <!-- Right Side Menu -->
              <div class="d-flex align-items-center gap-2">
                  <!-- Notifications -->
                  <div class="notification-wrapper position-relative">
                      <div class="notification-icon" onclick="toggleNotificationMenu()">
                          <i class="fa fa-bell"></i>
                          <span class="notification-badge position-absolute" id="notificationBadge">0</span>
                      </div>
                      <div class="notification-menu shadow" id="notificationMenu">
                          <h4 class="px-3 py-2 border-bottom">Thông báo</h4>
                          <ul id="notificationList" class="list-unstyled m-0">
                              <li class="px-3 py-2 border-bottom">
                                  <div class="notification-content d-flex justify-content-between align-items-start">
                                      <strong>Title thông báo</strong>
                                      <span class="delete-icon" onclick="deleteNotification(notificationId)">
                                          <i class="fa fa-trash"></i>
                                      </span>
                                  </div>
                                  <p class="mb-0 mt-1">Content thông báo</p>
                              </li>
                              <li class="px-3 py-2">
                                  <div class="notification-content">
                                      <strong>Không có thông báo mới</strong>
                                  </div>
                              </li>
                          </ul>
                      </div>
                  </div>

                  <!-- User Menu -->
                  @auth
                      <div class="dropdown">
                          <button class="btn dropdown-toggle d-flex align-items-center gap-2" type="button" id="userMenu" data-bs-toggle="dropdown" aria-expanded="false">
                              @if (Auth::user()->JobSeeker && Auth::user()->JobSeeker->avatar)
                                  <img src="{{ asset(Auth::user()->JobSeeker->avatar) }}" alt="Avatar" class="rounded-circle" width="30" height="30">
                              @else
                                  <span>Người dùng</span>
                              @endif
                          </button>
                          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userMenu">
                              <li><a class="dropdown-item" href="{{ route('profile') }}">Thông tin cá nhân</a></li>
                              <li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Đăng xuất</a></li>
                              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                  @csrf
                              </form>
                          </ul>
                      </div>
                  @else
                      <div class="d-flex gap-2">
                          <button class="btn btn-outline-primary" onclick="window.location.href='{{ route('login') }}'">Đăng nhập</button>
                          <button class="btn btn-primary d-none d-sm-block" onclick="window.location.href='{{ route('register.job-seeker') }}'">Đăng ký</button>
                      </div>
                  @endAuth
              </div>
          </div>
      </div>
    </nav>


    <div class="main-content">
        {{-- @stack('scripts') --}}
        @yield('content')
    </div>

    <!-- Enhanced Footer -->
<footer class="py-5" style="background-color: white;">
  <div class="container">
      <div class="row gy-4">
          <!-- Company Info -->
          <div class="col-12 col-lg-4 mb-4">
              <h3><a class="navbar-brand" href="{{ route('home') }}">Seek a<span class="highlight" style="padding: 8px">Job</span></a></h3>
              <p>Nền tảng tuyển dụng việc làm hàng đầu Việt Nam, kết nối ứng viên với các cơ hội việc làm tốt nhất từ những công ty công nghệ hàng đầu.</p>
              <div class="social-icons-container">
                  <a href="https://www.facebook.com/minhh.vuongg.967" class="social-icon" style="background: #3b5998;">
                      <i class="fab fa-facebook-f"></i>
                  </a>
                  <a href="https://x.com/dqv1507" class="social-icon" style="background: #1DA1F2;">
                      <i class="fab fa-twitter"></i>
                  </a>
                  <a href="#" class="social-icon" style="background: #0077b5;">
                      <i class="fab fa-linkedin-in"></i>
                  </a>
                  <a href="#" class="social-icon" style="background: #E4405F;">
                      <i class="fab fa-instagram"></i>
                  </a>
              </div>
          </div>

          <!-- Quick Links -->
          <div class="col-6 col-lg-2 col-md-6 mb-4">
              <h5 class="mb-3">Liên kết</h5>
              <ul class="list-unstyled">
                  <li class="mb-2"><a href="#" class="text-muted mb-2 text-decoration-none">Trang chủ</a></li>
                  <li class="mb-2"><a href="#" class="text-muted mb-2 text-decoration-none">Việc làm</a></li>
                  <li class="mb-2"><a href="#" class="text-muted mb-2 text-decoration-none">Công ty</a></li>
                  <li class="mb-2"><a href="#" class="text-muted mb-2 text-decoration-none">Trợ giúp</a></li>
                  <li class="mb-2"><a href="#" class="text-muted mb-2 text-decoration-none">Liên lạc</a></li>
              </ul>
          </div>

          <!-- Job Categories -->
          <div class="col-6 col-lg-3 col-md-6 mb-4">
              <h5 class="mb-3">Danh mục việc làm</h5>
              <ul class="list-unstyled">
                  <li class="mb-2"><a href="#" class="text-muted mb-2 text-decoration-none">Frontend Development</a></li>
                  <li class="mb-2"><a href="#" class="text-muted mb-2 text-decoration-none">Backend Development</a></li>
                  <li class="mb-2"><a href="#" class="text-muted mb-2 text-decoration-none">Full Stack Development</a></li>
                  <li class="mb-2"><a href="#" class="text-muted mb-2 text-decoration-none">DevOps Engineering</a></li>
              </ul>
          </div>

          <!-- Contact Info -->
          <div class="col-12 col-lg-3 col-md-6">
              <h5 class="mb-3">Liên hệ</h5>
              <ul class="list-unstyled">
                  <li class="mb-2"><i class="fas fa-map-marker-alt me-2"></i>Trường ĐH CNTT&TT Việt-Hàn, Làng Đại học Đà Nẵng</li>
                  <li class="mb-2"><i class="fas fa-phone me-2"></i>(+84) 123-456-789</li>
                  <li class="mb-2"><i class="fas fa-envelope me-2"></i>seekajob2024@gmail.com</li>
              </ul>
          </div>
      </div>

      <hr class="my-4">

      <!-- Company Details -->
      <div class="container">
          <div class="row">
              <div class="col-12 col-lg-8 col-md-3">
                  <h4>Công ty Cổ phần Seek a Job Việt Nam</h4>
                  <div style="display: flex;" class="mt-3">
                      <p class="text-muted mb-2">Giấy phép đăng ký kinh doanh số:&nbsp;</p>01xx70071aa
                  </div>
                  <div style="display: flex;">
                      <p class="text-muted mb-2">Giấy phép hoạt động dịch vụ việc làm số:&nbsp;</p>1a/SLĐTBXH-GHĐL
                  </div>
                  <div style="display: flex">
                      <p class="text-muted mb-2">Trụ sở DN:&nbsp;</p>Tòa 2 - kí túc xá VKU, số 470 Trần Đại Nghĩa, P.Hòa Quý, Q.Ngũ Hành Sơn, Đà Nẵng
                  </div>
                  <div style="display: flex">
                      <p class="text-muted mb-2">Chi nhánh Khánh Hòa:&nbsp;</p>Tòa nhà A07, 21A Nguyễn Huệ, P.Vạn Thạnh TP Nha Trang
                  </div>
              </div>
              <div class="col-12 col-lg-4 col-md-3">
                  <div style="text-align: center; display: flex; justify-content: center; align-items: center; flex-direction: column;">
                      <img src="https://i.postimg.cc/nz7Jdr3C/a.png" alt="QR Code" class="img-fluid">
                      <a href="https://www.facebook.com/minhh.vuongg.967" class="text-decoration-none" style="color: #3C6E71">seekajob2024.com.vn</a>
                  </div>
              </div>
          </div>
      </div>

      <!-- Community Projects -->
      <div class="container">
          <h5 class="mt-4 mb-3">Dự án Cộng đồng của Chúng tôi</h5>
          <div class="row">
              <div class="col-12 col-sm-6 col-lg-3 mb-3">
                  <div class="box-image-app" style="background: linear-gradient(135deg, #3C6E71 0%, #569296 100%);">
                      <img src="https://i.postimg.cc/85cHhzS3/logo.png" alt="App Store">
                      <span>Dự án "Hỗ trợ nghề nghiệp cho thanh niên" - Khởi động ngày 10/12/2022</span>
                  </div>
              </div>
              <div class="col-12 col-sm-6 col-lg-3 mb-3">
                  <div class="box-image-app" style="background: linear-gradient(135deg, #D68C45 0%, #e09c5d 100%);">
                      <img src="https://i.postimg.cc/85cHhzS3/logo.png" alt="App Store">
                      <span>Dự án "Chia sẻ kỹ năng với cộng đồng" - Ngày 15/09/2023</span>
                  </div>
              </div>
              <div class="col-12 col-sm-6 col-lg-3 mb-3">
                  <div class="box-image-app" style="background: linear-gradient(135deg, #F3B562 0%, #e9b776 100%);">
                      <img src="https://i.postimg.cc/85cHhzS3/logo.png" alt="App Store">
                      <span>Dự án "Giới thiệu nghề nghiệp cho sinh viên" - Ngày 19/10/2024</span>
                  </div>
              </div>
              <div class="col-12 col-sm-6 col-lg-3 mb-3">
                  <div class="box-image-app" style="background: linear-gradient(135deg, #76B39D 0%, #8bc5b0 100%);">
                      <img src="https://i.postimg.cc/85cHhzS3/logo.png" alt="App Store">
                      <span>Dự án "Xây dựng cộng đồng doanh nghiệp nhỏ" - Ra mắt ngày 02/04/2025</span>
                  </div>
              </div>
          </div>
      </div>

      <!-- Copyright -->
      <p class="mb-0" style="text-align: center">&copy; 2024 Seek a Job. All rights reserved.</p>
  </div>
</footer>

    <!-- Scripts -->


    <script>
        // // Initialize tooltips
        // const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        // const tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
        //     return new bootstrap.Tooltip(tooltipTriggerEl);
        // });


        // //=====================================================================================================
        // // Favorite job functionality
        // function toggleFavorite(jobId, element) {
        //     $.ajax({
        //         url: '{{ route('save-job') }}',
        //         type: 'POST',
        //         data: {
        //             job_id: jobId,
        //             _token: '{{ csrf_token() }}'
        //         },
        //         success: function(response) {
        //             if (response.status === 'saved') {
        //                 $(element).find('i').removeClass('far').addClass('fas'); // Đổi trái tim rỗng thành đầy
        //                 showNotification('Đã lưu công việc vào danh sách yêu thích!', 'success');
        //             } else if (response.status === 'removed') {
        //                 $(element).find('i').removeClass('fas').addClass('far'); // Đổi trái tim đầy thành rỗng
        //                 showNotification('Đã xóa công việc khỏi danh sách yêu thích!', 'success');
        //             }
        //         },
        //         error: function() {
        //             showNotification('Vui lòng đăng nhập để lưu công việc.', 'error');
        //         }
        //     });
        // }

        // function showNotification(message, type) {
        //     var notification = $('#notification');
        //     var notificationMessage = $('#notification-message');

        //     notificationMessage.text(message);

        //     // Thay đổi màu nền dựa trên trạng thái thành công hoặc lỗi
        //     if (type === 'success') {
        //         notification.css('background-color', '#4CAF50'); // Xanh cho thành công
        //     } else {
        //         notification.css('background-color', '#f44336'); // Đỏ cho lỗi
        //     }

        //     // Hiển thị thông báo
        //     notification.fadeIn();

        //     // Tự động ẩn sau 4 giây
        //     setTimeout(function() {
        //         notification.fadeOut();
        //     }, 4000);

        //     // Chức năng đóng thông báo
        //     $('#notification-close').click(function() {
        //         notification.fadeOut();
        //     });
        // }


        // //====================================================================================
        // //Smooth scroll
        // document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        //     anchor.addEventListener('click', function(e) {
        //         e.preventDefault();
        //         document.querySelector(this.getAttribute('href')).scrollIntoView({
        //             behavior: 'smooth'
        //         });
        //     });
        // });


        // // //==============================================================================
        // document.addEventListener('DOMContentLoaded', function () {
        // new Swiper('.mySwiper', {
        //     slidesPerView: 6, // Số lượng slide hiển thị cùng lúc
        //     spaceBetween: 20, // Khoảng cách giữa các slide (px)
        //     autoplay: {
        //         delay: 3000, // Thời gian chờ giữa các lần chuyển (ms)
        //         disableOnInteraction: false, // Tiếp tục autoplay sau khi người dùng tương tác
        //     },
        //     breakpoints: {
        //         320: {
        //             slidesPerView: 2, // Hiển thị 2 slide trên màn hình nhỏ
        //             spaceBetween: 10,
        //         },
        //         768: {
        //             slidesPerView: 4, // Hiển thị 4 slide trên màn hình trung bình
        //             spaceBetween: 15,
        //         },
        //         1024: {
        //             slidesPerView: 6, // Hiển thị 6 slide trên màn hình lớn
        //             spaceBetween: 20,
        //         },
        //     },
        //     loop: true, // Kích hoạt chế độ lặp
        //   });
        // });

        // //============================================================
        // //Quill for texteditor
        // // Khởi tạo Quill Editor
        // var quill = new Quill('#editor', {
        //     theme: 'snow',
        //     placeholder: 'Nhập thư ứng tuyển của bạn...',
        //     modules: {
        //         toolbar: [
        //             [{
        //                 'header': '1'
        //             }, {
        //                 'header': '2'
        //             }, {
        //                 'font': []
        //             }],
        //             [{
        //                 'list': 'ordered'
        //             }, {
        //                 'list': 'bullet'
        //             }],
        //             ['bold', 'italic', 'underline'],
        //             [{
        //                 'align': []
        //             }],
        //             ['link']
        //         ]
        //     }
        // });

        // // Lưu nội dung Quill vào textarea khi form submit
        // $('form').submit(function() {
        //     var coverLetterContent = quill.root.innerHTML;
        //     $('#cover_letter').val(coverLetterContent); // Truyền nội dung vào textarea ẩn
        // });
        // //============================================================
        // //Apply
        // document.addEventListener("DOMContentLoaded", function() {
        //     const form = document.getElementById('applyForm');
        //     const notification = document.getElementById('notification');

        //     form.addEventListener('submit', async function(event) {
        //         event.preventDefault(); // Ngăn form gửi yêu cầu mặc định

        //         const formData = new FormData(form);

        //         try {
        //             const response = await fetch(form.action, {
        //                 method: 'POST',
        //                 body: formData,
        //                 headers: {
        //                     'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
        //                         .getAttribute('content')
        //                 }
        //             });

        //             const result = await response
        //                 .json(); // Nếu server không trả về JSON, đoạn này sẽ gây lỗi.

        //             console.log("Response status:", response.status); // In mã trạng thái HTTP
        //             console.log("Response JSON:", result); // In dữ liệu JSON từ server

        //             if (response.ok && result.status === 'applied') {
        //                 showNotification("Ứng tuyển thành công!", "success");
        //                 form.reset();
        //                 bootstrap.Modal.getInstance(document.getElementById('applyModal')).hide();
        //             } else if (result.status === 'already_applied') {
        //                 showNotification("Bạn đã ứng tuyển công việc này trước đó.", "info");
        //             } else {
        //                 showNotification("Có lỗi xảy ra. Vui lòng thử lại.", "error");
        //             }
        //         } catch (error) {
        //             console.error("Error:", error); // In lỗi chi tiết ra console
        //             showNotification("Có lỗi xảy ra trong hệ thống.", "error");
        //         }

        //     });

        //     function showNotification(message, type = 'success') {
        //         const notificationMessage = document.getElementById('notification-message');

        //         notificationMessage.textContent = message;

        //         if (type === 'success') {
        //             notification.style.backgroundColor = '#4CAF50'; // Xanh lá
        //         } else if (type === 'error') {
        //             notification.style.backgroundColor = '#f44336'; // Đỏ
        //         } else if (type === 'info') {
        //             notification.style.backgroundColor = '#2196F3'; // Xanh dương
        //         }

        //         notification.style.display = 'block';

        //         setTimeout(() => {
        //             notification.style.display = 'none';
        //         }, 5000);
        //     }

        //     document.getElementById('notification-close').addEventListener('click', () => {
        //         notification.style.display = 'none';
        //     });
        // });


        // //========================================================================







        // //========================================================================
        // //notification
        // document.addEventListener('DOMContentLoaded', function() {
        //     const notificationMenu = document.getElementById('notificationMenu');
        //     const notificationBadge = document.getElementById('notificationBadge');
        //     const notificationList = document.getElementById('notificationList');

        //     // Mở/Đóng menu
        //     function toggleNotificationMenu() {
        //         if (notificationMenu.style.display === 'block') {
        //             notificationMenu.style.display = 'none';
        //         } else {
        //             notificationMenu.style.display = 'block';
        //             fetchNotifications();
        //         }
        //     }

        //     // Đóng menu khi click ra ngoài
        //     document.addEventListener('click', function(event) {
        //         if (!notificationMenu.contains(event.target) &&
        //             !document.querySelector('.notification-icon').contains(event.target)) {
        //             notificationMenu.style.display = 'none';
        //         }
        //     });

        //     // Lấy danh sách thông báo từ server
        //     async function fetchNotifications() {
        //         try {
        //             const response = await fetch('/notifications');
        //             const notifications = await response.json();

        //             // Cập nhật danh sách thông báo
        //             notificationList.innerHTML = '';
        //             if (notifications.length > 0) {
        //                 notifications.forEach(notification => {
        //                     const listItem = document.createElement('li');
        //                     const title = document.createElement('strong');
        //                     title.textContent = notification.title;

        //                     const content = document.createElement('p');
        //                     content.textContent = notification.content;

        //                     // Icon xóa
        //                     const deleteIcon = document.createElement('span');
        //                     deleteIcon.className = 'delete-icon';
        //                     deleteIcon.innerHTML = '<i class="fa fa-trash"></i>';
        //                     deleteIcon.onclick = () => deleteNotification(notification.id);

        //                     // Đánh dấu đã đọc khi click vào thông báo
        //                     listItem.onclick = () => markAsRead(notification.id);

        //                     listItem.appendChild(title);
        //                     listItem.appendChild(content);
        //                     listItem.appendChild(deleteIcon);
        //                     notificationList.appendChild(listItem);
        //                 });

        //                 notificationBadge.textContent = notifications.filter(n => !n.is_read).length;
        //             } else {
        //                 notificationList.innerHTML = '<li>Không có thông báo mới</li>';
        //                 notificationBadge.textContent = '0';
        //             }
        //         } catch (error) {
        //             console.error('Lỗi khi lấy thông báo:', error);
        //         }
        //     }

        //     // Đánh dấu thông báo đã đọc
        //     async function markAsRead(notificationId) {
        //         try {
        //             const response = await fetch(`/notifications/${notificationId}/read`, {
        //                 method: 'POST',
        //                 headers: {
        //                     'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
        //                         .getAttribute('content'),
        //                 },
        //             });

        //             if (response.ok) {
        //                 fetchNotifications(); // Làm mới danh sách
        //             }
        //         } catch (error) {
        //             console.error('Lỗi khi đánh dấu đã đọc:', error);
        //         }
        //     }

        //     // Xóa thông báo
        //     async function deleteNotification(notificationId) {
        //         try {
        //             const response = await fetch(`/notifications/${notificationId}`, {
        //                 method: 'DELETE',
        //                 headers: {
        //                     'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
        //                         .getAttribute('content'),
        //                 },
        //             });

        //             if (response.ok) {
        //                 fetchNotifications(); // Làm mới danh sách
        //             } else {
        //                 console.error('Lỗi khi xóa thông báo:', await response.text());
        //             }
        //         } catch (error) {
        //             console.error('Lỗi khi xóa thông báo:', error);
        //         }
        //     }

        //     // Gắn sự kiện vào icon
        //     window.toggleNotificationMenu = toggleNotificationMenu;
        // });



        // //================================================
        // //reported
        // document.addEventListener("DOMContentLoaded", function() {
        //     const reportForm = document.getElementById('reportForm');
        //     const notification = document.getElementById('notification');

        //     reportForm.addEventListener('submit', async function(event) {
        //         event.preventDefault(); // Ngăn form gửi yêu cầu mặc định

        //         const formData = new FormData(reportForm);

        //         try {
        //             const response = await fetch(reportForm.action, {
        //                 method: 'POST',
        //                 body: formData,
        //                 headers: {
        //                     'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
        //                         .getAttribute('content')
        //                 }
        //             });

        //             const result = await response.json();

        //             if (response.ok && result.status === 'reported') {
        //                 showNotification("Báo cáo thành công! Cảm ơn bạn đã phản hồi.", "success");
        //                 reportForm.reset();
        //                 bootstrap.Modal.getInstance(document.getElementById('reportModal')).hide();
        //             } else {
        //                 showNotification("Có lỗi xảy ra. Vui lòng thử lại.", "error");
        //             }
        //         } catch (error) {
        //             console.error("Error:", error);
        //             showNotification("Có lỗi xảy ra trong hệ thống.", "error");
        //         }
        //     });

        //     function showNotification(message, type = 'success') {
        //         const notificationMessage = document.getElementById('notification-message');

        //         notificationMessage.textContent = message;

        //         if (type === 'success') {
        //             notification.style.backgroundColor = '#4CAF50'; // Xanh lá
        //         } else if (type === 'error') {
        //             notification.style.backgroundColor = '#f44336'; // Đỏ
        //         } else if (type === 'info') {
        //             notification.style.backgroundColor = '#2196F3'; // Xanh dương
        //         }

        //         notification.style.display = 'block';

        //         setTimeout(() => {
        //             notification.style.display = 'none';
        //         }, 5000);
        //     }

        //     document.getElementById('notification-close').addEventListener('click', () => {
        //         notification.style.display = 'none';
        //     });
        // });


        document.addEventListener('DOMContentLoaded', function() {
          // Initialize tooltips nếu có
          const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
          if (tooltipTriggerList.length > 0) {
              tooltipTriggerList.forEach(el => new bootstrap.Tooltip(el));
          }

          // Favorite job functionality
          window.toggleFavorite = function(jobId, element) {
              $.ajax({
                  url: '/save-job', // Thay thế route helper bằng URL trực tiếp
                  type: 'POST',
                  data: {
                      job_id: jobId,
                      _token: document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
                  },
                  success: function(response) {
                      if (response.status === 'saved') {
                          $(element).find('i').removeClass('far').addClass('fas');
                          showNotification('Đã lưu công việc vào danh sách yêu thích!', 'success');
                      } else if (response.status === 'removed') {
                          $(element).find('i').removeClass('fas').addClass('far');
                          showNotification('Đã xóa công việc khỏi danh sách yêu thích!', 'success');
                      }
                  },
                  error: function() {
                      showNotification('Vui lòng đăng nhập để lưu công việc.', 'error');
                  }
              });
          };

          // Universal notification function
          window.showNotification = function(message, type = 'success') {
              const notification = document.getElementById('notification');
              const notificationMessage = document.getElementById('notification-message');

              if (!notification || !notificationMessage) return;

              notificationMessage.textContent = message;

              const colors = {
                  success: '#4CAF50',
                  error: '#f44336',
                  info: '#2196F3'
              };

              notification.style.backgroundColor = colors[type] || colors.info;
              notification.style.display = 'block';

              setTimeout(() => {
                  notification.style.display = 'none';
              }, 4000);
          };

          // Close notification button
          const notificationClose = document.getElementById('notification-close');
          if (notificationClose) {
              notificationClose.addEventListener('click', () => {
                  const notification = document.getElementById('notification');
                  if (notification) notification.style.display = 'none';
              });
          }

          // Smooth scroll only for anchor links
          const anchorLinks = document.querySelectorAll('a[href^="#"]:not([href="#"])');
          if (anchorLinks.length > 0) {
              anchorLinks.forEach(anchor => {
                  anchor.addEventListener('click', function(e) {
                      e.preventDefault();
                      const target = document.querySelector(this.getAttribute('href'));
                      if (target) {
                          target.scrollIntoView({
                              behavior: 'smooth'
                          });
                      }
                  });
              });
          }

          // Initialize Swiper only if element exists
          const swiperContainer = document.querySelector('.mySwiper');
          if (swiperContainer) {
              new Swiper('.mySwiper', {
                  slidesPerView: 6,
                  spaceBetween: 20,
                  autoplay: {
                      delay: 3000,
                      disableOnInteraction: false,
                  },
                  breakpoints: {
                      320: {
                          slidesPerView: 2,
                          spaceBetween: 10,
                      },
                      768: {
                          slidesPerView: 4,
                          spaceBetween: 15,
                      },
                      1024: {
                          slidesPerView: 6,
                          spaceBetween: 20,
                      },
                  },
                  loop: true,
              });
          }

          // Initialize Quill only if editor exists
          const editorElement = document.getElementById('editor');
          if (editorElement) {
              const quill = new Quill('#editor', {
                  theme: 'snow',
                  placeholder: 'Nhập thư ứng tuyển của bạn...',
                  modules: {
                      toolbar: [
                          [{ 'header': '1' }, { 'header': '2' }, { 'font': [] }],
                          [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                          ['bold', 'italic', 'underline'],
                          [{ 'align': [] }],
                          ['link']
                      ]
                  }
              });

              // Handle form submission for Quill
              const forms = document.querySelectorAll('form');
              forms.forEach(form => {
                  form.addEventListener('submit', function() {
                      const coverLetter = document.getElementById('cover_letter');
                      if (coverLetter && quill) {
                          coverLetter.value = quill.root.innerHTML;
                      }
                  });
              });
          }

          // Initialize Apply Form handling if exists
          const applyForm = document.getElementById('applyForm');
          if (applyForm) {
              initializeApplyForm(applyForm);
          }

          // Initialize Report Form handling if exists
          const reportForm = document.getElementById('reportForm');
          if (reportForm) {
              initializeReportForm(reportForm);
          }

          // Initialize Notification system if needed
          const notificationMenu = document.getElementById('notificationMenu');
          if (notificationMenu) {
              initializeNotificationSystem();
          }
      });

      // Separate function for Apply Form handling
      function initializeApplyForm(form) {
          form.addEventListener('submit', async function(event) {
              event.preventDefault();
              const formData = new FormData(form);

              try {
                  const response = await fetch(form.action, {
                      method: 'POST',
                      body: formData,
                      headers: {
                          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
                      }
                  });

                  const result = await response.json();

                  if (response.ok && result.status === 'applied') {
                      showNotification("Ứng tuyển thành công!", "success");
                      form.reset();
                      const modal = document.getElementById('applyModal');
                      if (modal) {
                          bootstrap.Modal.getInstance(modal).hide();
                      }
                  } else if (result.status === 'already_applied') {
                      showNotification("Bạn đã ứng tuyển công việc này trước đó.", "info");
                  } else {
                      showNotification("Có lỗi xảy ra. Vui lòng thử lại.", "error");
                  }
              } catch (error) {
                  console.error("Error:", error);
                  showNotification("Có lỗi xảy ra trong hệ thống.", "error");
              }
          });
      }

      // Separate function for Report Form handling
      function initializeReportForm(form) {
          form.addEventListener('submit', async function(event) {
              event.preventDefault();
              const formData = new FormData(form);

              try {
                  const response = await fetch(form.action, {
                      method: 'POST',
                      body: formData,
                      headers: {
                          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
                      }
                  });

                  const result = await response.json();

                  if (response.ok && result.status === 'reported') {
                      showNotification("Báo cáo thành công! Cảm ơn bạn đã phản hồi.", "success");
                      form.reset();
                      const modal = document.getElementById('reportModal');
                      if (modal) {
                          bootstrap.Modal.getInstance(modal).hide();
                      }
                  } else {
                      showNotification("Có lỗi xảy ra. Vui lòng thử lại.", "error");
                  }
              } catch (error) {
                  console.error("Error:", error);
                  showNotification("Có lỗi xảy ra trong hệ thống.", "error");
              }
          });
      }

      // Separate function for Notification system
      function initializeNotificationSystem() {
          const notificationMenu = document.getElementById('notificationMenu');
          const notificationBadge = document.getElementById('notificationBadge');
          const notificationList = document.getElementById('notificationList');

          window.toggleNotificationMenu = function() {
              if (notificationMenu.style.display === 'block') {
                  notificationMenu.style.display = 'none';
              } else {
                  notificationMenu.style.display = 'block';
                  fetchNotifications();
              }
          };

          // Close menu when clicking outside
          document.addEventListener('click', function(event) {
              const notificationIcon = document.querySelector('.notification-icon');
              if (!notificationMenu.contains(event.target) &&
                  (!notificationIcon || !notificationIcon.contains(event.target))) {
                  notificationMenu.style.display = 'none';
              }
          });

          async function fetchNotifications() {
              try {
                  const response = await fetch('/notifications');
                  const notifications = await response.json();

                  updateNotificationList(notifications);
              } catch (error) {
                  console.error('Lỗi khi lấy thông báo:', error);
              }
          }

          function updateNotificationList(notifications) {
              if (!notificationList || !notificationBadge) return;

              notificationList.innerHTML = '';
              if (notifications.length > 0) {
                  notifications.forEach(notification => {
                      const listItem = createNotificationItem(notification);
                      notificationList.appendChild(listItem);
                  });

                  notificationBadge.textContent = notifications.filter(n => !n.is_read).length;
              } else {
                  notificationList.innerHTML = '<li>Không có thông báo mới</li>';
                  notificationBadge.textContent = '0';
              }
          }

          function createNotificationItem(notification) {
              const listItem = document.createElement('li');
              listItem.innerHTML = `
                  <strong>${notification.title}</strong>
                  <p>${notification.content}</p>
                  <span class="delete-icon" onclick="deleteNotification(${notification.id})">
                      <i class="fa fa-trash"></i>
                  </span>
              `;
              listItem.onclick = () => markAsRead(notification.id);
              return listItem;
          }
      }

    </script>
    @stack('scripts')
</body>
</html>
