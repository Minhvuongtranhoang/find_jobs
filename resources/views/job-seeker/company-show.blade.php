@extends('layouts.job-seeker')

@section('content')
<div class="container mt-4">
    <div class="row">
        <!-- Cột trái: Thông tin công ty + Danh sách tuyển dụng -->
        <div class="col-md-8">
            <!-- Thông tin công ty -->
            <div class="card mb-4">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="square-company-logo me-3">
                            <img src="{{ filter_var($company->logo, FILTER_VALIDATE_URL) ? $company->logo : Storage::url($company->logo) }}" alt="Company Logo" class="job-logo rounded">
                        </div>
                        <div>
                            <h4 class="mb-1">{{ $company->name }}</h4>
                            <p class="mb-0 text-muted">{{ $company->industry }} | {{ $company->employee_count }} nhân viên</p>
                            <a href="{{ $company->website }}" class="text-primary text-decoration-none"  target="_blank">{{ $company->website }}</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Giới thiệu công ty -->
            <div class="card mb-4">
                <div class="card-body">
                    <h5>Giới thiệu</h5>
                    <!-- Hiển thị nội dung HTML đã lưu trong cơ sở dữ liệu -->
                    <div>{!! $company->description !!}</div>
                </div>
            </div>


            <!-- Danh sách tuyển dụng -->

                <div class="card-body">
                    <h5>Các vị trí tuyển dụng</h5>
                    <div class="row" id="job-list">
                        @foreach($company->jobs as $job)
                          <div class="col-lg-6 col-md-6 mb-4">
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

        <!-- Cột phải: Thông tin liên hệ -->
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-body">
                    <h5>Thông tin liên hệ</h5>
                    @foreach ($company->locations as $location)
                        <p>{{ $location->house_number }}, {{ $location->street }}, {{ $location->ward }}, {{ $location->district }}, {{ $location->city }}</p>
                        @if ($location->google_maps_link)
                            <iframe
                                src="{{ $location->google_maps_link }}"
                                width="100%"
                                height="150"
                                style="border:0;"
                                allowfullscreen=""
                                loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                        @endif
                    @endForeach
                </div>
            </div>
        </div>
    </div>
</div>


@push('styles')
<link rel="styleSheet" href="{{ asset('css/dropdown-menu.css') }}">
@endPush



@endSection
