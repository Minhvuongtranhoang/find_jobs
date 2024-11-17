@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Edit Category</h1>
    <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $category->name }}" required>
        </div>

        <h2>Jobs in this Category</h2>
        <ul>
            @foreach($category->jobs as $job)
            <li>{{ $job->title }}</li>
            @endforeach
        </ul>

        <h2>Add Existing Jobs</h2>
        <div class="mb-3">
            @foreach($jobs as $job)
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="job-{{ $job->id }}" name="jobs[]" value="{{ $job->id }}"
                @if($category->jobs->contains($job->id)) checked @endif>
                <label class="form-check-label" for="job-{{ $job->id }}">
                    {{ $job->title }}
                </label>
            </div>
            @endforeach
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
@endsection
