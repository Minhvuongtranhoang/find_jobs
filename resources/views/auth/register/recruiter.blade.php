<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Ký Nhà Tuyển Dụng</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="styleSheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="styleSheet">
    <link href="{{ asset('css/auth.css') }}" rel="styleSheet">
</head>
<body>
    <div class="container">
        <div class="form-container">
            <div class="logo-container">
                <h4 class="text-success mb-3">Đăng Ký Nhà Tuyển Dụng</h4>
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

            <form method="POST" action="{{ route('register.recruiter') }}">
                @csrf
                <div class="mb-3">
                    <div class="input-group">
                        <span class="input-group-text bg-white"><i class="fas fa-envelope text-muted"></i></span>
                        <input type="email" id="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}" required>
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
                    <div class="input-group">
                        <span class="input-group-text bg-white"><i class="fas fa-phone text-muted"></i></span>
                        <input type="tel" id="phone" name="phone" class="form-control" placeholder="Số điện thoại" value="{{ old('phone') }}" required>
                    </div>
                </div>

                <div class="mb-3">
                    <div class="input-group">
                        <span class="input-group-text bg-white"><i class="fas fa-building text-muted"></i></span>
                        <input type="text" id="company_name" name="company_name" class="form-control" placeholder="Tên công ty" value="{{ old('company_name') }}" required>
                    </div>
                </div>

                <!-- Address fields -->
                <div class="mb-3">
                    <div class="input-group">
                        <span class="input-group-text bg-white"><i class="fas fa-home text-muted"></i></span>
                        <input type="text" id="house_number" name="house_number" class="form-control" placeholder="Số nhà" value="{{ old('house_number') }}" required>
                    </div>
                </div>

                <div class="mb-3">
                    <div class="input-group">
                        <span class="input-group-text bg-white"><i class="fas fa-road text-muted"></i></span>
                        <input type="text" id="street" name="street" class="form-control" placeholder="Đường" value="{{ old('street') }}" required>
                    </div>
                </div>

                <div class="mb-3">
                    <div class="input-group">
                        <span class="input-group-text bg-white"><i class="fas fa-map-marker-alt text-muted"></i></span>
                        <input type="text" id="ward" name="ward" class="form-control" placeholder="Phường" value="{{ old('ward') }}" required>
                    </div>
                </div>

                <div class="mb-3">
                    <div class="input-group">
                        <span class="input-group-text bg-white"><i class="fas fa-map-marker-alt text-muted"></i></span>
                        <input type="text" id="district" name="district" class="form-control" placeholder="Quận" value="{{ old('district') }}" required>
                    </div>
                </div>

                <div class="mb-3">
                    <div class="input-group">
                        <span class="input-group-text bg-white"><i class="fas fa-city text-muted"></i></span>
                        <input type="text" id="city" name="city" class="form-control" placeholder="Thành phố" value="{{ old('city') }}" required>
                    </div>
                </div>

                <!-- Google Maps Link -->
                <div class="mb-3">
                    <div class="input-group">
                        <span class="input-group-text bg-white"><i class="fas fa-map text-muted"></i></span>
                        <input type="text" id="google_maps_link" name="google_maps_link" class="form-control" placeholder="Link Google Maps (không bắt buộc)" value="{{ old('google_maps_link') }}">
                    </div>
                </div>

                <button type="submit" class="btn btn-success w-100 mb-3">Đăng ký</button>
            </form>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
