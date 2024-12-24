<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giới thiệu - Seek a Job</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-color: #669699;
            --secondary-color: #3C6E71;
            --accent-color: #94b7b9;
            --text-light: #f8fafc;
            --text-dark: #1e293b;
        }

        body {
            font-family: 'Segoe UI', system-ui, sans-serif;
            line-height: 1.6;
        }

        /* Hero Section Enhancements */
        .hero-section {
            height: 100vh;
            min-height: 600px;
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.7)),
                        url('https://source.unsplash.com/1600x900/?office,team') no-repeat center center;
            background-size: cover;
            display: flex;
            align-items: center;
            color: var(--text-light);
            position: relative;
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        .hero-title {
            font-size: 4.5rem;
            font-weight: 800;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
            margin-bottom: 1.5rem;
        }

        .hero-subtitle {
            font-size: 1.5rem;
            font-weight: 400;
            margin-bottom: 2rem;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.2);
        }

        /* Stats Section Improvements */
        .stats-section {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: var(--text-light);
            padding: 6rem 0;
            position: relative;
            overflow: hidden;
        }

        .stats-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, rgba(255,255,255,0.1) 25%, transparent 25%),
                        linear-gradient(-45deg, rgba(255,255,255,0.1) 25%, transparent 25%);
            background-size: 60px 60px;
            opacity: 0.1;
        }

        .counter-wrapper {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            padding: 2rem;
            backdrop-filter: blur(5px);
            transition: transform 0.3s ease;
        }

        .counter-wrapper:hover {
            transform: translateY(-5px);
        }

        .counter {
            font-size: 3.5rem;
            font-weight: 800;
            color: var(--text-light);
            margin-bottom: 0.5rem;
        }

        /* Mission Cards Enhancement */
        .mission-card {
            transition: all 0.3s ease;
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            overflow: hidden;
            background: white;
        }

        .mission-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.2);
        }

        .mission-icon {
            font-size: 3rem;
            color: var(--primary-color);
            margin-bottom: 1.5rem;
            transition: transform 0.3s ease;
        }

        .mission-card:hover .mission-icon {
            transform: scale(1.1);
        }

        /* Team Section Improvements */
        .team-member {
            position: relative;
            overflow: hidden;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }

        .team-member img {
            transition: transform 0.5s ease;
            width: 100%;
            height: 400px;
            object-fit: cover;
        }

        .team-member:hover img {
            transform: scale(1.1);
        }

        .team-member-info {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(transparent, rgba(0,0,0,0.9));
            padding: 2rem;
            color: white;
            transform: translateY(0);
            transition: transform 0.3s ease;
        }

        .team-member:hover .team-member-info {
            transform: translateY(-10px);
        }

        .team-member-social {
            position: absolute;
            top: 20px;
            right: 20px;
            display: flex;
            flex-direction: column;
            gap: 10px;
            opacity: 0;
            transform: translateX(20px);
            transition: all 0.3s ease;
        }

        .team-member:hover .team-member-social {
            opacity: 1;
            transform: translateX(0);
        }

        .social-icon {
            width: 40px;
            height: 40px;
            background: rgba(255,255,255,0.9);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary-color);
            transition: all 0.3s ease;
        }

        .social-icon:hover {
            background: var(--primary-color);
            color: white;
        }

        /* Values Section Enhancement */
        .value-section {
            background-color: #f8fafc;
            position: relative;
            overflow: hidden;
        }

        .value-card {
            height: 100%;
            transition: all 0.3s ease;
            border: none;
            border-radius: 20px;
            background: white;
            position: relative;
            z-index: 1;
        }

        .value-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border-radius: 20px;
            z-index: -1;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .value-card:hover {
            transform: translateY(-10px);
            color: white;
        }

        .value-card:hover::before {
            opacity: 1;
        }

        .value-icon {
            font-size: 3rem;
            margin-bottom: 1.5rem;
            transition: transform 0.3s ease;
        }

        .value-card:hover .value-icon {
            transform: scale(1.1);
            color: white !important;
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 3rem;
            }

            .hero-subtitle {
                font-size: 1.25rem;
            }

            .counter {
                font-size: 2.5rem;
            }

            .team-member img {
                height: 300px;
            }

            .counter-wrapper {
                margin-bottom: 1rem;
            }
        }

        @media (max-width: 576px) {
            .hero-title {
                font-size: 2.5rem;
            }

            .hero-section {
                min-height: 400px;
            }

            .team-member img {
                height: 250px;
            }
        }

        /* Animation Classes */
        .fade-up {
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.6s ease;
        }

        .fade-up.active {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
</head>
<body>
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container text-center hero-content">
            <div data-aos="fade-up" data-aos-duration="1000">
                <h1 class="hero-title">Seek a Job</h1>
                <p class="hero-subtitle">Định hình tương lai nghề nghiệp của bạn cùng chúng tôi</p>
                <a href=" {{ route('home')}}"><button class="btn btn-primary btn-lg px-5 me-3 rounded-pill">Khám phá ngay</button></a>
                <button class="btn btn-outline-light btn-lg px-5 rounded-pill">Tìm hiểu thêm</button>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats-section">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-6 mb-4 mb-md-0">
                    <div class="counter-wrapper" data-aos="fade-up">
                        <div class="counter" data-target="5000">0</div>
                        <p class="mb-0">Công việc đã đăng</p>
                    </div>
                </div>
                <div class="col-md-3 col-6 mb-4 mb-md-0">
                    <div class="counter-wrapper" data-aos="fade-up" data-aos-delay="200">
                        <div class="counter" data-target="1000">0</div>
                        <p class="mb-0">Doanh nghiệp tin tưởng</p>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="counter-wrapper" data-aos="fade-up" data-aos-delay="400">
                        <div class="counter" data-target="10000">0</div>
                        <p class="mb-0">Ứng viên thành công</p>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="counter-wrapper" data-aos="fade-up" data-aos-delay="600">
                        <div class="counter" data-target="95">0</div>
                        <p class="mb-0">Tỷ lệ hài lòng (%)</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Mission Section -->
    <section class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="display-4 fw-bold" data-aos="fade-up">Sứ mệnh của chúng tôi</h2>
                <p class="lead" data-aos="fade-up" data-aos-delay="200">Kết nối đúng người với đúng công việc</p>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="mission-card h-100" data-aos="fade-up">
                        <div class="card-body text-center p-4">
                            <i class="bi bi-search mission-icon"></i>
                            <h4 class="mb-3">Tìm kiếm thông minh</h4>
                            <p class="mb-0">Công nghệ AI giúp kết nối ứng viên với công việc phù hợp nhất</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mission-card h-100" data-aos="fade-up" data-aos-delay="200">
                        <div class="card-body text-center p-4">
                            <i class="bi bi-shield-check mission-icon"></i>
                            <h4 class="mb-3">An toàn & Bảo mật</h4>
                            <p class="mb-0">Bảo vệ thông tin cá nhân của bạn là ưu tiên hàng đầu của chúng tôi</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mission-card h-100" data-aos="fade-up" data-aos-delay="400">
                        <div class="card-body text-center p-4">
                            <i class="bi bi-graph-up-arrow mission-icon"></i>
                            <h4 class="mb-3">Phát triển sự nghiệp</h4>
                            <p class="mb-0">Hỗ trợ bạn trong mọi bước tiến của sự nghiệp</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="display-4 fw-bold" data-aos="fade-up">Đội ngũ của chúng tôi</h2>
                <p class="lead" data-aos="fade-up" data-aos-delay="200">Những người luôn nỗ lực vì sự thành công của bạn</p>
            </div>
            <div class="row g-4">
                <div class="col-lg-3 col-md-6">
                    <div class="team-member" data-aos="fade-up">
                        <img src="https://i.postimg.cc/QCB69Qwq/IMG-5458.jpg" alt="CEO">
                        <div class="team-member-social">
                            <a href="#" class="social-icon"><i class="bi bi-linkedin"></i></a>
                            <!-- Tiếp tục phần Team Section -->
                            <a href="#" class="social-icon"><i class="bi bi-twitter"></i></a>
                            <a href="https://www.facebook.com/minhh.vuongg.967" class="social-icon"><i class="bi bi-facebook"></i></a>
                        </div>
                        <div class="team-member-info">
                            <h5 class="mb-1">Trần Hoàng Minh Vương</h5>
                            <p class="mb-0">CEO & Founder</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="team-member" data-aos="fade-up" data-aos-delay="200">
                        <img src="https://images.pexels.com/photos/1339536/pexels-photo-1339536.jpeg?cs=srgb&dl=pexels-baphi-1339536.jpg&fm=jpg" alt="CTO">
                        <div class="team-member-social">
                            <a href="#" class="social-icon"><i class="bi bi-linkedin"></i></a>
                            <a href="#" class="social-icon"><i class="bi bi-twitter"></i></a>
                            <a href="#" class="social-icon"><i class="bi bi-facebook"></i></a>
                        </div>
                        <div class="team-member-info">
                            <h5 class="mb-1">Đặng Quang Vinh</h5>
                            <p class="mb-0">Chief Technology Officer</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="team-member" data-aos="fade-up" data-aos-delay="400">
                        <img src="https://cdnphoto.dantri.com.vn/Im0W2Oa59BulrmFjQo1dOsDcBZY=/thumb_w/990/2021/10/30/trang-nhungdocx-1635528230350.jpeg" alt="Design Lead">
                        <div class="team-member-social">
                            <a href="#" class="social-icon"><i class="bi bi-linkedin"></i></a>
                            <a href="#" class="social-icon"><i class="bi bi-twitter"></i></a>
                            <a href="#" class="social-icon"><i class="bi bi-facebook"></i></a>
                        </div>
                        <div class="team-member-info">
                            <h5 class="mb-1">Nguyễn Ngọc A</h5>
                            <p class="mb-0">Design Lead</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="team-member" data-aos="fade-up" data-aos-delay="600">
                        <img src="https://photo.znews.vn/w660/Uploaded/ycgvppwi/2022_08_17/z3649757610090_a1488d39aae272b411f0ac77c027b61d.jpg" alt="Marketing Lead">
                        <div class="team-member-social">
                            <a href="#" class="social-icon"><i class="bi bi-linkedin"></i></a>
                            <a href="#" class="social-icon"><i class="bi bi-twitter"></i></a>
                            <a href="#" class="social-icon"><i class="bi bi-facebook"></i></a>
                        </div>
                        <div class="team-member-info">
                            <h5 class="mb-1">Võ Ngọc B</h5>
                            <p class="mb-0">Marketing Director</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Values Section -->
    <section class="value-section py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="display-4 fw-bold" data-aos="fade-up">Giá trị cốt lõi</h2>
                <p class="lead" data-aos="fade-up" data-aos-delay="200">Những điều chúng tôi luôn hướng đến</p>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="value-card p-4" data-aos="fade-up">
                        <i class="bi bi-heart value-icon text-primary"></i>
                        <h4>Tận tâm</h4>
                        <p>Luôn đặt lợi ích của khách hàng lên hàng đầu và nỗ lực hết mình vì sự thành công của họ.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="value-card p-4" data-aos="fade-up" data-aos-delay="200">
                        <i class="bi bi-lightning value-icon text-primary"></i>
                        <h4>Sáng tạo</h4>
                        <p>Không ngừng đổi mới và tìm kiếm giải pháp tốt nhất cho mọi thách thức.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="value-card p-4" data-aos="fade-up" data-aos-delay="400">
                        <i class="bi bi-shield-check value-icon text-primary"></i>
                        <h4>Uy tín</h4>
                        <p>Xây dựng niềm tin thông qua sự minh bạch và cam kết chất lượng dịch vụ.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6" data-aos="fade-right">
                    <h2 class="display-4 fw-bold mb-4">Liên hệ với chúng tôi</h2>
                    <p class="lead mb-4">Hãy để lại thông tin, chúng tôi sẽ liên hệ với bạn sớm nhất có thể.</p>
                    <form id="contactForm" class="needs-validation" novalidate>
                        <div class="mb-3">
                            <input type="text" class="form-control form-control-lg" placeholder="Họ và tên" required>
                            <div class="invalid-feedback">Vui lòng nhập họ tên</div>
                        </div>
                        <div class="mb-3">
                            <input type="email" class="form-control form-control-lg" placeholder="Email" required>
                            <div class="invalid-feedback">Vui lòng nhập email hợp lệ</div>
                        </div>
                        <div class="mb-3">
                            <textarea class="form-control form-control-lg" rows="4" placeholder="Tin nhắn" required></textarea>
                            <div class="invalid-feedback">Vui lòng nhập tin nhắn</div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg px-5">Gửi tin nhắn</button>
                    </form>
                </div>
                <div class="col-lg-6" data-aos="fade-left">
                    <img src="https://i.postimg.cc/66vGVst5/a.png" alt="Contact" class="img-fluid rounded-3 shadow">
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-light py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4">
                    <h3 class="h4 mb-4">Seek a Job</h3>
                    <p>Định hình tương lai nghề nghiệp của bạn cùng chúng tôi. Kết nối đúng người với đúng công việc.</p>
                    <div class="d-flex gap-3">
                        <a href="#" class="text-light"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="text-light"><i class="bi bi-twitter"></i></a>
                        <a href="#" class="text-light"><i class="bi bi-linkedin"></i></a>
                        <a href="#" class="text-light"><i class="bi bi-instagram"></i></a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4">
                    <h5 class="mb-4">Liên kết</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="{{route('home')}}" class="text-light text-decoration-none">Trang chủ</a></li>
                        <li class="mb-2"><a href="/about" class="text-light text-decoration-none">Về chúng tôi</a></li>
                        <li class="mb-2"><a href="#" class="text-light text-decoration-none">Dịch vụ</a></li>
                        <li class="mb-2"><a href="{{route('contact')}}" class="text-light text-decoration-none">Liên hệ</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-4">
                    <h5 class="mb-4">Dịch vụ</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="{{route('latest-jobs')}}" class="text-light text-decoration-none">Tìm việc</a></li>
                        <li class="mb-2"><a href="#" class="text-light text-decoration-none">Đăng tuyển</a></li>
                        <li class="mb-2"><a href="#" class="text-light text-decoration-none">Tư vấn</a></li>
                        <li class="mb-2"><a href="#" class="text-light text-decoration-none">Đào tạo</a></li>
                    </ul>
                </div>
                <div class="col-lg-4 col-md-4">
                    <h5 class="mb-4">Liên hệ</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><i class="bi bi-geo-alt me-2"></i> Trường ĐH CNTT&TT Việt-Hàn, Làng Đại học Đà Nẵng</li>
                        <li class="mb-2"><i class="bi bi-telephone me-2"></i> (84) 966 069 848</li>
                        <li class="mb-2"><i class="bi bi-envelope me-2"></i> seekajob2024@gmail.com</li>
                    </ul>
                </div>
            </div>
            <hr class="my-4">
            <div class="text-center">
                <p class="mb-0">&copy; 2024 Seek a Job. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script>
        // Initialize AOS
        AOS.init({
            duration: 800,
            once: true
        });

        // Counter animation
        const counters = document.querySelectorAll('.counter');
        const speed = 200;

        const animateCounter = (counter) => {
            const target = parseInt(counter.getAttribute('data-target'));
            const count = parseInt(counter.innerText);
            const increment = target / speed;

            if (count < target) {
                counter.innerText = Math.ceil(count + increment);
                setTimeout(() => animateCounter(counter), 1);
            } else {
                counter.innerText = target;
            }
        };

        // Intersection Observer for counters
        const observerOptions = {
            threshold: 0.7,
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const counter = entry.target;
                    animateCounter(counter);
                    observer.unobserve(counter);
                }
            });
        }, observerOptions);

        counters.forEach(counter => {
            counter.innerText = '0';
            observer.observe(counter);
        });

        // Form validation
        const forms = document.querySelectorAll('.needs-validation');
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });

        // Smooth scroll
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });

        // Navbar scroll effect
        window.addEventListener('scroll', () => {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('navbar-scrolled');
            } else {
                navbar.classList.remove('navbar-scrolled');
            }
        });
    </script>
</body>
</html>
