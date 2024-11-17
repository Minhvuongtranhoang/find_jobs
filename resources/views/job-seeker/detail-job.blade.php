@extends('layouts.job-seeker')

@section('title', $job->title)

@section('content')
    <div class="container py-5">
        <div class="card shadow">
            <!-- Header Section -->
            <div class="card-header bg-primary text-white p-4">
                <h1 class="display-5 mb-2">{{ $job->title }}</h1>
                <p class="h5 mb-0">
                    <i class="bi bi-building me-2"></i>
                    Công ty: {{ optional($job->company)->name ?? 'Chưa cập nhật' }}
                </p>
            </div>

            <div class="card-body p-4">
                <!-- Job Details Section -->
                <div class="row g-4 mb-4">
                    <div class="col-md-6">
                        <div class="card h-100">
                            <div class="card-body">
                                <h3 class="card-title h5 mb-3">
                                    <i class="bi bi-file-text me-2"></i>Mô tả công việc
                                </h3>
                                <p class="card-text">{{ $job->description }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card h-100">
                            <div class="card-body">
                                <h3 class="card-title h5 mb-3">
                                    <i class="bi bi-list-check me-2"></i>Yêu cầu
                                </h3>
                                <p class="card-text">{{ $job->requirements }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card h-100">
                            <div class="card-body">
                                <h3 class="card-title h5 mb-3">
                                    <i class="bi bi-gift me-2"></i>Quyền lợi
                                </h3>
                                <p class="card-text">{{ $job->benefits }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card h-100">
                            <div class="card-body">
                                <h3 class="card-title h5 mb-3">
                                    <i class="bi bi-info-circle me-2"></i>Thông tin khác
                                </h3>
                                <ul class="list-unstyled mb-0">
                                    <li class="mb-2">
                                        <i class="bi bi-geo-alt me-2"></i>
                                        <strong>Địa điểm:</strong> {{ $job->location->full_address }}
                                    </li>
                                    <li class="mb-2">
                                        <i class="bi bi-clock me-2"></i>
                                        <strong>Thời gian làm việc:</strong> {{ $job->working_hours }}
                                    </li>
                                    <li>
                                        <i class="bi bi-cash me-2"></i>
                                        <strong>Lương:</strong> {{ $job->salary }}
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Application Form -->
                <div class="card bg-light">
                    <div class="card-body p-4">
                        <h2 class="card-title h4 mb-4">
                            <i class="bi bi-send me-2"></i>Ứng tuyển ngay
                        </h2>
                        <form action="{{ route('job.apply', $job->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Họ và tên</label>
                                        <input type="text" name="name" class="form-control" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Email</label>
                                        <input type="email" name="email" class="form-control" required>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label">Số điện thoại</label>
                                        <input type="text" name="phone" class="form-control" required>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label">CV của bạn (PDF, DOC, DOCX)</label>
                                        <input type="file" name="cv_file" class="form-control" accept=".doc, .docx, .pdf"
                                            required>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label">Thư giới thiệu</label>
                                        <textarea name="cover_letter" class="form-control" rows="4"></textarea>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary btn-lg w-100">
                                        <i class="bi bi-send me-2"></i>Nộp hồ sơ ứng tuyển
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
