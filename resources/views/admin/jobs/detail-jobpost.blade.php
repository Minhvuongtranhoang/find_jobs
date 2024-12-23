@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h2>{{ $job->title }}</h2>
                </div>
                <div class="card-body">
                    <p><strong>Company:</strong> {{ $job->company }}</p>
                    <p><strong>Location:</strong> {{ $job->location }}</p>
                    <p><strong>Salary:</strong> {{ $job->salary }}</p>
                    <p><strong>Description:</strong></p>
                    <p>{{ $job->description }}</p>
                </div>
                <div class="card-footer">
                    <a href="{{ route('jobs.index') }}" class="btn btn-primary">Back to Job Listings</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endSection
