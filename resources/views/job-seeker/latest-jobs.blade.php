@extends('layouts.job-seeker')

@section('content')
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="mb-4">Công việc mới nhất</h2>

        @if ($jobs->isEmpty())
            <p>Hiện tại không có công việc nào mới nhất.</p>
        @else
            <div class="row">
                @foreach ($jobs as $job)
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
                                    <p style="margin-left: 10px" class="text-muted mb-2">{{ $job->company->name }}</p>
                                    <div style="margin-left: 10px" class="text-muted mb-3">
                                        <i class="fas fa-map-marker-alt me-2"></i>{{ $job->location->address }}
                                        <i class="fas fa-dollar-sign ms-3 me-2"></i>{{ $job->salary }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Phân trang -->
            <div class="d-flex justify-content-center">
                {{ $jobs->links() }}
            </div>
        @endif
    </div>
</section>
@endsection
