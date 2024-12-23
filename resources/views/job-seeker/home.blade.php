@extends('layouts.job-seeker')

@section('content')

<section class="hero-section">
  <div class="snow-container" id="snow-container"></div>
  <div class="container">
      <div class="row align-items-center">
          <div class="col-lg-6 hero-content">
              <h1 class="hero-title">Khám phá cơ hội nghề nghiệp hấp dẫn</h1>
              <p class="hero-subtitle">Bạn sẽ được tiếp cận <span style="font-size: 1.5em; font-weight: bold; white-space: normal;">1.000<sup>+</sup></span> tin tuyển dụng phù hợp với sở trường của bạn từ những doanh nghiệp uy tín</p>

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
          </div>

          <div class="col-lg-6">
              <div class="hero-slider owl-carousel owl-theme">
                  <div class="item">
                      <img src="https://i.postimg.cc/zvf5NKyb/h1.png" alt="Recruitment Image 1" class="img-fluid">
                  </div>
                  <div class="item">
                    <img src="https://i.postimg.cc/254yNY1B/a.png" alt="Recruitment Image 1" class="img-fluid">
                  </div>
                  <div class="item">
                      <img src="https://i.postimg.cc/tRkqzYHf/a.png" alt="Recruitment Image 2" class="img-fluid">
                  </div>
                  <div class="item">
                      <img src="https://i.postimg.cc/hvzdVx3k/b.png" alt="Recruitment Image 3" class="img-fluid">
                  </div>
              </div>
          </div>
      </div>
  </div>
</section>

<!-- Modern Job Carousel -->
<section class="py-5" style="background-color: white;">
    <div class="container">
      <h3><span style="color: #3C6E71; font-weight: bold;">Việc làm nổi bật</span></h3>
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
                                @endForeach
                            </div>
                        </div>
                    @endForeach
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
  </section>


<!-- Popular Categories Section with Enhanced Design -->
<section class="py-5 bg-light" style="border-top-left-radius: 50px; border-top-right-radius: 50px;">
    <div class="container">
        <div class="row mb-4">
            <div class="col-lg-6">
              <h3><span style="color: #3C6E71; font-weight: bold;">Danh mục phổ biến</span></h3>
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
                @endForeach
            </div>
        </div>
    </div>
  </section>


<!-- Featured Companies -->
<section class="py-5 bg-light" style="box-shadow: 15px 5px 15px rgba(0, 0, 0, 0.05);">
  <div class="container">
    <h3><span style="color: #3C6E71; font-weight: bold;">Nhà tuyển dụng nổi bật</span></h3>
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
              @endForeach
          </div>
      </div>
  </div>
</section>

<!-- Newsletter Section -->
<section class="py-5" style="background-color: white">
  <div class="container">
    <div class="row">
      <!-- Phần nội dung bên trái -->
      <div class="col-lg-6 mb-4 mb-lg-0">
        <h4>Tìm việc khó <span style="color: #3C6E71; font-weight: bold;">đã có Seek a Job</span></h4>
        <div class="container-around">
          <div style="margin-left: 20px">
            (096) 6069 848
            <a href="tel:+84966069848">
              <button class="button-rounded">
                <i class="fas fa-phone-alt"></i> GỌI NGAY
              </button>
            </a>
          </div>
        </div>

        <div class="mb-4 mt-4">
          Email hỗ trợ Ứng viên:
          <a href="mailto:vuongtranhoangminh@gmail.com" style="text-decoration: none; color: #3C6E71"><i class="fa-solid fa-envelope" style="color: #3C6E71"></i> seekajob2024@gmail.com</a>
        </div>

        <div class="mb-4 mt-3">
          Mạng xã hội:
          <div class="social-icons-container">
            <a href="https://www.facebook.com/minhh.vuongg.967" class="social-icon" style="background: #3b5998;">
              <i class="fab fa-facebook-f"></i>
            </a>
            <a href="https://x.com/dqv1507" class="social-icon" style="background: #1DA1F2;">
              <i class="fab fa-twitter"></i>
            </a>
            <a href="#" class="social-icon" style="background: #0077b5;">
              <i class="fab fa-linkedin-in"></i>
            </a>
            <a href="#" class="social-icon" style="background: #E4405F;">
              <i class="fab fa-instagram"></i>
            </a>
          </div>
        </div>
      </div>

      <!-- Phần hình ảnh bên phải -->
      <div class="col-lg-6">
        <img src="https://vieclam.thegioididong.com/img/mobile/searchv2/detail_banner/dmx.jpg" alt="Support Representatives" style="height: min-content" class="chat-image img-fluid">
      </div>
    </div>
  </div>
</section>


<!-- Latest Jobs -->
<section class="py-5 bg-light" >
    <div class="container">
      <div class="row">
      <div class="col-lg-8 col-md-6 mb-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
          <h3><span style="color: #3C6E71; font-weight: bold;">Việc làm mới nhất</span></h3>
          <div class="dropdown">
            <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
              <span>Lọc theo: Mức lương</span>
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <li><a class="dropdown-item active" href="#" data-value="Mức lương">Mức lương <span class="checkmark">✓</span></a></li>
              <li><a class="dropdown-item" href="#" data-value="Địa điểm">Địa điểm <span class="checkmark">✓</span></a></li>
              <li><a class="dropdown-item" href="#" data-value="Kinh nghiệm">Kinh nghiệm <span class="checkmark">✓</span></a></li>
              <li><a class="dropdown-item" href="#" data-value="Ngành nghề">Ngành nghề <span class="checkmark">✓</span></a></li>
              <li><a class="dropdown-item" href="#" data-value="Trình độ">Trình độ <span class="checkmark">✓</span></a></li>
              <li><a class="dropdown-item" href="#" data-value="Loại công việc">Loại công việc <span class="checkmark">✓</span></a></li>
              <li><a class="dropdown-item" href="#" data-value="Thời gian làm việc">Thời gian làm việc <span class="checkmark">✓</span></a></li>
            </ul>
          </div>
        </div>

        <!-- Scrolling Tabs -->
        <div class="scrolling-tabs">
            <button class="scroll-btn prev-btn" onclick="scrollTabs(-4)">&lt;</button>
            <div class="tabs-container">
                <ul class="tabs-list">
                    <li>
                        <a href="#" data-industry="all" class="tab-item active">Tất cả</a>
                    </li>
                    <li>
                        <a href="#" data-industry="featured" class="tab-item">Công ty hàng đầu</a>
                    </li>
                    @foreach ($industries as $ind)
                        <li>
                            <a href="#" data-industry="{{ $ind }}" class="tab-item">{{ $ind }}</a>
                        </li>
                    @endForeach
                </ul>
            </div>
            <button class="scroll-btn next-btn" onclick="scrollTabs(4)">&gt;</button>
        </div>

        <div class="row" id="job-list">
            @include('job-seeker.jobs', ['jobs' => $jobs])
        </div>
        <div class="d-flex justify-content-center mt-3">
          <div id="pagination">
              @include('job-seeker.pagination', ['jobs' => $jobs])
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 mb-4">
        <div class="ad-banner">
            <div class="hero-slider owl-carousel owl-theme">
              <div class="item">
                  <img src="https://amis.misa.vn/wp-content/uploads/2022/09/quang-cao-tuyen-dung-nhan-su-2.jpg" alt="Recruitment Image 1" class="img-fluid">
              </div>
              <div class="item">
                  <img src="https://insieutoc.vn/wp-content/uploads/2021/05/poster-tuyen-dung-zone-media-510x695.jpg" alt="Recruitment Image 2" class="img-fluid">
              </div>
              <div class="item">
                  <img src="https://banghieuquangcao.net/wp-content/uploads/2024/03/poster-tuyen-dung-14.webp" alt="Recruitment Image 3" class="img-fluid">
              </div>
          </div>
        </div>
    </div>
  </div>
</div>
</section>

<!-- Modern Job Carousel -->
<section class="py-5" style="background: #3C6E71">
    <div class="container">
        <div class="col-lg-12">
          <div class="hero-slider owl-carousel owl-theme" data-autoplay="false">
            <div class="job-carousel">
              <div class="carousel-inner d-flex">
                <div class="item col-lg-6 d-none d-lg-block">
                    <img src="https://i.postimg.cc/nrFg6Q6L/a.png" style="height: 300px; width: 500px;" alt="Recruitment Image 1" class="img-fluid">
                </div>
                <div class="item col-lg-6 text-center">
                  <img style="width: 30%; height: 30%;" src="https://i.postimg.cc/85cHhzS3/logo.png" alt="MVGroup Logo" class="mx-auto d-block">
                  <p class="tagline">"Innovation for a Better Tomorrow"</p>
                  <p class="description">
                      MVGroup là một tập đoàn đa quốc gia hàng đầu trong lĩnh vực công nghệ và dịch vụ. Chúng tôi cam kết mang đến các sản phẩm và giải pháp sáng tạo,
                      đáp ứng nhu cầu ngày càng cao của khách hàng trên toàn thế giới. Với tầm nhìn dài hạn và đội ngũ chuyên gia giàu kinh nghiệm, MVGroup luôn tiên phong
                      trong việc áp dụng công nghệ tiên tiến để kiến tạo một tương lai bền vững.
                  </p>
                </div>
              </div>
            </div>

            <div class="job-carousel">
              <div class="carousel-inner d-flex">
                <div class="item col-lg-6 d-none d-lg-block">
                    <img src="https://i.postimg.cc/BnS5HB2b/a.png" style="height: 300px; width: 500px;" alt="Recruitment Image 1" class="img-fluid">
                </div>
                <div class="item col-lg-6 text-center">
                  <img style="width: 20%; height: 20%;" src="https://upload.wikimedia.org/wikipedia/commons/thumb/1/11/FPT_logo_2010.svg/1200px-FPT_logo_2010.svg.png" alt="FPT" class="mx-auto d-block">
                  <p class="tagline">"Enabling Digital Futures"</p>
                  <p class="description">
                    FPT Corporation là một tập đoàn công nghệ hàng đầu tại Việt Nam, chuyên cung cấp các giải pháp và dịch vụ số toàn diện. Với sứ mệnh "Kiến tạo tương lai số",
                    FPT cam kết đồng hành cùng khách hàng trong hành trình chuyển đổi số, mang đến giá trị bền vững và tạo nên sự khác biệt trong kỷ nguyên công nghệ 4.0.
                  </p>
                </div>
              </div>
            </div>

            <div class="job-carousel">
              <div class="carousel-inner d-flex">
                <div class="item col-lg-6 d-none d-lg-block">
                    <img src="https://i.postimg.cc/PNsj0qzV/a.png" style="height: 300px; width: 500px;" alt="Recruitment Image 1" class="img-fluid">
                </div>
                <div class="item col-lg-6 text-center">
                  <img style="width: 20%; height: 20%;" src="https://i.postimg.cc/gkDSCJDw/a.png" alt="Viettle" class="mx-auto d-block">
                  <p class="tagline">"Enabling Digital Futures"</p>
                  <p class="description">
                    Viettel là một trong những tập đoàn viễn thông và công nghệ hàng đầu tại Việt Nam. Với sứ mệnh "Sáng tạo vì con người", Viettel luôn đi đầu trong việc
                    phát triển các sản phẩm và dịch vụ số hiện đại, đáp ứng nhu cầu kết nối và đổi mới của khách hàng. Viettel cam kết mang lại giá trị bền vững, góp phần thúc đẩy
                    sự phát triển của xã hội và nền kinh tế số.
                  </p>
                </div>
              </div>
            </div>

          </div>
      </div>
    </div>
  </section>


<!-- Why Choose Us Section -->
<section class="py-5 bg-light" style="padding: 4rem 1rem; background-color: var(--neutral-bg);">
  <div class="container">
      <div class="section-title" style="text-align: center">
          <h3>Tại sao chọn <a class="navbar-brand" href="{{ route('home') }}">Seek a<span class="highlight" style="padding: 8px">Job</span></a></h3>
          <p>Nền tảng tuyển dụng hàng đầu tại Việt Nam</p>
      </div>
      <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 2rem; margin-top: 2rem;">
        <div class="category-card text-center border p-3">
          <div class="category-icon mb-2">
              <i class="fas fa-search "></i>
          </div>
              <h3>Tìm kiếm thông minh</h3>
              <p>Công nghệ AI giúp kết nối ứng viên với công việc phù hợp nhất</p>
          </div>
          <div class="category-card text-center border p-3">
            <div class="category-icon mb-2">
              <i class="fas fa-shield-alt"></i>
            </div>
              <h3>Uy tín & Bảo mật</h3>
              <p>Thông tin ứng viên được bảo mật tuyệt đối</p>
          </div>

          <div class="category-card text-center border p-3">
            <div class="category-icon mb-2">
              <i class="fas fa-bolt"></i>
            </div>
              <h3>Cập nhật realtime</h3>
              <p>Việc làm mới nhất từ các doanh nghiệp hàng đầu</p>
          </div>

          <div class="category-card text-center border p-3">
            <div class="category-icon mb-2">
              <i class="fas fa-headset"></i>
            </div>
              <h3>Hỗ trợ 24/7</h3>
              <p>Đội ngũ tư vấn chuyên nghiệp luôn sẵn sàng hỗ trợ</p>
          </div>
      </div>
  </div>
</section>


<!-- Blog Section -->
<section class="py-5" style="background-color: white">
    <div class="container">
        <h3 style="margin-bottom: 20px"><span style="color: #3C6E71; font-weight: bold;">Blog IT mới nhất</span></h3>
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
                <img src="https://www.constantcontact.com/blog/wp-content/uploads/2021/04/Social-4.jpg" style="height: 290px" alt="Blog Image" class="img-fluid blog-img">
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
                <img src="https://images.forbesindia.com/blog/wp-content/uploads/2024/06/AI-Skills_GettyImages-1449294937_BG.jpg" style="height: 290px" alt="Blog Image" class="img-fluid blog-img">
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
            <h3><span style="color: #3C6E71; font-weight: bold;">Đăng ký nhận thông tin việc làm</span></h3>
            <p class="text-muted mb-4">Nhận thông báo về các cơ hội việc làm mới nhất phù hợp với bạn</p>
            <div class="container-around">
                  <button class="button-rounded" style="margin-right: 10px"><i class="fas fa-user-plus"></i> Đăng kí ngay</button>
            </div>
        </div>
    </div>
</div>
</section>

@push('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" rel="styleSheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" rel="styleSheet">
<link rel="styleSheet" href="{{ asset('css/scrolling-tabs.css') }}">
<link rel="styleSheet" href="{{ asset('css/dropdown-menu.css') }}">
@endPush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
<script src="{{ asset('js/scrolling-tabs.js') }}" defer></script>
<script src="{{ asset('js/hero-slider.js') }}" defer></script>
@endPush

@endSection
