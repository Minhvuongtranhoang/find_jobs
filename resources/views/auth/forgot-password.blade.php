{{-- @extends('layouts.app') --}}

@section('content')
<div class="container">
    <h2>Quên Mật Khẩu</h2>

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

    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus>
        </div>

        <button type="submit" class="btn btn-primary">Gửi Link Đặt Lại Mật Khẩu</button>
    </form>
</div>
