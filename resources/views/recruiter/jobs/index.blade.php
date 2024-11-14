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
                    <td>{{ $job->location->address }}</td>
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
            @endforeach
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

@endsection
