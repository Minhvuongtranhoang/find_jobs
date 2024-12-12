@extends('layouts.job-seeker')
<style>
    /* Company Card Styles */
    .company-card {
        position: relative;
        background-color: #ffffff;
        border-radius: 12px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        overflow: hidden;
        height: 100%;
    }

    .company-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
    }

    .company-logo {
        position: relative;
        height: 200px;
        display: flex;
        align-items: center;
        justify-content: center;
        /* background-color: #f8f9fa; */
        overflow: hidden;
    }

    .company-logo img {
        max-width: 80%;
        max-height: 150px;
        object-fit: contain;
        transition: transform 0.3s ease;
    }

    .company-card:hover .company-logo img {
        transform: scale(1.1);
    }

    .card-body {
        padding: 20px;
        text-align: center;
    }

    .card-title {
        font-size: 1.2rem;
        font-weight: 700;
        color: #333;
        margin-bottom: 15px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .card-text {
        color: #6c757d;
        margin-bottom: 15px;
        line-height: 1.6;
    }

    .company-card .btn {
        margin: 0 5px;
        padding: 8px 15px;
        font-size: 0.9rem;
        border-radius: 20px;
        transition: all 0.3s ease;
    }

    .company-card .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }

    .company-card .btn-primary:hover {
        background-color: #0056b3;
        border-color: #0056b3;
    }

    /* Responsive Adjustments */
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
    overflow-x: scroll; /* Bật cuộn ngang */
    -ms-overflow-style: none; /* Ẩn thanh cuộn trên IE và Edge */
    scrollbar-width: none; /* Ẩn thanh cuộn trên Firefox */
}

.tabs-container::-webkit-scrollbar {
    display: none; /* Ẩn thanh cuộn trên Chrome, Safari và Edge */
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
    border: 2px solid #007bff; /* Viền xung quanh tab khi nó được chọn */
    border-radius: 5px; /* Góc bo tròn cho viền */
    color: #007bff; /* Màu chữ khi tab được chọn */
    padding: 5px 10px; /* Khoảng cách bên trong tab */
    background-color: #f8f9fa; /* Màu nền nhẹ khi tab được chọn */
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
                @endforeach
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

        <!-- Pagination -->
        <div>
            {{ $companies->links() }}
        </div>
    </div>
</div>
@endSection

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const tabsContainer = document.querySelector('.tabs-container');
    const prevBtn = document.querySelector('.prev-btn');
    const nextBtn = document.querySelector('.next-btn');

    // Hàm cuộn danh sách tab
    function scrollTabs(direction) {
        const scrollAmount = 100; // Khoảng cách cuộn (px)
        tabsContainer.scrollBy({
            left: direction * scrollAmount,
            behavior: 'smooth' // Cuộn mượt mà
        });
    }

    // Gắn sự kiện cho nút cuộn
    prevBtn.addEventListener('click', function () {
        scrollTabs(-4); // Cuộn sang trái
    });

    nextBtn.addEventListener('click', function () {
        scrollTabs(4); // Cuộn sang phải
    });

    // Sự kiện thay đổi tab
    const tabs = document.querySelectorAll('.tab-item');
    tabs.forEach(tab => {
        tab.addEventListener('click', function (e) {
            e.preventDefault();

            // Xóa trạng thái active khỏi các tab khác
            tabs.forEach(t => t.classList.remove('active'));
            this.classList.add('active');

            // Gửi yêu cầu AJAX để tải dữ liệu
            const industry = this.dataset.industry;

            fetch(`/companies/fetch?industry=${industry}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                // Cập nhật danh sách công ty và phân trang
                document.getElementById('company-list').innerHTML = data.html;
                document.querySelector('.pagination').innerHTML = data.pagination;
            })
            .catch(error => console.error('Error:', error));
        });
    });
});

</script>
