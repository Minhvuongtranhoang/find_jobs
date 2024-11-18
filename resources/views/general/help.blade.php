@extends('layouts.job-seeker')

@section('title', 'Trợ giúp')

@section('content')
<!-- Hero Section -->
<div class="hero-section">
    <div class="container text-center py-5 text-white" style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://source.unsplash.com/1600x900/?help,support') no-repeat center center/cover;">
        <h1>Trợ giúp</h1>
        <p class="lead">Chúng tôi sẵn sàng hỗ trợ bạn mọi lúc!</p>
    </div>
</div>

<!-- FAQ Section -->
<div class="faq-section py-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-4">Câu hỏi thường gặp</h2>
        <div class="accordion" id="faqAccordion">
            <div class="accordion-item">
                <h2 class="accordion-header" id="faq1">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1" aria-expanded="true" aria-controls="collapse1">
                        Làm thế nào để tạo tài khoản?
                    </button>
                </h2>
                <div id="collapse1" class="accordion-collapse collapse show" aria-labelledby="faq1" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Bạn có thể tạo tài khoản bằng cách nhấp vào nút "Đăng ký" trên thanh menu và điền thông tin cần thiết.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="faq2">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2" aria-expanded="false" aria-controls="collapse2">
                        Làm thế nào để tìm công việc phù hợp?
                    </button>
                </h2>
                <div id="collapse2" class="accordion-collapse collapse" aria-labelledby="faq2" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Hãy sử dụng thanh tìm kiếm trên trang chủ hoặc duyệt qua các danh mục việc làm. Bạn cũng có thể sử dụng bộ lọc để tìm kiếm nhanh hơn.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="faq3">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse3" aria-expanded="false" aria-controls="collapse3">
                        Làm thế nào để lưu công việc yêu thích?
                    </button>
                </h2>
                <div id="collapse3" class="accordion-collapse collapse" aria-labelledby="faq3" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Khi bạn tìm thấy một công việc mà bạn yêu thích, hãy nhấp vào biểu tượng trái tim để lưu công việc đó.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Contact Section -->
<div class="contact-section py-5">
    <div class="container">
        <h2 class="text-center mb-4">Vẫn cần trợ giúp?</h2>
        <p class="text-center">Nếu bạn không tìm thấy câu trả lời, hãy liên hệ với chúng tôi:</p>
        <div class="row text-center">
            <div class="col-md-4">
                <i class="bi bi-envelope-fill fs-1 text-primary"></i>
                <p>Email: seekajob2024@gmail.com</p>
            </div>
            <div class="col-md-4">
                <i class="bi bi-phone-fill fs-1 text-primary"></i>
                <p>Điện thoại: +84 123 456 789</p>
            </div>
            <div class="col-md-4">
                <i class="bi bi-chat-dots-fill fs-1 text-primary"></i>
                <p>Chat trực tiếp: <a href="{{ route('contact') }}">Bắt đầu chat</a></p>
            </div>
        </div>
    </div>
</div>
@endsection
