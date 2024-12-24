@extends('layouts.recruiter')

@section('content')
    <div class="container py-5">
        <div class="card shadow-sm">
            <div class="card-body">
                <h1 class="card-title h3 mb-4">Post New Job</h1>

                <form action="{{ route('recruiter.jobs.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Job Title</label>
                        <input type="text" name="title" value="{{ old('title') }}"
                            class="form-control @error('title') is-invalid @enderror">
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row g-3">
                        <!-- Row 1 -->
                        <div class="col-md-2">
                            <label class="form-label">House Number</label>
                            <input type="text" name="house_number"
                                class="form-control @error('house_number') is-invalid @enderror"
                                value="{{ old('house_number') }}">
                            @error('house_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-5">
                            <label class="form-label">Street</label>
                            <input type="text" name="street" class="form-control @error('street') is-invalid @enderror"
                                value="{{ old('street') }}">
                            @error('street')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-5">
                            <label class="form-label">Ward</label>
                            <input type="text" name="ward" class="form-control @error('ward') is-invalid @enderror"
                                value="{{ old('ward') }}">
                            @error('ward')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row g-3 mt-3">
                        <!-- Row 2 -->
                        <div class="col-md-6">
                            <label class="form-label">District</label>
                            <input type="text" name="district"
                                class="form-control @error('district') is-invalid @enderror" value="{{ old('district') }}">
                            @error('district')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">City</label>
                            <input type="text" name="city" class="form-control @error('city') is-invalid @enderror"
                                value="{{ old('city') }}">
                            @error('city')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>


                    <div class="mb-3">
                        <label class="form-label">Application Deadline</label>
                        <input type="date" name="deadline" value="{{ old('deadline') }}"
                            class="form-control @error('deadline') is-invalid @enderror">
                        @error('deadline')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Job Description</label>
                        <textarea name="description" rows="4" class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Requirements</label>
                        <textarea name="requirements" rows="4" class="form-control @error('requirements') is-invalid @enderror">{{ old('requirements') }}</textarea>
                        @error('requirements')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Benefits</label>
                        <textarea name="benefits" rows="4" class="form-control @error('benefits') is-invalid @enderror">{{ old('benefits') }}</textarea>
                        @error('benefits')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Working Hours</label>
                        <input type="text" name="working_hours" value="{{ old('working_hours') }}"
                            class="form-control @error('working_hours') is-invalid @enderror">
                        @error('working_hours')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Salary</label>
                        <input type="text" name="salary" value="{{ old('salary') }}"
                            class="form-control @error('salary') is-invalid @enderror">
                        @error('salary')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary">
                            Post Job
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endSection
