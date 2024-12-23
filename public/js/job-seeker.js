// Initialize tooltips
const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
const tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl);
});


//=====================================================================================================
// Favorite job functionality
function toggleFavorite(jobId, element) {
    $.ajax({
        url: '/save-job',
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


// //==============================================================================
document.addEventListener('DOMContentLoaded', function () {
new Swiper('.mySwiper', {
    slidesPerView: 6, // Số lượng slide hiển thị cùng lúc
    spaceBetween: 20, // Khoảng cách giữa các slide (px)
    autoplay: {
        delay: 3000, // Thời gian chờ giữa các lần chuyển (ms)
        disableOnInteraction: false, // Tiếp tục autoplay sau khi người dùng tương tác
    },
    breakpoints: {
        320: {
            slidesPerView: 2, // Hiển thị 2 slide trên màn hình nhỏ
            spaceBetween: 10,
        },
        768: {
            slidesPerView: 4, // Hiển thị 4 slide trên màn hình trung bình
            spaceBetween: 15,
        },
        1024: {
            slidesPerView: 6, // Hiển thị 6 slide trên màn hình lớn
            spaceBetween: 20,
        },
    },
    loop: true, // Kích hoạt chế độ lặp
  });
});

//============================================================

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
//Apply
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







//========================================================================
//notification
document.addEventListener('DOMContentLoaded', function() {
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
    document.addEventListener('click', function(event) {
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
                    title.textContent = notification.title;

                    const content = document.createElement('p');
                    content.textContent = notification.content;

                    // Icon xóa
                    const deleteIcon = document.createElement('span');
                    deleteIcon.className = 'delete-icon';
                    deleteIcon.innerHTML = '<i class="fa fa-trash"></i>';
                    deleteIcon.onclick = () => deleteNotification(notification.id);

                    // Đánh dấu đã đọc khi click vào thông báo
                    listItem.onclick = () => markAsRead(notification.id);

                    listItem.appendChild(title);
                    listItem.appendChild(content);
                    listItem.appendChild(deleteIcon);
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

    // Đánh dấu thông báo đã đọc
    async function markAsRead(notificationId) {
        try {
            const response = await fetch(`/notifications/${notificationId}/read`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                        .getAttribute('content'),
                },
            });

            if (response.ok) {
                fetchNotifications(); // Làm mới danh sách
            }
        } catch (error) {
            console.error('Lỗi khi đánh dấu đã đọc:', error);
        }
    }

    // Xóa thông báo
    async function deleteNotification(notificationId) {
        try {
            const response = await fetch(`/notifications/${notificationId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                        .getAttribute('content'),
                },
            });

            if (response.ok) {
                fetchNotifications(); // Làm mới danh sách
            } else {
                console.error('Lỗi khi xóa thông báo:', await response.text());
            }
        } catch (error) {
            console.error('Lỗi khi xóa thông báo:', error);
        }
    }

    // Gắn sự kiện vào icon
    window.toggleNotificationMenu = toggleNotificationMenu;
});



//================================================
//reported
document.addEventListener("DOMContentLoaded", function() {
    const reportForm = document.getElementById('reportForm');
    const notification = document.getElementById('notification');

    reportForm.addEventListener('submit', async function(event) {
        event.preventDefault(); // Ngăn form gửi yêu cầu mặc định

        const formData = new FormData(reportForm);

        try {
            const response = await fetch(reportForm.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                        .getAttribute('content')
                }
            });

            const result = await response.json();

            if (response.ok && result.status === 'reported') {
                showNotification("Báo cáo thành công! Cảm ơn bạn đã phản hồi.", "success");
                reportForm.reset();
                bootstrap.Modal.getInstance(document.getElementById('reportModal')).hide();
            } else {
                showNotification("Có lỗi xảy ra. Vui lòng thử lại.", "error");
            }
        } catch (error) {
            console.error("Error:", error);
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
