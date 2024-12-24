@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Approved Jobs</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Company Logo</th>
                <th>Company Name</th>
                <th>Job Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($jobs as $job)
            <tr>
                <td><img src="{{ $job->company->logo }}" alt="Company Logo" width="50"></td>
                <td>{{ $job->company->name }}</td>
                <td>{{ $job->title }}</td>
                <td>
                    <form action="{{ route('admin.jobs.destroy', $job->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                    <form action="{{ route('admin.jobs.toggle-featured', $job->id) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-warning">{{ $job->is_featured ? 'Unfeature' : 'Feature' }}</button>
                    </form>
                </td>
            </tr>
            @endForeach
        </tbody>
    </table>
</div>
@endSection
