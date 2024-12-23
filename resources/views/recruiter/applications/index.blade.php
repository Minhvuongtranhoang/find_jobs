@extends('layouts.recruiter')

@section('content')

  <div class="row">
    <div class="col-12 col-xxl-8 mb-4">
      <div class="card">
        <div class="card-header">
          <div class="d-flex align-items-center justify-content-between">
            <h5 class="card-title mb-0">Job Applications</h5>
            <div class="search-box">
              <i class="fas fa-search"></i>
              <input type="text" class="form-control" plaiceholder="Search...">
            </div>
          </div>
        </div>
       {{-- show Notification --}}
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
                        <th>Applicant</th>
                        <th>Job Position</th>
                        <th>Applied Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                  @foreach($applications as $application)
                  <tr>
                    <td>
                      <div class="d-flex align-items-center">
                        @if($application->user && $application->user->jobSeeker && $application->user->jobSeeker->avatar)
                        <img src="{{ filter_var($application->user->jobSeeker->avatar, FILTER_VALIDATE_URL)
                                  ? $application->user->jobSeeker->avatar
                                  : asset('' . $application->user->jobSeeker->avatar) }}"
                             class="rounded-circle me-2"
                             style="height: 40px"
                             width="40px"
                             alt="Avatar">
                        @endif
                          <div>
                              <h6 class="mb-0">
                                  {{ $application->user->jobSeeker->full_name ?? 'N/A' }}
                              </h6>
                              <small class="text-muted">
                                  {{ $application->user->email ?? 'N/A' }}
                              </small>
                          </div>
                      </div>
                  </td>
                      <td>{{ $application->job->title }}</td>
                      <td>{{ $application->created_at->format('M d, Y') }}</td>
                      <td>
                        <span
                              @class([
                                  'status-badge status-approved' => $application->status === 'approved',
                                  'status-badge status-rejected' => $application->status === 'rejected',
                                  'status-badge status-pending' => $application->status === 'pending',
                              ])>
                          {{ ucfirst($application->status) }}
                        </span>
                      </td>

                      <td>
                        <div class="btn-group">
                          <a href="{{ route('recruiter.applications.show', $application->id) }}" class="btn btn-light btn-sm" title="View"><i class="fas fa-eye"></i></a>
                          <a href="{{ route('recruiter.applications.download-cv', $application->id) }}" class="btn btn-light btn-sm" title="Download CV"><i class="fas fa-download"></i></a>
                          <a href="{{ route('recruiter.applications.destroy', $application->id) }}" class="btn btn-light btn-sm" title="Destroy"><i class="fas fa-trash"></i></a>
                        </div>
                      </td>
                  </tr>
                @endforeach
                </tbody>
              </table>

              <div class="d-flex flex-column align-items-center" style="margin-top: 30px">
                <div>
                  {{ $applications->links('pagination::bootstrap-4') }}
                </div>
                <div class="text-muted mt-2">
                Showing {{ $applications->firstItem() }} to {{ $applications->lastItem() }} of {{ $applications->total() }} results
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
