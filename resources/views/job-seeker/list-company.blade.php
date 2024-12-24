@extends('layouts.job-seeker')

@section('content')
<section class="py-5 bg-light">
    <div class="container">
        <div class="row">
            <!-- Cột chính -->
            <div class="col-12 col-lg-8 mb-4">
                <h3 style="margin-bottom: 20px"><span style="color: #3C6E71; font-weight: bold;">Danh sách công ty</span></h3>

                <!-- Tabs -->
                <div class="scrolling-tabs mb-4">
                    <button class="scroll-btn prev-btn" onclick="scrollTabs(-4)">&lt;</button>
                    <div class="tabs-container">
                        <ul class="tabs-list d-flex flex-nowrap">
                            <li><a data-industry="all" class="tab-item active">Tất cả</a></li>
                            <li><a data-industry="featured" class="tab-item">Công ty hàng đầu</a></li>
                            @foreach ($industries as $ind)
                                <li><a data-industry="{{ $ind }}" class="tab-item">{{ $ind }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    <button class="scroll-btn next-btn" onclick="scrollTabs(4)">&gt;</button>
                </div>

                <!-- Danh sách công ty -->
                <div class="row g-4 mt-4" id="company-list">
                  @foreach ($companies as $company)
                      @include('job-seeker.companies.company-card', ['company' => $company])
                  @endForeach
                </div>
                <div class="d-flex justify-content-center mt-3">
                  <div id="pagination">
                    @include('job-seeker.pagination', ['companies' => $companies])
                  </div>
                </div>
            </div>

            <div class="col-12 col-lg-4 mb-4 d-none d-lg-block">
                <div class="ad-banner">
                    <div class="hero-slider owl-carousel owl-theme">
                        <div class="item">
                            <img src="https://i.postimg.cc/7h7qcm45/a.jpg" alt="Recruitment Image 1" class="img-fluid">
                        </div>
                        <div class="item">
                            <img src="https://i.postimg.cc/CxcFnZL6/a.jpg" alt="Recruitment Image 2" class="img-fluid">
                        </div>
                        <div class="item">
                            <img src="https://i.postimg.cc/43TVFST9/a.jpg" alt="Recruitment Image 3" class="img-fluid">
                        </div>
                        <div class="item">
                          <img src="https://i.postimg.cc/C5MWC71y/a.jpg" alt="Recruitment Image 4" class="img-fluid">
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@push('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" rel="styleSheet">
<link href="{{ asset('css/scrolling-tabs.css') }}" rel="styleSheet">
<link href="{{ asset('css/dropdown-menu.css') }}" rel="styleSheet">
@endPush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script src="{{ asset('js/scrolling-tabs.js') }}" defer></script>
<script src="{{ asset('js/hero-slider.js') }}" defer></script>
@endPush
@endSection
