@extends('layouts.job-seeker')

@section('content')
<!-- Hero Section -->
<section class="hero-section" style="background: linear-gradient(135deg, #3C6E71 0%, #75ABBC 100%);">
    <div class="container" >
        <div class="row align-items-center">
            <div class="col-lg-6 mb-5 mb-lg-0">
                <h1 class="display-4 fw-bold mb-4" style="color: #ffffff">Khám phá cơ hội nghề nghiệp hấp dẫn</h1>
                <p class="lead mb-5"style="color: #ffffff">Tìm việc làm phù hợp với sở trường của bạn</p>

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
                <img src="https://png.pngtree.com/png-clipart/20240111/original/pngtree-recruiter-looking-for-candidates-with-resume-in-hand-png-image_14082883.png" alt="Hero Image" class="img-fluid">
        </div>
    </div>
</section>

<!-- Modern Job Carousel -->
<section class="py-5" style="background: #ffffff">
    <div class="container">
        <h2 class="mb-4">Việc làm nổi bật</h2>
        <div class="job-carousel">
            <div id="jobCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="4000">
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
                                        <a class="btn btn-primary w-100" href={{ route('detail-job', $job->id) }}>Chi tiết</a>
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
        </div>
        <div class="highlighted-categories mb-4">
            <div class="row">
                @foreach ($highlightedCategories as $category)
                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="category-card text-center border p-3">
                            <div class="category-icon mb-2">
                                @php
                                    // Tạo mảng các biểu tượng
                                    $icons = [
                                        'fas fa-briefcase',
                                        'fas fa-laptop-code',
                                        'fas fa-chart-line',
                                        'fas fa-users',
                                        'fas fa-cogs',
                                        'fas fa-bullhorn',
                                        'fas fa-handshake',
                                        'fas fa-heart'
                                    ];
                                    // Lấy một biểu tượng ngẫu nhiên từ mảng
                                    $randomIcon = $icons[array_rand($icons)];
                                @endphp
                                <!-- Hiển thị biểu tượng ngẫu nhiên -->
                                <i class="{{ $randomIcon }}" style="font-size: 2rem;"></i>
                            </div>
                            <h3 class="h5">{{ $category->name }}</h3>
                            <p class="text-muted">{{ $category->jobs_count }} việc làm</p>
                            <a href="{{ route('category-job', $category->id) }}" class="btn btn-outline-primary btn-sm">Xem chi tiết</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
  </section>


<!-- Featured Companies -->
<section class="py-5">
  <div class="container">
      <h2 class="mb-4">Nhà tuyển dụng nổi bật</h2>
      <div class="swiper mySwiper">
          <div class="swiper-wrapper">
              @foreach($featuredCompanies as $company)
                  <div class="swiper-slide">
                      <div class="company-card text-center">
                          <a href="{{ route('companies.show', $company->id) }}" class="company-link">
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
  </div>
</section>


<!-- Latest Jobs -->
<section class="py-5 bg-light" style="background: linear-gradient(135deg, #ffffff 0%, #fdfdfd 100%);">
    <div class="container">
        <h2 class="mb-4">Việc làm mới nhất</h2>
        <div class="row" id="job-list">
            @include('job-seeker.jobs', ['jobs' => $jobs])
        </div>
        <div id="pagination-container">
            @include('job-seeker.pagination', ['jobs' => $jobs])
        </div>
    </div>
</section>


<!-- Why Choose Us Section -->
<section style="padding: 4rem 1rem; background-color: var(--neutral-bg);">
  <div class="container">
      <div class="section-title" style="text-align: center">
          <h3>Tại sao chọn <a class="navbar-brand" href="{{ route('home') }}">Seek a<span class="highlight">Job</span></a></h3>
          <p>Nền tảng tuyển dụng hàng đầu tại Việt Nam</p>
      </div>
      <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 2rem; margin-top: 2rem;">
          <div class="category-card" style="text-align: center">
              <i class="fas fa-search category-icon"></i>
              <h3>Tìm kiếm thông minh</h3>
              <p>Công nghệ AI giúp kết nối ứng viên với công việc phù hợp nhất</p>
          </div>
          <div class="category-card">
              <i class="fas fa-shield-alt category-icon"></i>
              <h3>Uy tín & Bảo mật</h3>
              <p>Thông tin ứng viên được bảo mật tuyệt đối</p>
          </div>
          <div class="category-card">
              <i class="fas fa-bolt category-icon"></i>
              <h3>Cập nhật realtime</h3>
              <p>Việc làm mới nhất từ các doanh nghiệp hàng đầu</p>
          </div>
          <div class="category-card">
              <i class="fas fa-headset category-icon"></i>
              <h3>Hỗ trợ 24/7</h3>
              <p>Đội ngũ tư vấn chuyên nghiệp luôn sẵn sàng hỗ trợ</p>
          </div>
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
                    <a href="{{ route('tech-trends-2024') }}" class="btn btn-outline-primary">Đọc thêm</a>
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
                    <a href="{{ route('blog1') }}" class="btn btn-outline-primary">Đọc thêm</a>
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
                    <a href="{{ route('job-market-2024') }}" class="btn btn-outline-primary">Đọc thêm</a>
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
<section class="py-5 bg-light" style="background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);">
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

{{-- <script>
  // Add scroll animation for cards
  const cards = document.querySelectorAll('.category-card, .job-card');
      const observer = new IntersectionObserver(entries => {
          entries.forEach(entry => {
              if (entry.isIntersecting) {
                  entry.target.style.opacity = 1;
                  entry.target.style.transform = 'translateY(0)';
              }
          });
      });

      cards.forEach(card => {
          card.style.opacity = 0;
          card.style.transform = 'translateY(20px)';
          card.style.transition = 'all 0.5s ease-out';
          observer.observe(card);
      });
</script> --}}

@endSection
