@extends('layouts.job-seeker')
@section('content')
<style>
    /* body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
        } */
        /* .container {
            max-width: 800px;
            margin: auto;
            padding: 20px;
        } */
        .table-of-contents ul {
            list-style-type: none;
            padding: 0;
        }
        .table-of-contents ul li {
            margin: 5px 0;
        }
        .table-of-contents ul li a {
            text-decoration: none;
            color: #007bff;
        }
        .table-of-contents ul li a:hover {
            text-decoration: underline;
        }
        .section img {
            max-width: 100%;
            margin: 10px 0;
        }
</style>
<div class="container">
    <header>
        <h1>Phân Tích Chi Tiết Về Thị Trường Việc Làm IT và Những Cơ Hội Năm 2024</h1>
    </header>

    <nav class="table-of-contents">
        <h2>Mục Lục</h2>
        <ul>
            <li><a href="#introduction">1.Giới Thiệu</a></li>
            <li><a href="#trends">2.Xu Hướng Nổi Bật</a></li>
            <li><a href="#opportunities">3.Cơ Hội Nghề Nghiệp</a></li>
            <li><a href="#skills">4.Kỹ Năng Cần Thiết</a></li>
        </ul>
    </nav>

    <section id="introduction" class="section">
        <h2>1.Giới Thiệu</h2>
        <p>
            Thị trường IT đang thay đổi nhanh chóng với những cơ hội và thách thức mới. Đây là thời điểm tuyệt vời để
            khám phá các xu hướng và chuẩn bị cho tương lai.
        </p>
        <img src="https://cdn.vietnambiz.vn/1881912202208555/images/2023/02/08/1673899088-gettyimages-1339030383-20230208081052960.jpg?width=700" alt="Thị trường việc làm IT">
    </section>

    <section id="trends" class="section">
        <h2>2.Xu Hướng Nổi Bật</h2>
        <p>Dưới đây là các xu hướng đang định hình thị trường IT năm 2024:</p>
        <ul>
            <li><strong>AI và Machine Learning:</strong> Thúc đẩy đổi mới trong nhiều lĩnh vực.</li>
            <li><strong>Blockchain:</strong> Nâng cấp các giải pháp tài chính và bảo mật.</li>
            <li><strong>Cybersecurity:</strong> Gia tăng tầm quan trọng khi mối đe dọa mạng ngày càng phức tạp.</li>
        </ul>
        <img src="https://media.vneconomy.vn/images/upload/2022/01/05/anh-ai.jpg" alt="Xu hướng AI">
    </section>

    <section id="opportunities" class="section">
        <h2>3.Cơ Hội Nghề Nghiệp</h2>
        <p>Các vai trò công việc nổi bật trong năm 2024 bao gồm:</p>
        <ol>
            <li>Chuyên gia AI</li>
            <li>Kỹ sư Full-stack</li>
            <li>Chuyên gia An ninh mạng</li>
        </ol>
        <img src="https://it.ctim.edu.vn/uploads/images/T7_2023/084112_Viec_lam_nganh_CNTT_-_Hinh_3.jpg" alt="Cơ hội nghề nghiệp IT">
    </section>

    <section id="skills" class="section">
        <h2>4.Kỹ Năng Cần Thiết</h2>
        <p>Những kỹ năng này sẽ giúp bạn nổi bật trong thị trường IT:</p>
        <ul>
            <li>Lập trình: Python, Java, v.v.</li>
            <li>Chứng chỉ: AWS, Azure.</li>
            <li>Kỹ năng mềm: Giao tiếp, quản lý thời gian.</li>
        </ul>
    </section>
@endsection
