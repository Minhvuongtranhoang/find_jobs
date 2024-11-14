@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Pending Jobs</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Company Logo</th>
                <th>Company Name</th>
                <th>Job Name</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($jobs as $job)
            <tr>
                <td><img src="{{ $job->company->logo }}" alt="Company Logo" width="50"></td>
                <td>{{ $job->company->name }}</td>
                <td>{{ $job->title }}</td>
                <td>{{ $job->status }}</td>
                <td>
                    <form action="{{ route('admin.jobs.approve', $job->id) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-success">Approve</button>
                    </form>
                    <form action="{{ route('admin.jobs.reject', $job->id) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-danger">Reject</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
