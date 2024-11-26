<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký tài khoản</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            min-height: 100vh;
            display: flex;
            align-items: center;
        }
        .form-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            padding: 2rem;
            max-width: 500px;
            width: 100%;
            margin: 2rem auto;
        }
        .form-control {
            border-radius: 8px;
            padding: 0.8rem 1rem;
            border: 1px solid #dee2e6;
        }
        .form-control:focus {
            box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
            border-color: #28a745;
        }
        .btn-success {
            background-color: #00b14f;
            border: none;
            padding: 0.8rem;
            border-radius: 8px;
            font-weight: 500;
        }
        .btn-success:hover {
            background-color: #009a44;
        }
        .social-buttons .btn {
            flex: 1;
            padding: 0.8rem;
            margin: 0.5rem;
            border-radius: 8px;
            font-weight: 500;
        }
        .btn-google {
            background-color: #ea4335;
            color: white;
        }
        .btn-facebook {
            background-color: #1877f2;
            color: white;
        }
        .btn-linkedin {
            background-color: #0a66c2;
            color: white;
        }
        .form-check-input:checked {
            background-color: #00b14f;
            border-color: #00b14f;
        }
        .logo-container {
            text-align: center;
            margin-bottom: 2rem;
        }
        .divider {
            display: flex;
            align-items: center;
            text-align: center;
            margin: 1.5rem 0;
        }
        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid #dee2e6;
        }
        .divider span {
            padding: 0 1rem;
            color: #6c757d;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <div class="logo-container">
                <h4 class="text-success mb-3">Chào mừng bạn đến với Seek a Job</h4>
                <p class="text-muted">Cùng xây dựng một hồ sơ nổi bật và nhận được các cơ hội sự nghiệp lý tưởng</p>
            </div>

            <form>
                <div class="mb-3">
                    <div class="input-group">
                        <span class="input-group-text bg-white"><i class="fas fa-user text-muted"></i></span>
                        <input type="text" class="form-control" placeholder="Nhập họ tên">
                    </div>
                </div>

                <div class="mb-3">
                    <div class="input-group">
                        <span class="input-group-text bg-white"><i class="fas fa-envelope text-muted"></i></span>
                        <input type="email" class="form-control" placeholder="Nhập email">
                    </div>
                </div>

                <div class="mb-3">
                    <div class="input-group">
                        <span class="input-group-text bg-white"><i class="fas fa-lock text-muted"></i></span>
                        <input type="password" class="form-control" placeholder="Nhập mật khẩu">
                        <span class="input-group-text bg-white"><i class="fas fa-eye text-muted"></i></span>
                    </div>
                </div>

                <div class="mb-3">
                    <div class="input-group">
                        <span class="input-group-text bg-white"><i class="fas fa-lock text-muted"></i></span>
                        <input type="password" class="form-control" placeholder="Xác nhận mật khẩu">
                        <span class="input-group-text bg-white"><i class="fas fa-eye text-muted"></i></span>
                    </div>
                </div>

                <div class="mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="terms">
                        <label class="form-check-label" for="terms">
                            Tôi đã đọc và đồng ý với <a href="#" class="text-success">Điều khoản dịch vụ</a> và <a href="#" class="text-success">Chính sách bảo mật</a>
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
                    <p class="mb-0">Bạn đã có tài khoản? <a href="#" class="text-success">Đăng nhập ngay</a></p>
                    <p class="mt-3 mb-0">Bạn gặp khó khăn khi tạo tài khoản?</p>
                    <p class="text-muted">Vui lòng gọi tới số <strong>(024) 6680 5588</strong> (giờ hành chính)</p>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
