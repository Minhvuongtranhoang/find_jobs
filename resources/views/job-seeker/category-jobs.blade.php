@extends('layouts.job-seeker')

@section('content')
<div class="container">
    <h1 class="mb-4">Công việc trong danh mục: {{ $category->name }}</h1>
    <div class="row" id="job-list">
        @foreach($jobs as $job)
        <div class="col-4 mb-4">
            <div class="job-card border rounded p-3 d-flex align-items-center">
                <!-- Icon yêu thích -->
                <div class="favorite-icon me-3" data-id="{{ $job->id }}" onclick="toggleFavorite({{ $job->id }}, this)">
                    <i class="fa {{ $job->isFavoritedByUser() ? 'fas' : 'far' }} fa-heart"></i>
                </div>

                <!-- Logo công ty -->
                <div class="square-company-logo me-3">
                    <img src="{{ filter_var($job->company->logo, FILTER_VALIDATE_URL) ? $job->company->logo : Storage::url($job->company->logo) }}" alt="Company Logo" class="job-logo rounded">
                </div>

                <!-- Nội dung -->
                <div class="flex-grow-1">
                    <a class="nav-link p-0" href="{{ route('detail-job', $job->id) }}">
                        <h6 class="mb-0">{{ $job->title }}</h6>
                    </a>
                    <p class="text-muted mb-2">{{ $job->company->name }}</p>
                    <div class="text-muted mb-0">
                        <i class="fas fa-map-marker-alt me-1"></i>{{ $job->location->city }}
                        <i class="fas fa-dollar-sign ms-3 me-1"></i>{{ $job->salary }}
                    </div>
                </div>
            </div>
        </div>
        @endForeach
    </div>
</div>
@endSection
