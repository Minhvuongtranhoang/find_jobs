@foreach($jobs as $job)
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
@endforeach
