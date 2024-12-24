@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Jobs</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Company Logo</th>
                <th>Company Name</th>
                <th>Job Title</th>
                <th>Location</th>
                <th>Status</th>
                <th>Featured</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($jobs as $job)
            <tr>
                <td><img src="{{ $job->company->logo }}" alt="Company Logo" width="50"></td>
                <td>{{ $job->company->name }}</td>
                <td>{{ $job->title }}</td>
                <td>{{ $job->location->name }}</td>
                <td>{{ ucfirst($job->status) }}</td>
                <td>{{ $job->is_featured ? 'Yes' : 'No' }}</td>
                <td>
                  <form action="{{ route('admin.jobs.destroy', $job->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete Job</button>
                </form>
                    <td>
                      <form action="{{ route('admin.jobs.toggle-featured', $job->id) }}" method="POST" style="display:inline;">
                          @csrf
                          <button type="submit" class="btn btn-warning">{{ $job->is_featured ? 'Unfeature' : 'Feature' }}</button>
                      </form>
                  </td>
                </td>
            </tr>
            @endForeach
        </tbody>
    </table>
</div>
@endSection
