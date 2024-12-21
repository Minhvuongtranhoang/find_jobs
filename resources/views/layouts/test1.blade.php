<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TopCV Support Interface</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-green: #00843D;
            --light-green: #e8f5e9;
        }

        body {
            background: linear-gradient(145deg, #006837, #00843D);
            min-height: 100vh;
            font-family: system-ui, -apple-system, sans-serif;
        }

        .support-section {
            background: white;
            border-radius: 24px;
            padding: 2rem;
            margin: 2rem auto;
            max-width: 1200px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
        }

        .nav-tabs {
            border: none;
            margin-bottom: 1.5rem;
        }

        .nav-tabs .nav-link {
            border: none;
            color: #666;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 500;
            background: #f5f5f5;
        }

        .nav-tabs .nav-link.active {
            background: var(--primary-green);
            color: white;
        }

        .main-title {
            color: #333;
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 1.5rem;
        }

        .contact-buttons {
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .phone-button {
            background: var(--primary-green);
            color: white;
            border-radius: 8px;
            padding: 0.75rem 1.5rem;
            font-weight: 500;
            text-decoration: none;
        }

        .call-now-button {
            background: white;
            color: var(--primary-green);
            border: 2px solid var(--primary-green);
            border-radius: 8px;
            padding: 0.75rem 1.5rem;
            font-weight: 500;
            text-decoration: none;
        }

        .email-support {
            color: #666;
            margin-bottom: 2rem;
        }

        .email-support a {
            color: var(--primary-green);
            text-decoration: none;
        }

        .chat-section {
            background: var(--light-green);
            border-radius: 16px;
            padding: 2rem;
            position: relative;
        }

        .chat-image {
            position: absolute;
            right: 2rem;
            bottom: 0;
            width: 300px;
            height: auto;
        }

        @media (max-width: 768px) {
            .support-section {
                margin: 1rem;
                padding: 1rem;
            }

            .chat-image {
                width: 200px;
                position: static;
                margin-top: 1rem;
            }

            .contact-buttons {
                flex-direction: column;
            }
        }
    </style>
</head>
<body class="d-flex align-items-center">
    <div class="container">
        <div class="support-section">
            <!-- Tabs -->
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" href="#">Dành cho Người tìm việc</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Dành cho Nhà tuyển dụng</a>
                </li>
            </ul>

            <!-- Content -->
            <h1 class="main-title">Tìm việc khó đã có TopCV</h1>

            <!-- Contact Buttons -->
            <div class="d-flex contact-buttons">
                <a href="tel:(024)66805588" class="phone-button">
                    (024) 6680 5588
                </a>
                <a href="#" class="call-now-button">
                    GỌI NGAY
                </a>
            </div>

            <!-- Email Support -->
            <div class="email-support">
                Email hỗ trợ Ứng viên:
                <a href="mailto:hotro@topcv.vn">hotro@topcv.vn</a>
            </div>

            <!-- Chat Section -->
            <div class="chat-section">
                <div class="chat-message">
                    <div class="message-bubble d-inline-block bg-white p-3 rounded-3">
                        Xin chào
                    </div>
                    <div class="message-bubble d-inline-block bg-white p-3 rounded-3 mt-2">
                        TopCV có thể giúp bạn điều gì?
                    </div>
                </div>
                <img src="https://vieclam.thegioididong.com/img/mobile/searchv2/detail_banner/dmx.jpg" alt="Support Representatives" class="chat-image">
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
