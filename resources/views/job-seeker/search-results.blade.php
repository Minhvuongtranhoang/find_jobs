@extends('layouts.job-seeker')

@section('content')
<div class="container">
    <h1 class="my-4">Kết quả tìm kiếm</h1>

    <form action="{{ route('search.jobs') }}" method="GET">
        <div class="search-form">
            <div class="row g-3">
                <div class="col-12">
                    <input type="text" class="form-control form-control-lg" placeholder="Tìm kiếm công việc..." name="keyword" value="{{ $keyword ?? '' }}">
                </div>

                <div class="col-md-6">
                    <select class="form-select form-select-lg" name="category_id">
                        <option selected value="">Chọn ngành nghề</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ $category->id == $category_id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endForeach
                    </select>
                </div>

                <div class="col-md-6">
                    <select class="form-select form-select-lg selectpicker" name="location" data-live-search="true">
                        <option selected value="">Chọn địa điểm</option>
                        @foreach ($locations as $location)
                            <option value="{{ $location['name'] }}" {{ $location['name'] == $city ? 'selected' : '' }}>
                                {{ $location['name'] }}
                            </option>
                        @endForeach
                    </select>
                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-primary btn-lg w-100">Tìm kiếm</button>
                </div>
            </div>
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
