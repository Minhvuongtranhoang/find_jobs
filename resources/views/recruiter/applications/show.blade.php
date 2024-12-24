@extends('layouts.recruiter')

@section('content')
<div class="container py-5">
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3">Application Details</h1>
                <a href="{{ route('recruiter.applications.download-cv', $application) }}" class="btn btn-primary">
                    Download CV
                </a>
            </div>

            <div class="mb-4">
                <h2 class="h5">Applicant Information</h2>
                <div class="row">
                    <div class="col-md-6">
                        <p class="text-muted mb-1">Name</p>
                        <p class="fw-bold">{{ $application->user->jobSeeker->full_name }}</p>
                    </div>
                    <div class="col-md-6">
                        <p class="text-muted mb-1">Email</p>
                        <p class="fw-bold">{{ $application->user->email }}</p>
                    </div>
                </div>
            </div>

            <div class="mb-4">
                <h2 class="h5">Job Information</h2>
                <div class="row">
                    <div class="col-md-6">
                        <p class="text-muted mb-1">Position</p>
                        <p class="fw-bold">{{ $application->job->title }}</p>
                    </div>
                    <div class="col-md-6">
                        <p class="text-muted mb-1">Applied Date</p>
                        <p class="fw-bold">{{ $application->created_at->format('M d, Y') }}</p>
                    </div>
                </div>
            </div>

            @if($application->cover_letter)
                <div class="mb-4">
                    <h2 class="h5">Cover Letter</h2>
                    <div class="bg-light p-3 rounded">
                        {!! $application->cover_letter !!}
                    </div>
                </div>
            @endif

            <div class="mb-4">
                <h2 class="h5">Application Status</h2>
                <form action="{{ route('recruiter.applications.update-status', $application) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">Update Status</label>
                        <select name="status" class="form-select">
                            <option value="pending" {{ $application->status === 'pending' ? 'selected' : '' }}>
                                Pending Review
                            </option>
                            <option value="approved" {{ $application->status === 'approved' ? 'selected' : '' }}>
                                Approve
                            </option>
                            <option value="rejected" {{ $application->status === 'rejected' ? 'selected' : '' }}>
                                Reject
                            </option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Note</label>
                        <textarea name="note" rows="3" class="form-control"></textarea>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-success">
                            Update Status
                        </button>
                    </div>
                </form>
            </div>

            @if($application->statusHistory->count() > 0)
                <div>
                    <h2 class="h5">Status History</h2>
                    <div class="list-group">
                        @foreach($application->statusHistory as $history)
                            <div class="list-group-item">
                                <div class="d-flex justify-content-between">
                                    <span class="fw-bold">{{ ucfirst($history->status) }}</span>
                                    <span class="text-muted">{{ $history->created_at->format('M d, Y H:i') }}</span>
                                </div>
                                @if($history->note)
                                    <p class="mb-0">{{ $history->note }}</p>
                                @endif
                            </div>
                        @endForeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endSection
