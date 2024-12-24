@extends('layouts.recruiter')

@section('content')
<div class="container py-5">
  <div class="card shadow-sm">
      <div class="card-body">
        <h1 class="text-2xl font-bold mb-6">Edit Company Information</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('recruiter.company.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="form-label">Company Logo</label>
                <input type="file" name="logo" accept="image/*" class="form-control">
                @if($company->logo)
                    <div class="mt-2">
                        <img src="{{ Storage::url($company->logo) }}" alt="Company Logo" class="img-fluid h-20 w-auto">
                    </div>
                @endif
            </div>

            <div class="mb-4">
                <label class="form-label">Company Name</label>
                <input type="text" name="name" value="{{ old('name', $company->name) }}" class="form-control">
            </div>

            <div class="mb-4">
                <label class="form-label">Email</label>
                <input type="email" name="email" value="{{ old('email', $company->email) }}" class="form-control">
            </div>

            <div class="mb-4">
                <label class="form-label">Website</label>
                <input type="url" name="website" value="{{ old('website', $company->website) }}" class="form-control">
            </div>

            <div class="mb-4">
                <label class="form-label">Phone</label>
                <input type="text" name="phone" value="{{ old('phone', $company->phone) }}" class="form-control">
            </div>

            <div class="mb-4">
                <label class="form-label">Industry</label>
                <input type="text" name="industry" value="{{ old('industry', $company->industry) }}" class="form-control">
            </div>

            <div class="mb-4">
                <label class="form-label">Employee Count</label>
                <input type="number" name="employee_count" value="{{ old('employee_count', $company->employee_count) }}" class="form-control">
            </div>

            <div class="mb-4">
                <label class="form-label">Description</label>
                <textarea name="description" rows="4" class="form-control">{{ old('description', $company->description) }}</textarea>
            </div>

            <div class="mb-4">
              <label class="form-label">Locations</label>
              <div id="locations-container">
                  @foreach($company->locations as $location)
                      <div class="location-item mb-4 p-4 border rounded">
                          <input type="hidden" name="locations[{{ $loop->index }}][id]" value="{{ $location->id }}">
                          <div class="mb-2">
                              <label class="form-label">House Number</label>
                              <input type="text" name="locations[{{ $loop->index }}][house_number]"
                                     value="{{ $location->house_number }}" class="form-control">
                          </div>
                          <div class="mb-2">
                              <label class="form-label">Street</label>
                              <input type="text" name="locations[{{ $loop->index }}][street]"
                                     value="{{ $location->street }}" class="form-control">
                          </div>
                          <div class="mb-2">
                              <label class="form-label">Ward</label>
                              <input type="text" name="locations[{{ $loop->index }}][ward]"
                                     value="{{ $location->ward }}" class="form-control">
                          </div>
                          <div class="mb-2">
                              <label class="form-label">District</label>
                              <input type="text" name="locations[{{ $loop->index }}][district]"
                                     value="{{ $location->district }}" class="form-control">
                          </div>
                          <div class="mb-2">
                              <label class="form-label">City</label>
                              <input type="text" name="locations[{{ $loop->index }}][city]"
                                     value="{{ $location->city }}" class="form-control">
                          </div>
                          <div class="mb-2">
                              <label class="form-label">Google Maps Link</label>
                              <input type="url" name="locations[{{ $loop->index }}][google_maps_link]"
                                     value="{{ $location->google_maps_link }}" class="form-control">
                          </div>
                      </div>
                  @endForeach
              </div>
              <button type="button" id="add-location" class="btn btn-primary mt-2">
                Add Location
              </button>
              <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-success">
                    Update Company
                </button>
              </div>
          </div>

          @push('scripts')
          <script>
              document.addEventListener('DOMContentLoaded', function() {
                  const addButton = document.getElementById('add-location');
                  const container = document.getElementById('locations-container');

                  if (addButton && container) {
                      addButton.addEventListener('click', function() {
                          const index = container.children.length;

                          const template = `
                              <div class="location-item mb-4 p-4 border rounded">
                                  <div class="mb-2">
                                      <label class="form-label">House Number</label>
                                      <input type="text" name="locations[${index}][house_number]" class="form-control">
                                  </div>
                                  <div class="mb-2">
                                      <label class="form-label">Street</label>
                                      <input type="text" name="locations[${index}][street]" class="form-control">
                                  </div>
                                  <div class="mb-2">
                                      <label class="form-label">Ward</label>
                                      <input type="text" name="locations[${index}][ward]" class="form-control">
                                  </div>
                                  <div class="mb-2">
                                      <label class="form-label">District</label>
                                      <input type="text" name="locations[${index}][district]" class="form-control">
                                  </div>
                                  <div class="mb-2">
                                      <label class="form-label">City</label>
                                      <input type="text" name="locations[${index}][city]" class="form-control">
                                  </div>
                                  <div class="mb-2">
                                      <label class="form-label">Google Maps Link</label>
                                      <input type="url" name="locations[${index}][google_maps_link]" class="form-control">
                                  </div>
                              </div>
                          `;

                          container.insertAdjacentHTML('beforeend', template);
                      });
                  } else {
                      console.error('Add Location button or Locations container not found');
                  }
              });
          </script>
        @endPush
@endSection
