@extends('layouts.job-seeker')
<style>
    @media (max-width: 768px) {
        .company-card {
            margin-bottom: 20px;
        }

        .company-logo {
            height: 150px;
        }
    }

    .company-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 4px;
        background: linear-gradient(to right, #007bff, #00c6ff);
    }

    .scrolling-tabs {
        display: flex;
        align-items: center;
        margin-bottom: 20px;
        overflow: hidden;
    }

    .tabs-container {
        overflow-x: scroll;
        -ms-overflow-style: none;
        scrollbar-width: none;
    }

    .tabs-container::-webkit-scrollbar {
        display: none;
    }

    .tabs-list {
        display: flex;
        padding: 0;
        margin: 0;
        list-style: none;
    }

    .tab-item {
        display: inline-block;
        padding: 10px 20px;
        white-space: nowrap;
        text-decoration: none;
        color: #000;
        font-weight: bold;
        border-bottom: 2px solid transparent;
        transition: all 0.3s;
    }

    .tab-item.active {
        border: 2px solid #007bff;
        border-radius: 5px;
        color: #007bff;
        padding: 5px 10px;
        background-color: #f8f9fa;
    }

    .tab-item:hover {
        color: #007bff;
        border-bottom: 2px solid #007bff;
    }

    .scroll-btn {
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 50%;
        padding: 5px 10px;
        cursor: pointer;
        margin: 0 10px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .scroll-btn:focus {
        outline: none;
    }

    .scroll-btn:hover {
        background-color: #f0f0f0;
    }
</style>
@section('content')
<div class="container">
    <h1 class="mb-4">Danh sách công ty</h1>

    <!-- Tabs -->
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

    <!-- Tab Content -->
    <div id="company-list">
        <!-- Hiển thị danh sách công ty mặc định (tất cả công ty) -->
        <div class="row">
            @foreach ($companies as $company)
                @include('job-seeker.companies.company-card', ['company' => $company])
            @endforeach
        </div>
    </div>
</div>
@endSection

@push('scripts')
<script src="{{ asset('js/scrolling-tabs.js') }}" defer></script>
@endPush
