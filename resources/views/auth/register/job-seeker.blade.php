{{-- @extends('layouts.app') --}}

@section('content')
<div class="container">
    <h2>Đăng Ký Người Tìm Việc</h2>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('register.job-seeker') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="full_name">Họ và tên</label>
            <input type="text" id="full_name" name="full_name" class="form-control" value="{{ old('full_name') }}" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required>
        </div>

        <div class="form-group">
            <label for="phone">Số điện thoại</label>
            <input type="text" id="phone" name="phone" class="form-control" value="{{ old('phone') }}" required>
        </div>

        <div class="form-group">
            <label for="password">Mật khẩu</label>
            <input type="password" id="password" name="password" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="password_confirmation">Xác nhận mật khẩu</label>
            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Đăng ký</button>
    </form>
</div>

