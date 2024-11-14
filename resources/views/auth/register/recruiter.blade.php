{{-- @extends('layouts.app') --}}

@section('content')
<div class="container">
    <h2>Đăng Ký Nhà Tuyển Dụng</h2>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form method="POST" action="{{ route('register.recruiter') }}">
        @csrf

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required>
        </div>

        <div class="form-group">
            <label for="password">Mật khẩu</label>
            <input type="password" id="password" name="password" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="password_confirmation">Xác nhận mật khẩu</label>
            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="phone">Số điện thoại</label>
            <input type="tel" id="phone" name="phone" class="form-control" value="{{ old('phone') }}" required>
        </div>

        <div class="form-group">
            <label for="company_name">Tên công ty</label>
            <input type="text" id="company_name" name="company_name" class="form-control" value="{{ old('company_name') }}" required>
        </div>

        <div class="form-group">
            <label for="company_address">Địa chỉ công ty</label>
            <textarea id="company_address" name="company_address" class="form-control" required>{{ old('company_address') }}</textarea>
        </div>

        <div class="form-group">
            <label for="google_maps_link">Link Google Maps (không bắt buộc)</label>
            <input type="text" id="google_maps_link" name="google_maps_link" class="form-control" value="{{ old('google_maps_link') }}">
        </div>

        <button type="submit" class="btn btn-primary">Đăng ký</button>
    </form>
</div>
