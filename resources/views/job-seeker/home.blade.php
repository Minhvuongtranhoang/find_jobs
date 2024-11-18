@extends('layouts.job-seeker')

@section('content')
<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-5 mb-lg-0">
                <h1 class="display-4 fw-bold mb-4">Khám phá cơ hội nghề nghiệp</h1>
                <p class="lead mb-5">Tìm việc làm IT phù hợp với bạn</p>

                <!-- Search Form -->
                <form action="{{ route('search.jobs') }}" method="GET">
                    <div class="search-form">
                        <div class="row g-3">
                            <div class="col-12">
                                <input type="text" class="form-control form-control-lg" placeholder="Tìm kiếm công việc..." name="keyword" value="{{ request('keyword') }}">
                            </div>

                            <div class="col-md-6">
                                <select class="form-select form-select-lg" name="category_id">
                                    <option selected value="">Chọn ngành nghề</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6">
                                <select class="form-select form-select-lg selectpicker" name="location" data-live-search="true">
                                    <option selected value="">Chọn địa điểm </option>
                                    @foreach ($locations as $location)
                                        <option value="{{ $location['name'] }}" {{ request('location') == $location['name'] ? 'selected' : '' }}>
                                            {{ $location['name'] }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary btn-lg w-100">Tìm kiếm</button>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
            <div class="col-lg-6">
                <img src="https://www.ryrob.com/wp-content/uploads/2022/04/How-to-Name-a-Blog-45-Blog-Name-Ideas-and-Examples-to-Learn-From.jpg" alt="Hero Image" class="img-fluid rounded-3 shadow">
            </div>
        </div>
    </div>
</section>

<!-- Modern Job Carousel -->
<section class="py-5">
    <div class="container">
        <h2 class="mb-4">Việc làm nổi bật</h2>
        <div class="job-carousel">
            <div id="jobCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach($featuredJobs->chunk(3) as $chunkIndex => $jobChunk)
                        <div class="carousel-item {{ $chunkIndex == 0 ? 'active' : '' }}">
                            <div class="job-slide-wrapper">
                                @foreach($jobChunk as $job)
                                    <div class="job-card-carousel">
                                        <div class="d-flex align-items-center mb-3">
                                            <img src="{{ filter_var($job->company->logo, FILTER_VALIDATE_URL) ? $job->company->logo : Storage::url($job->company->logo) }}"
                                                 alt="Company Logo" class="job-logo">
                                            <div>
                                                <h5 class="h5">{{ $job->title }}</h5>
                                                <p class="text-muted mb-2">{{ $job->company->name }}</p>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center mb-3">
                                            <i class="fas fa-map-marker-alt text-primary me-2"></i>
                                            <span>{{ $job->location->city }}</span>
                                        </div>
                                        <div class="d-flex align-items-center mb-3">
                                            <i class="fas fa-dollar-sign text-primary me-2"></i>
                                            <span>{{ $job->salary }}</span>
                                        </div>
                                        <button class="btn btn-primary w-100">Ứng tuyển ngay</button>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#jobCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#jobCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>
  </section>


<!-- Popular Categories Section with Enhanced Design -->
<section class="py-5 bg-light">
  <div class="container">
      <div class="row mb-4">
          <div class="col-lg-6">
              <h2 class="mb-0">Danh mục phổ biến</h2>
          </div>
          <div class="col-lg-6 text-lg-end">
              <a href="#" class="btn btn-outline-primary">Xem tất cả danh mục</a>
          </div>
      </div>
      <div class="row">
          <div class="col-lg-3 col-md-6 mb-4">
              <div class="category-card text-center">
                  <div class="category-icon">
                      <i class="fas fa-code"></i>
                  </div>
                  <h3 class="h5">Frontend Development</h3>
                  <p class="text-muted">125 việc làm</p>
                  <div class="mt-3">
                      <a href="#" class="btn btn-outline-primary btn-sm">Xem chi tiết</a>
                  </div>
              </div>
          </div>
          <div class="col-lg-3 col-md-6 mb-4">
              <div class="category-card text-center">
                  <div class="category-icon">
                      <i class="fas fa-database"></i>
                  </div>
                  <h3 class="h5">Backend Development</h3>
                  <p class="text-muted">98 việc làm</p>
                  <div class="mt-3">
                      <a href="#" class="btn btn-outline-primary btn-sm">Xem chi tiết</a>
                  </div>
              </div>
          </div>
          <div class="col-lg-3 col-md-6 mb-4">
              <div class="category-card text-center">
                  <div class="category-icon">
                      <i class="fas fa-mobile-alt"></i>
                  </div>
                  <h3 class="h5">Mobile Development</h3>
                  <p class="text-muted">87 việc làm</p>
                  <div class="mt-3">
                      <a href="#" class="btn btn-outline-primary btn-sm">Xem chi tiết</a>
                  </div>
              </div>
          </div>
          <div class="col-lg-3 col-md-6 mb-4">
              <div class="category-card text-center">
                  <div class="category-icon">
                      <i class="fas fa-cloud"></i>
                  </div>
                  <h3 class="h5">Cloud Computing</h3>
                  <p class="text-muted">76 việc làm</p>
                  <div class="mt-3">
                      <a href="#" class="btn btn-outline-primary btn-sm">Xem chi tiết</a>
                  </div>
              </div>
          </div>
      </div>
  </div>
</section>

<!-- Featured Companies -->
<section class="py-5">
    <div class="container">
        <h2 class="mb-4">Nhà tuyển dụng nổi bật</h2>
        <div class="row">
            @foreach($featuredCompanies as $company)
                <div class="col-lg-2 col-md-6 mb-4">
                    <div class="company-card text-center">
                        <a href="{{ $company->website }}" class="company-link">
                            <div class="company-logo">
                                <img src="{{ filter_var($company->logo, FILTER_VALIDATE_URL) ? $company->logo : Storage::url($company->logo) }}"
                                     alt="Logo của {{ $company->name }}"
                                     class="img-fluid">
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>


<!-- Latest Jobs -->
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="mb-4">Việc làm mới nhất</h2>
        <div class="row">
            @foreach($jobs as $job)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="job-card">
                    <div class="favorite-icon" data-id="{{ $job->id }}" onclick="toggleFavorite({{ $job->id }}, this)">
                        <i class="fa {{ $job->isFavoritedByUser() ? 'fas' : 'far' }} fa-heart"></i>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="square-company-logo">
                            <img src="{{ filter_var($job->company->logo, FILTER_VALIDATE_URL) ? $job->company->logo : Storage::url($job->company->logo) }}" alt="Company Logo" class="job-logo">
                        </div>
                        <div>
                            <a class="nav-link" href="{{ route('detail-job', $job->id) }}">
                                <h6>{{ $job->title }}</h6>
                            </a>
                            <p style="margin-left: 10px" class="text-muted mb-2">{{ $job->company->name }}</p>
                            <div style="margin-left: 10px" class="text-muted mb-3">
                                <i class="fas fa-map-marker-alt me-1"></i>{{ $job->location->city }}
                                <i class="fas fa-dollar-sign ms-2 me-1"></i>{{ $job->salary }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>


<!-- Blog Section -->
<section class="py-5">
    <div class="container">
        <h2 class="mb-4">Blog IT mới nhất</h2>
        <div class="row">
            <div class="col-lg-4 col-md-6 mb-4">
              <div class="blog-card">
                <img src="https://blog.feedspot.com/wp-content/uploads/2017/06/IT.png" alt="Blog Image" class="img-fluid blog-img">
                <div class="p-4">
                    <h5>Xu hướng công nghệ 2024</h5>
                    <p class="text-muted mb-3">
                        <i class="far fa-calendar me-2"></i>20 Mar 2024
                        <i class="far fa-user ms-3 me-2"></i>John Doe
                    </p>
                    <p class="mb-3">Khám phá những xu hướng công nghệ mới nhất đang định hình ngành IT...</p>
                    <a href="#" class="btn btn-outline-primary">Đọc thêm</a>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="blog-card">
                <img src="https://www.constantcontact.com/blog/wp-content/uploads/2021/04/Social-4.jpg" alt="Blog Image" class="img-fluid blog-img">
                <div class="p-4">
                    <h5>Kỹ năng IT cần có năm 2024</h5>
                    <p class="text-muted mb-3">
                        <i class="far fa-calendar me-2"></i>18 Mar 2024
                        <i class="far fa-user ms-3 me-2"></i>Jane Smith
                    </p>
                    <p class="mb-3">Những kỹ năng quan trọng mà mọi lập trình viên cần có trong năm 2024...</p>
                    <a href="#" class="btn btn-outline-primary">Đọc thêm</a>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="blog-card">
                <img src="https://images.forbesindia.com/blog/wp-content/uploads/2024/06/AI-Skills_GettyImages-1449294937_BG.jpg?impolicy=website&width=900&height=600" alt="Blog Image" class="img-fluid blog-img">
                <div class="p-4">
                    <h5>Thị trường việc làm IT 2024</h5>
                    <p class="text-muted mb-3">
                        <i class="far fa-calendar me-2"></i>15 Mar 2024
                        <i class="far fa-user ms-3 me-2"></i>David Wilson
                    </p>
                    <p class="mb-3">Phân tích chi tiết về thị trường việc làm IT và những cơ hội trong năm 2024...</p>
                    <a href="#" class="btn btn-outline-primary">Đọc thêm</a>
                </div>
            </div>
        </div>
    </div>
    <div class="text-center mt-4">
        <a href="#" class="btn btn-outline-primary">Xem thêm bài viết</a>
    </div>
</div>
</section>

<!-- Newsletter Section -->
<section class="py-5 bg-light">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-6 text-center">
            <h2 class="mb-4">Đăng ký nhận thông tin việc làm</h2>
            <p class="text-muted mb-4">Nhận thông báo về các cơ hội việc làm mới nhất phù hợp với bạn</p>
            <form class="d-flex gap-2">
                <input type="email" class="form-control form-control-lg" placeholder="Nhập email của bạn">
                <button type="submit" class="btn btn-primary btn-lg">Đăng ký</button>
            </form>
        </div>
    </div>
</div>
</section>

@endSection
