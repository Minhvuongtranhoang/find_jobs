@extends('layouts.job-seeker')

@section('title', 'Giới thiệu về chúng tôi')

@section('content')
<!-- Hero Section -->
<div class="hero-section">
    <div class="container text-center py-5 text-white" style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://source.unsplash.com/1600x900/?technology,team') no-repeat center center/cover;">
        <h1>Chào mừng đến với Seek a Job</h1>
        <p class="lead">Nơi kết nối người tìm việc và nhà tuyển dụng tốt nhất!</p>
        <a href="#" class="btn btn-primary btn-lg mt-4">Tìm hiểu thêm</a>
    </div>
</div>

<!-- Mission Section -->
<div class="mission-section text-center py-5 bg-light">
    <div class="container">
        <h2 class="mb-4">Sứ mệnh của chúng tôi</h2>
        <p class="lead">Chúng tôi cam kết tạo ra một nền tảng đáng tin cậy, giúp người tìm việc tìm được cơ hội tốt nhất và nhà tuyển dụng tìm được nhân tài phù hợp.</p>
        <div class="row mt-5">
            <div class="col-md-4">
                <i class="bi bi-briefcase-fill fs-1 text-primary"></i>
                <h5 class="mt-3">Kết nối</h5>
                <p>Đưa người tìm việc và nhà tuyển dụng đến gần nhau hơn.</p>
            </div>
            <div class="col-md-4">
                <i class="bi bi-person-lines-fill fs-1 text-primary"></i>
                <h5 class="mt-3">Đồng hành</h5>
                <p>Hỗ trợ người dùng trong hành trình phát triển sự nghiệp.</p>
            </div>
            <div class="col-md-4">
                <i class="bi bi-globe2 fs-1 text-primary"></i>
                <h5 class="mt-3">Toàn cầu</h5>
                <p>Mở ra cơ hội việc làm trên khắp thế giới.</p>
            </div>
        </div>
    </div>
</div>

<!-- Team Section -->
<div class="team-section py-5">
    <div class="container text-center">
        <h2 class="mb-4">Đội ngũ của chúng tôi</h2>
        <p class="mb-5">Những con người tận tâm đứng sau Seek a Job.</p>
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <img src="https://source.unsplash.com/400x400/?person,ceo" class="card-img-top" alt="CEO">
                    <div class="card-body">
                        <h5 class="card-title">Nguyễn Văn A</h5>
                        <p class="card-text">Giám đốc điều hành</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <img src="https://source.unsplash.com/400x400/?person,developer" class="card-img-top" alt="CTO">
                    <div class="card-body">
                        <h5 class="card-title">Trần Thị B</h5>
                        <p class="card-text">Giám đốc công nghệ</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <img src="https://source.unsplash.com/400x400/?person,designer" class="card-img-top" alt="CMO">
                    <div class="card-body">
                        <h5 class="card-title">Lê Văn C</h5>
                        <p class="card-text">Giám đốc Marketing</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
