@extends('layouts.job-seeker')

@section('title', $job->title)

@section('content')
<div class="container py-4">
    <!-- Job Title -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4">
        <div>
            <h1 class="display-6 fw-bold">{{ $job->title }}</h1>
            <p class="mb-0 text-muted">
                <i class="bi bi-geo-alt-fill me-1"></i> {{ $job->location->full_address }}
                <span class="mx-2">|</span>
                <i class="bi bi-briefcase-fill me-1"></i> {{ $job->experience }} 3 năm kinh nghiệm
            </p>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="d-flex flex-column flex-md-row justify-content-start align-items-start mb-4">
        <button class="btn btn-primary btn-md me-2" data-bs-toggle="modal" data-bs-target="#applyModal">
            Ứng tuyển ngay
        </button>

        <button class="btn btn-outline-success btn-md me-2" onclick="toggleFavorite({{ $job->id }}, this)">
            <i class="fa {{ $job->isFavoritedByUser() ? 'fas' : 'far' }} fa-heart me-1"></i>
            {{ $job->isFavoritedByUser() ? 'Đã lưu' : 'Lưu tin' }}
        </button>

        <button class="btn btn-outline-danger btn-md me-2" data-bs-toggle="modal" data-bs-target="#reportModal">
           Báo cáo
        </button>
    </div>

    <!-- Apply Modal -->
    <div class="modal fade" id="applyModal" tabindex="-1" aria-labelledby="applyModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="applyForm" action="{{ route('job.apply', ['jobId' => $job->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="job_id" value="{{ $job->id }}">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="applyModalLabel">Ứng tuyển công việc</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Họ và Tên</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Nhập họ và tên" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Nhập email" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Số điện thoại</label>
                            <input type="text" class="form-control" id="phone" name="phone" placeholder="Nhập số điện thoại" required>
                        </div>
                        <div class="mb-3">
                            <label for="cv_file" class="form-label">Tải lên CV</label>
                            <input type="file" class="form-control" id="cv_file" name="cv_file" required>
                        </div>
                        <div class="mb-3">
                            <label for="cover_letter" class="form-label">Thư ứng tuyển (Không bắt buộc)</label>
                            <div id="editor" style="height: 200px;"></div>
                            <textarea name="cover_letter" id="cover_letter" style="display: none;"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-primary">Nộp đơn</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Report Modal -->
    <div class="modal fade" id="reportModal" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="reportForm" action="{{ route('job.report', ['jobId' => $job->id]) }}" method="POST">
                @csrf
                <input type="hidden" name="reported_type" value="job">
                <input type="hidden" name="reported_id" value="{{ $job->id }}">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="reportModalLabel">Báo cáo công việc</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="reason" class="form-label">Lý do báo cáo</label>
                            <textarea
                                class="form-control"
                                id="reason"
                                name="reason"
                                rows="4"
                                placeholder="Mô tả lý do báo cáo..."
                                required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                        <button type="submit" class="btn btn-danger">Gửi báo cáo</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

        <!-- Job Details -->
        <div class="row g-4">
            <!-- Left Column -->
            <div class="col-md-8">
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <h3 class="h5 mb-3"><i class="bi bi-list-check me-2"></i>Chi tiết tin tuyển dụng</h3>
                        <p class="mb-2"><strong>Chuyên môn:</strong>
                            @foreach ($job->categories as $category)
                                {{ $category->name }}@if (!$loop->last)
                                    ,
                                @endif
                            @endForeach
                        </p>
                        <p class="mb-2"><strong>Hạn nộp hồ sơ:</strong> {{ $job->deadline->format('h:m, d/m/Y') }}</p>
                        <p class="mb-2"><strong>Mức lương:</strong> {{ $job->salary }}</p>
                    </div>
                </div>

                <!-- Job Description -->
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <h1 class="h5 mb-3"><i class="bi bi-file-text me-2"></i>Mô tả công việc</h1>
                        <p>{!! $job->description !!}</p>
                    </div>
                </div>

                <!-- Job Requirements -->
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <h3 class="h5 mb-3"><i class="bi bi-clipboard-check me-2"></i>Yêu cầu ứng viên</h3>
                        <p>{!! $job->requirements !!}</p>
                    </div>
                </div>

                <!-- Benefits -->
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <h3 class="h5 mb-3"><i class="bi bi-gift-fill me-2"></i>Quyền lợi</h3>
                        <p>{{ $job->benefits }}</p>
                    </div>
                </div>
            </div>

            <!-- Right Column -->
            <div class="col-md-4">
                <!-- Company Information -->
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <h3 class="h5 mb-3"><i class="bi bi-building me-2"></i>Thông tin công ty</h3>
                        <div class="d-flex align-items-center">
                            <!-- Company Logo -->
                            <div class="square-company-logo me-3">
                                <img src="{{ filter_var($job->company->logo, FILTER_VALIDATE_URL) ? $job->company->logo : Storage::url($job->company->logo) }}"
                                    alt="Company Logo" class="job-logo rounded">
                            </div>

                            <!-- Company Information -->
                            <div class="flex-grow-1">
                                <p class="mb-2"><strong>Tên công ty:</strong><a class="nav-link d-inline"
                                        href={{ route('companies.show', $job->company->id) }}>{{ optional($job->company)->name ?? 'Chưa cập nhật' }}</a>
                                </p>
                                <p class="mb-2"><strong>Quy mô:</strong>
                                    {{ optional($job->company)->employee_count ?? 'Chưa cập nhật' }} <a>Nhân Viên</a></p>
                                <p class="mb-2"><strong>Ngành nghề:</strong>
                                    {{ optional($job->company)->industry ?? 'Chưa cập nhật' }}</p>
                                <p><strong>Địa chỉ:</strong> {{ optional($job->location)->city ?? 'Chưa cập nhật' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h3 class="h5 mb-3">
                            <i class="bi bi-tags me-2"></i>
                            Danh mục Nghề liên quan
                        </h3>

                        <div class="row g-3">
                            <div class="col-12">
                                <h6 class="text-muted mb-2">Ngành nghề</h6>
                                <div class="d-flex flex-wrap gap-2">
                                    <a href="#" class="badge bg-light text-dark text-decoration-none">Công nghệ
                                        Thông
                                        tin</a>
                                    <a href="#" class="badge bg-light text-dark text-decoration-none">IT
                                        Infrastructure</a>
                                    <a href="#" class="badge bg-light text-dark text-decoration-none">System
                                        Engineer</a>
                                </div>
                            </div>

                            <div class="col-12">
                                <h6 class="text-muted mb-2">Kỹ năng chính</h6>
                                <div class="d-flex flex-wrap gap-2">
                                    <a href="#" class="badge bg-light text-dark text-decoration-none">Microsoft
                                        Certified</a>
                                    <a href="#"
                                        class="badge bg-light text-dark text-decoration-none">Virtualization</a>
                                </div>
                            </div>

                            <div class="col-12">
                                <h6 class="text-muted mb-2">Kỹ năng nên có</h6>
                                <div class="d-flex flex-wrap gap-2">
                                    <a href="#" class="badge bg-light text-dark text-decoration-none">Linux</a>
                                    <a href="#" class="badge bg-light text-dark text-decoration-none">Windows
                                        Server</a>
                                    <a href="#" class="badge bg-light text-dark text-decoration-none">CentOS</a>
                                    <a href="#" class="badge bg-light text-dark text-decoration-none">Ubuntu</a>
                                </div>
                            </div>

                            <div class="col-12">
                                <h6 class="text-muted mb-2">Khu vực</h6>
                                <div class="d-flex flex-wrap gap-2">
                                    <a href="#"
                                        class="badge bg-light text-dark text-decoration-none">{{ optional($job->location)->city ?? 'Chưa cập nhật' }}</a>
                                    <a href="#"
                                        class="badge bg-light text-dark text-decoration-none">{{ optional($job->location)->district ?? 'Chưa cập nhật' }}</a>
                                    <a href="#"
                                        class="badge bg-light text-dark text-decoration-none">{{ optional($job->location)->street ?? 'Chưa cập nhật' }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Related Jobs Section -->
        <div class="container mt-4">
            <h2 class="mb-4">Công việc liên quan</h2>
            <div class="row" id="job-list">
                @foreach ($relatedJobs as $job)
                <div class="col-lg-4 col-md-6 mb-4">
                  <div class="job-card">
                      <div class="favorite-icon" data-id="{{ $job->id }}" onclick="toggleFavorite({{ $job->id }}, this)">
                          <i class="fa {{ $job->isFavoritedByUser() ? 'fas' : 'far' }} fa-heart"></i>
                      </div>
                      <div class="d-flex align-items-center">
                          <div class="square-company-logo">
                              <img src="{{ filter_var($job->company->logo, FILTER_VALIDATE_URL) ? $job->company->logo : Storage::url($job->company->logo) }}" alt="Company Logo" class="job-logo">
                          </div>
                          <div>
                              <a class="nav-link" href="{{ route('detail-job', $job->id) }}">
                                  <h6 class="limited-text">{{ $job->title }}</h6>
                              </a>
                              <p style="margin-left: 10px" class="text-muted mb-2">{{ $job->company->name }}</p>
                              <div style="margin-left: 10px" class="text-muted mb-3">
                                  <i class="fas fa-map-marker-alt me-1"></i>{{ $job->location->city }}
                                  <i class="fas fa-dollar-sign ms-2 me-1"></i>{{ $job->salary }}
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
                @endForeach
            </div>
        </div>
    </div>
@endSection
