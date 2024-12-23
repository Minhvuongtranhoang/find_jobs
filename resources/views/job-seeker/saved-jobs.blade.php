@extends('layouts.job-seeker')

@section('content')
    <section class="py-5 bg-light">
        <div class="container">
          <h3 style="margin-bottom: 20px"><span style="color: #3C6E71; font-weight: bold;">Công việc đã lưu</span></h3>

            @if ($savedJobs->isEmpty())
                <p>Hiện tại bạn chưa lưu công việc nào.</p>
            @else
                <div class="row">
                    @foreach ($savedJobs as $savedJob)
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="job-card">
                                <div class="favorite-icon" data-id="{{ $savedJob->job->id }}"
                                    onclick="toggleFavorite({{ $savedJob->job->id }}, this)">
                                    <i class="fa fas fa-heart"></i>
                                </div>
                                <div class="d-flex align-items-center">
                                    <div class="square-company-logo">
                                        <img src="{{ filter_var($savedJob->job->company->logo, FILTER_VALIDATE_URL) ? $savedJob->job->company->logo : Storage::url($savedJob->job->company->logo) }}"
                                            alt="Company Logo" class="job-logo">
                                    </div>
                                    <div>
                                        <a class="nav-link" href="{{ route('detail-job', $savedJob->job->id) }}">
                                            <h6 class="limited-text">{{ $savedJob->job->title }}</h6>
                                        </a>
                                        <p style="margin-left: 10px" class="text-muted mb-2">
                                            {{ $savedJob->job->company->name }}</p>
                                        <div style="margin-left: 10px" class="text-muted mb-3">
                                            <i class="fas fa-map-marker-alt me-2"></i>{{ $savedJob->job->location->city }}
                                            <i class="fas fa-dollar-sign ms-3 me-2"></i>{{ $savedJob->job->salary }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endForeach
                </div>
            @endif
        </div>
    </section>

@push('styles')
<link rel="styleSheet" href="{{ asset('css/dropdown-menu.css') }}">
@endPush

@endSection
