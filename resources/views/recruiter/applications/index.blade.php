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
                                    @if($application->user->jobSeeker->avatar)
                                      <img src="{{ filter_var($application->user->jobSeeker->avatar, FILTER_VALIDATE_URL) ? $application->user->jobSeeker->avatar : asset('storage/' . $application->user->jobSeeker->avatar)}}" class="rounded-circle me-2" style="height: 40px" width="40px" alt="Avatar">
                                    @endif
                                    <div>
                                      <h6 class="mb-0">
                                        {{ $application->user->jobSeeker->full_name }}
                                      </h6>
                                      <small class="text-muted">
                                        {{ $application->user->email }}
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
                    @endForeach
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
  </div>
@endSection
