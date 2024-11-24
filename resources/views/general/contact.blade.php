@extends('layouts.job-seeker')

@section('title', 'Liên lạc')

@section('content')
<!-- Hero Section -->
<div class="hero-section">
    <div class="container text-center py-5 text-white" style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://source.unsplash.com/1600x900/?contact,help') no-repeat center center/cover;">
        <h1>Liên lạc với chúng tôi</h1>
        <p class="lead">Chúng tôi luôn sẵn sàng hỗ trợ bạn. Hãy để lại lời nhắn ngay hôm nay!</p>
    </div>
</div>

<!-- Contact Form Section -->
<div class="contact-section py-5">
    <div class="container">
        <div class="row">
            <!-- Contact Info -->
            <div class="col-md-6">
                <h2 class="mb-4">Thông tin liên hệ</h2>
                <p class="mb-3"><i class="bi bi-envelope-fill text-primary"></i> Email: seekajob2024@gmail.com</p>
                <p class="mb-3"><i class="bi bi-phone-fill text-primary"></i> Điện thoại: +84 123 456 789</p>
                <p class="mb-3"><i class="bi bi-geo-alt-fill text-primary"></i> Địa chỉ: Số 123, Đường ABC, TP.HCM</p>
                <p>Thời gian làm việc: Thứ 2 - Thứ 6 (9:00 - 18:00)</p>
            </div>

            <!-- Contact Form -->
            <div class="col-md-6">
                <h2 class="mb-4">Gửi tin nhắn</h2>
                <form method="POST" action="#">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Tên của bạn</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên của bạn" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Nhập email của bạn" required>
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Tin nhắn</label>
                        <textarea class="form-control" id="message" name="message" rows="5" placeholder="Nhập nội dung tin nhắn" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Gửi</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Map Section -->
<div class="map-section">
    <div class="container text-center py-5">
        <h2 class="mb-4">Địa chỉ của chúng tôi</h2>
        <div class="ratio ratio-16x9">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3835.734025012026!2d108.25065207490204!3d15.975260284690657!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3142108997dc971f%3A0x1295cb3d313469c9!2zVHLGsOG7nW5nIMSQ4bqhaSBo4buNYyBDw7RuZyBuZ2jhu4cgVGjDtG5nIHRpbiB2w6AgVHJ1eeG7gW4gdGjDtG5nIFZp4buHdCAtIEjDoG4sIMSQ4bqhaSBo4buNYyDEkMOgIE7hurVuZw!5e0!3m2!1svi!2s!4v1731979566191!5m2!1svi!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
</div>
@endsection
