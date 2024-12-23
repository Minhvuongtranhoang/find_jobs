@extends('layouts.recruiter')

@section('content')
<div class="row">
    <div class="col-12 col-xxl-8 mb-4">
        <div class="card">
            <div class="card-header">
              <div class="d-flex align-items-center justify-content-between">
                <h5 class="card-title mb-0">Manage Jobs</h5>
                <a href="{{ route('recruiter.jobs.create') }}" class="btn btn-primary btn-sm">Post New Job</a>
              </div>
            </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table table-hover table-nowrap">
          <thead>
            <tr>
              <th>Title</th>
              <th>Location</th>
              <th>Status</th>
              <th>Deadline</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach($jobs as $job)
                <tr>
                    <td>{{ $job->title }}</td>
                    <td>{{ $job->location->district}} - {{$job->location->city}}</td>
                    <td>
                        <span class="badge
                            {{ $job->status === 'approved' ? 'status-badge status-approved' :
                               ($job->status === 'pending' ? 'status-badge status-pending' :
                               'bg-danger') }}">
                            {{ ucfirst($job->status) }}
                        </span>
                    </td>
                    <td>{{ $job->deadline->format('M d, Y') }}</td>
                    <td>
                      <div class="btn-group">
                        <a href="{{ route('recruiter.jobs.edit', $job) }}" class="btn btn-light btn-sm " title="Edit"><i class="fas fa-edit" style="color: blue"></i></a>
                        <form action="{{ route('recruiter.jobs.destroy', $job) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-light btn-sm" onclick="return confirm('Are you sure you want to delete this job?')">
                                <i class="fas fa-trash" style="color: red"></i>
                            </button>
                        </form>
                      </div>
                    </td>
                  </tr>
            @endForeach
          </tbody>
        </table>
        <div class="d-flex flex-column align-items-center" style="margin-top: 30px">
          <div>
              {{ $jobs->links('pagination::bootstrap-4') }}
          </div>
          <div class="text-muted mt-2">
              Showing {{ $jobs->firstItem() }} to {{ $jobs->lastItem() }} of {{ $jobs->total() }} results
          </div>
      </div>

      </div>
    </div>
  </div>
</div>
<!-- Upcoming Interviews -->
<div class="col-12 col-xxl-4 mb-4">
  <div class="card">
      <div class="card-header">
          <div class="d-flex align-items-center justify-content-between">
              <h5 class="card-title mb-0">Upcoming Interviews</h5>
              <button class="btn btn-primary btn-sm">View Calendar</button>
          </div>
      </div>
      <div class="card-body">
          <div class="interview-list">
              <div class="interview-item p-3 mb-3 bg-light rounded-3">
                  <div class="d-flex align-items-center mb-2">
                      <img src="/api/placeholder/32/32" class="rounded-circle me-2" alt="Avatar">
                      <div>
                          <h6 class="mb-0">David Wilson</h6>
                          <small class="text-muted">Frontend Developer</small>
                      </div>
                  </div>
                  <div class="d-flex align-items-center text-muted">
                      <i class="fas fa-calendar-alt me-2"></i>
                      <span>Today, 2:00 PM</span>
                  </div>
              </div>

              <div class="interview-item p-3 mb-3 bg-light rounded-3">
                  <div class="d-flex align-items-center mb-2">
                      <img src="/api/placeholder/32/32" class="rounded-circle me-2" alt="Avatar">
                      <div>
                          <h6 class="mb-0">Emma Davis</h6>
                          <small class="text-muted">Marketing Manager</small>
                      </div>
                  </div>
                  <div class="d-flex align-items-center text-muted">
                      <i class="fas fa-calendar-alt me-2"></i>
                      <span>Tomorrow, 10:30 AM</span>
                  </div>
              </div>

              <div class="interview-item p-3 bg-light rounded-3">
                  <div class="d-flex align-items-center mb-2">
                      <img src="/api/placeholder/32/32" class="rounded-circle me-2" alt="Avatar">
                      <div>
                          <h6 class="mb-0">Alex Thompson</h6>
                          <small class="text-muted">DevOps Engineer</small>
                      </div>
                  </div>
                  <div class="d-flex align-items-center text-muted">
                      <i class="fas fa-calendar-alt me-2"></i>
                      <span>Oct 25, 3:15 PM</span>
                  </div>

                </div>
          </div>
      </div>
  </div>
</div>

</div>

@endSection
