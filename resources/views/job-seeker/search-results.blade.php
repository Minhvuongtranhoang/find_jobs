@extends('layouts.job-seeker')

@section('content')
<div class="container">
    <h2 class="my-4">Kết quả tìm kiếm</h2>

    <form action="{{ route('search.jobs') }}" method="GET">
        <div class="search-form">
          <form action="{{ route('search.jobs') }}" method="GET">
              <div class="search-row">
                  <input type="text" class="form-control search-input" placeholder="Tìm kiếm công việc..." name="keyword" value="{{ request('keyword') }}">

                  <select class="form-select category-select" name="category_id">
                      <option selected value="">Lĩnh vực</option>
                      @foreach($categories as $category)
                              <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                  {{ $category->name }}
                              </option>
                        @endForeach
                  </select>

                  <select class="form-select location-select" name="location" data-live-search="true">
                      <option selected value="">Địa điểm</option>
                      @foreach ($locations as $location)
                              <option value="{{ $location['name'] }}" {{ request('location') == $location['name'] ? 'selected' : '' }}>
                                  {{ $location['name'] }}
                              </option>
                          @endForeach
                  </select>
                  <button type="submit" class="btn btn-primary search-button">
                      <i class="fas fa-search"></i> Tìm kiếm
                  </button>
              </div>
          </form>
        </div>
    </form>

    @if($jobs->count())
        <div class="row my-4">
            @foreach($jobs as $job)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $job->title }}</h5>
                            <p class="card-text">{{ Str::limit($job->description, 100) }}</p>
                            <a href="{{ route('detail-job', $job->id) }}" class="btn btn-primary">Xem chi tiết</a>
                        </div>
                    </div>
                </div>
            @endForeach
        </div>
    @else
        <p>Không tìm thấy công việc phù hợp với yêu cầu của bạn.</p>
    @endif
</div>
@endSection
