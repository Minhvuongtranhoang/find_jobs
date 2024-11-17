@extends('layouts.recruiter')

@section('content')
<div class="container py-5">
    <div class="card shadow-sm">
        <div class="card-body">
            <h1 class="h3 mb-4">Edit Job</h1>

            <form action="{{ route('recruiter.jobs.update', $job->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Job Title</label>
                    <input type="text" name="title" value="{{ old('title', $job->title) }}"
                           class="form-control @error('title') is-invalid @enderror">
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Location</label>
                    <select name="location_id" class="form-select @error('location_id') is-invalid @enderror">
                        <option value="">Select Location</option>
                        @foreach($locations as $location)
                            <option value="{{ $location->id }}" {{ old('location_id', $job->location_id) == $location->id ? 'selected' : '' }}>
                              số {{ $location->house_number }}, đường {{ $location->street }}, phường {{$location->ward}}, quận {{$location->district}}, TP. {{ $location->city }}
                            </option>
                        @endforeach
                    </select>
                    @error('location_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Application Deadline</label>
                    <input type="date" name="deadline" value="{{ old('deadline', $job->deadline) }}"
                           class="form-control @error('deadline') is-invalid @enderror">
                    @error('deadline')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Job Description</label>
                    <textarea name="description" rows="4"
                              class="form-control @error('description') is-invalid @enderror">{{ old('description', $job->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Requirements</label>
                    <textarea name="requirements" rows="4"
                              class="form-control @error('requirements') is-invalid @enderror">{{ old('requirements', $job->requirements) }}</textarea>
                    @error('requirements')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Benefits</label>
                    <textarea name="benefits" rows="4"
                              class="form-control @error('benefits') is-invalid @enderror">{{ old('benefits', $job->benefits) }}</textarea>
                    @error('benefits')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Working Hours</label>
                    <input type="text" name="working_hours" value="{{ old('working_hours', $job->working_hours) }}"
                           class="form-control @error('working_hours') is-invalid @enderror">
                    @error('working_hours')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Salary</label>
                    <input type="text" name="salary" value="{{ old('salary', $job->salary) }}"
                           class="form-control @error('salary') is-invalid @enderror">
                    @error('salary')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-success">
                        Update Job
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
