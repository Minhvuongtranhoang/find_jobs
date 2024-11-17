@extends('layouts.job-seeker')

@section('content')
<section class="py-5">
    <div class="container">
        <h2 class="mb-4">Kết quả tìm kiếm</h2>
        @if($jobs->count() > 0)
            <div class="row">
                @foreach($jobs as $job)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="job-card">
                        <div class="d-flex align-items-center">
                            <div class="square-company-logo">
                                <img src="{{ $job->company->logo }}" alt="Company Logo" class="job-logo">
                            </div>
                            <div>
                                <a class="nav-link" href="{{ route('detail-job', $job->id) }}">
                                    <h6>{{ $job->title }}</h6>
                                </a>
                                <p class="text-muted mb-2">{{ $job->company->name }}</p>
                                <div class="text-muted mb-3">
                                    <i class="fas fa-map-marker-alt me-2"></i>{{ $job->location->city }}
                                    <i class="fas fa-dollar-sign ms-3 me-2"></i>{{ $job->salary }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-4">
                {{ $jobs->links() }}
            </div>
        @else
            <p class="text-muted">Không tìm thấy công việc phù hợp với tiêu chí tìm kiếm của bạn.</p>
        @endif
    </div>
</section>
@endsection
