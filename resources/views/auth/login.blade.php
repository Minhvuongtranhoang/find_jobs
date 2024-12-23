<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký tài khoản</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="styleSheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="styleSheet">
    <link href="{{ asset('css/auth.css') }}" rel="styleSheet">
</head>
<body>
    <div class="container">
        <div class="form-container">
            <div class="logo-container">
                <h4 class="text-success mb-3">Chào mừng bạn đã quay trở lại</h4>
                <p class="text-muted">Hãy cùng đồng hành với chúng tôi để nhận được các cơ hội việc làm lý tưởng bạn nhé!</p>
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

            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-3">
                    <div class="input-group">
                        <span class="input-group-text bg-white"><i class="fas fa-envelope text-muted"></i></span>
                        <input type="email" id="email" name="email" class="form-control" placeholder="Nhập email" value="{{ old('email') }}" required autofocus>
                    </div>
                </div>

                <div class="mb-3">
                    <div class="input-group">
                        <span class="input-group-text bg-white">
                            <i class="fas fa-lock text-muted"></i>
                        </span>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="form-control"
                            placeholder="Nhập mật khẩu"
                            required>
                        <span
                            class="input-group-text bg-white toggle-password"
                            onclick="togglePassword()">
                            <i class="fas fa-eye text-muted" id="password-icon"></i>
                        </span>
                    </div>
                </div>

                <script>
                    function togglePassword() {
                        const passwordInput = document.getElementById('password');
                        const passwordIcon = document.getElementById('password-icon');
                        if (passwordInput.type === 'password') {
                            passwordInput.type = 'text';
                            passwordIcon.classList.remove('fa-eye');
                            passwordIcon.classList.add('fa-eye-slash');
                        } else {
                            passwordInput.type = 'password';
                            passwordIcon.classList.remove('fa-eye-slash');
                            passwordIcon.classList.add('fa-eye');
                        }
                    }
                </script>


                <div class="mb-3 d-flex justify-content-between align-items-center">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="remember" name="remember">
                        <label class="form-check-label" for="remember">
                            Ghi nhớ đăng nhập
                        </label>
                    </div>
                    <div>
                      <a href="{{ route('password.request') }}" class="text-success text-decoration-none">Quên mật khẩu?</a>
                    </div>
                </div>

                <button type="submit" class="btn btn-success w-100 mb-3">Đăng nhập</button>

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
                    <p class="mb-0">Bạn đã chưa có tài khoản? <a href="{{ route('register.job-seeker') }}" class="text-success text-decoration-none">Đăng ký Người tìm việc</a> | <a href="{{ route('register.recruiter') }}" class="text-success text-decoration-none">Đăng ký Nhà tuyển dụng</a></p>
                    <p class="mt-3 mb-0">Bạn gặp khó khăn khi đăng nhập?</p>
                    <p class="text-muted">Vui lòng gọi tới số <strong>(0966) 069 848</strong> (giờ hành chính)</p>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
