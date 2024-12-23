@extends('layouts.job-seeker')

@section('content')
    <!-- Latest Jobs -->
<section class="py-5 bg-light" >
  <div class="container">
    <div class="row">
    <div class="col-lg-8 col-md-6 mb-4">
      <div class="d-flex align-items-center justify-content-between mb-4">
        <h3><span style="color: #3C6E71; font-weight: bold;">Việc làm mới nhất</span></h3>
      </div>

      <div class="row" id="job-list">
          @include('job-seeker.jobs', ['jobs' => $jobs])
      </div>
      <div id="pagination-container">
          @include('job-seeker.pagination', ['jobs' => $jobs])
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

@push('styles')
  <link href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" rel="styleSheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" rel="styleSheet">
  <link rel="styleSheet" href="{{ asset('css/dropdown-menu.css') }}">
@endPush

@push('scripts')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
  <script src="{{ asset('js/hero-slider.js') }}" defer></script>
@endPush

@endSection
