@extends('layouts.job-seeker')

@section('content')
<div class="container py-5">
    <h1 class="mb-4">Thông tin cá nhân</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    <img
                        src="{{ $jobSeeker->avatar ? asset($jobSeeker->avatar) : asset('default-avatar.png') }}"
                        alt="Avatar"
                        class="rounded-circle mb-3"
                        style="width: 150px; height: 150px; object-fit: cover;"
                    >
                    <h5 class="card-title">{{ $jobSeeker->full_name }}</h5>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('job-seeker.profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="full_name" class="form-label">Họ và tên</label>
                            <input
                                type="text"
                                id="full_name"
                                name="full_name"
                                class="form-control @error('full_name') is-invalid @enderror"
                                value="{{ old('full_name', $jobSeeker->full_name) }}"
                                required
                            >
                            @error('full_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="avatar" class="form-label">Ảnh đại diện</label>
                            <input
                                type="file"
                                id="avatar"
                                name="avatar"
                                class="form-control @error('avatar') is-invalid @enderror"
                            >
                            @error('avatar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endSection
