<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('css/job-seeker.css') }}" rel="stylesheet">
  </head>

  <body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h2 class="mb-0">Đăng Nhập</h2>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
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
                            <div class="form-group mb-3">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus>
                            </div>

                            <div class="form-group mb-3">
                                <label for="password">Mật khẩu</label>
                                <input type="password" id="password" name="password" class="form-control" required>
                            </div>

                            <div class="form-group form-check mb-3">
                                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                                <label class="form-check-label" for="remember">Ghi nhớ đăng nhập</label>
                            </div>

                            <div class="form-group mb-3">
                                <button type="submit" class="btn btn-primary w-100">Đăng nhập</button>
                            </div>

                            <div class="mt-3 text-center">
                                <p>
                                    <a href="{{ route('password.request') }}">Quên mật khẩu?</a>
                                </p>
                                <p>
                                    Chưa có tài khoản?
                                    <a href="{{ route('register.job-seeker') }}">Đăng ký Người tìm việc</a> |
                                    <a href="{{ route('register.recruiter') }}">Đăng ký Nhà tuyển dụng</a>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </body>
  
</html>
