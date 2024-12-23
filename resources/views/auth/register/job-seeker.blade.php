<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Ký Người Tìm Việc</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="styleSheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="styleSheet">
    <link href="{{ asset('css/auth.css') }}" rel="styleSheet">
</head>
<body>
    <div class="container">
        <div class="form-container">
            <div class="logo-container">
              <h4 class="text-success mb-3">Chào mừng bạn đến với Seek a Job</h4>
              <p class="text-muted">Cùng xây dựng một cộng đồng nổi bật và nhận được các cơ hội việc làm lý tưởng</p>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endForeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('register.job-seeker') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <div class="input-group">
                        <span class="input-group-text bg-white"><i class="fas fa-user text-muted"></i></span>
                        <input type="text" id="full_name" name="full_name" class="form-control" placeholder="Họ và tên" value="{{ old('full_name') }}" required>
                    </div>
                </div>

                <div class="mb-3">
                    <div class="input-group">
                        <span class="input-group-text bg-white"><i class="fas fa-envelope text-muted"></i></span>
                        <input type="email" id="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}" required>
                    </div>
                </div>

                <div class="mb-3">
                    <div class="input-group">
                        <span class="input-group-text bg-white"><i class="fas fa-phone text-muted"></i></span>
                        <input type="text" id="phone" name="phone" class="form-control" placeholder="Số điện thoại" value="{{ old('phone') }}" required>
                    </div>
                </div>

                <div class="mb-3">
                    <div class="input-group">
                        <span class="input-group-text bg-white"><i class="fas fa-lock text-muted"></i></span>
                        <input type="password" id="password" name="password" class="form-control" placeholder="Mật khẩu" required>
                        <span class="input-group-text bg-white"><i class="fas fa-eye text-muted"></i></span>
                    </div>
                </div>

                <div class="mb-3">
                    <div class="input-group">
                        <span class="input-group-text bg-white"><i class="fas fa-lock text-muted"></i></span>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Xác nhận mật khẩu" required>
                        <span class="input-group-text bg-white"><i class="fas fa-eye text-muted"></i></span>
                    </div>
                </div>

                <div class="mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="terms">
                        <label class="form-check-label" for="terms" style="display: flex; flex-wrap: wrap; align-items: center;">
                          Tôi đã đọc và đồng ý với&nbsp;
                          <a href="{{ route('terms-of-service') }}" class="text-decoration-none me-1"> Điều khoản sử dụng</a> và&nbsp;
                          <a href="{{ route('privacy-policy') }}" class="text-decoration-none">Chính sách bảo mật</a>.
                        </label>

                    </div>
                </div>

                <button type="submit" class="btn btn-success w-100 mb-3">Đăng ký</button>

                <div class="text-center mb-3">
                    <span>Hoặc đăng nhập bằng</span>
                </div>

                <div class="d-flex social-buttons">
                    <button type="button" class="btn btn-google">
                        <i class="fab fa-google me-2"></i>Google
                    </button>
                    <button type="button" class="btn btn-facebook">
                        <i class="fab fa-facebook-f me-2"></i>Facebook
                    </button>
                    <button type="button" class="btn btn-linkedin">
                        <i class="fab fa-linkedin-in me-2"></i>LinkedIn
                    </button>
                </div>

                <div class="text-center mt-4">
                    <p class="mb-0">Bạn đã có tài khoản? <a href="{{ route('login') }}" class="text-success text-decoration-none">Đăng nhập ngay</a></p>
                    <p class="mt-3 mb-0">Bạn gặp khó khăn khi tạo tài khoản?</p>
                    <p class="text-muted">Vui lòng gọi tới số <strong>(0966) 069 848</strong> (giờ hành chính)</p>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
