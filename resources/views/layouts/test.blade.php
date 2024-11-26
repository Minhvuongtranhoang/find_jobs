<?php
// job-search-template.php
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WorkHub - Tìm kiếm việc làm</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary: #2563EB;
            --primary-light: #3B82F6;
            --neutral-bg: #F3F4F6;
            --text-main: #4B5563;
            --text-light: #9CA3AF;
            --success: #10B981;
            --warning: #F59E0B;
            --error: #EF4444;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #FFFFFF;
            color: var(--text-main);
            line-height: 1.6;
        }

        /* Header Styles */
        .header {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            padding: 1rem 0;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            color: white;
            font-size: 1.5rem;
            font-weight: bold;
            text-decoration: none;
        }

        .nav-links {
            display: flex;
            gap: 2rem;
        }

        .nav-links a {
            color: white;
            text-decoration: none;
            font-weight: 500;
            transition: opacity 0.3s;
        }

        .nav-links a:hover {
            opacity: 0.8;
        }

        /* Hero Section */
        .hero {
            background-color: var(--primary);
            color: white;
            padding: 4rem 1rem;
            text-align: center;
        }

        .hero-content {
            max-width: 800px;
            margin: 0 auto;
        }

        .hero h1 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }

        .search-box {
            background: white;
            padding: 1.5rem;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            margin-top: 2rem;
        }

        .search-form {
            display: flex;
            gap: 1rem;
        }

        .search-input {
            flex: 1;
            padding: 0.8rem 1rem;
            border: 1px solid var(--neutral-bg);
            border-radius: 5px;
            font-size: 1rem;
        }

        .search-button {
            background: var(--primary-light);
            color: white;
            border: none;
            padding: 0.8rem 2rem;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        .search-button:hover {
            background: var(--primary);
        }

        /* Job Categories */
        .categories {
            padding: 4rem 1rem;
            background-color: var(--neutral-bg);
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .section-title {
            text-align: center;
            margin-bottom: 3rem;
        }

        .category-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
        }

        .category-card {
            background: white;
            padding: 1.5rem;
            border-radius: 8px;
            text-align: center;
            transition: transform 0.3s;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }

        .category-card:hover {
            transform: translateY(-5px);
        }

        .category-icon {
            font-size: 2rem;
            color: var(--primary);
            margin-bottom: 1rem;
        }

        /* Featured Jobs */
        .featured-jobs {
            padding: 4rem 1rem;
        }

        .job-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
        }

        .job-card {
            background: white;
            border: 1px solid var(--neutral-bg);
            border-radius: 8px;
            padding: 1.5rem;
            transition: box-shadow 0.3s;
        }

        .job-card:hover {
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .company-logo {
            width: 60px;
            height: 60px;
            background: var(--neutral-bg);
            border-radius: 8px;
            margin-bottom: 1rem;
        }

        .job-title {
            font-size: 1.2rem;
            color: var(--primary);
            margin-bottom: 0.5rem;
        }

        .job-company {
            color: var(--text-light);
            margin-bottom: 1rem;
        }

        .job-tags {
            display: flex;
            gap: 0.5rem;
            margin-bottom: 1rem;
        }

        .tag {
            background: var(--neutral-bg);
            padding: 0.3rem 0.8rem;
            border-radius: 20px;
            font-size: 0.9rem;
        }

        .job-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 1rem;
            padding-top: 1rem;
            border-top: 1px solid var(--neutral-bg);
        }

        .salary {
            color: var(--success);
            font-weight: bold;
        }

        /* Footer */
        .footer {
            background: var(--primary);
            color: white;
            padding: 3rem 1rem;
            margin-top: 4rem;
        }

        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
        }

        .footer-section h3 {
            margin-bottom: 1rem;
        }

        .footer-links {
            list-style: none;
        }

        .footer-links li {
            margin-bottom: 0.5rem;
        }

        .footer-links a {
            color: white;
            text-decoration: none;
            opacity: 0.8;
            transition: opacity 0.3s;
        }

        .footer-links a:hover {
            opacity: 1;
        }

        @media (max-width: 768px) {
            .search-form {
                flex-direction: column;
            }

            .nav-links {
                display: none;
            }

            .hero h1 {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="header">
        <nav class="nav-container">
            <a href="#" class="logo">WorkHub</a>
            <div class="nav-links">
                <a href="#">Trang chủ</a>
                <a href="#">Việc làm</a>
                <a href="#">Công ty</a>
                <a href="#">Blog</a>
                <a href="#">Đăng nhập</a>
            </div>
        </nav>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h1>Tìm công việc mơ ước của bạn</h1>
            <p>Khám phá hơn 10,000+ cơ hội việc làm từ các công ty hàng đầu</p>
            <div class="search-box">
                <form class="search-form">
                    <input type="text" class="search-input" placeholder="Chức danh, kỹ năng, công ty">
                    <input type="text" class="search-input" placeholder="Địa điểm">
                    <button type="submit" class="search-button">
                        <i class="fas fa-search"></i> Tìm kiếm
                    </button>
                </form>
            </div>
        </div>
    </section>

    <!-- Categories Section -->
    <section class="categories">
        <div class="container">
            <div class="section-title">
                <h2>Khám phá theo ngành nghề</h2>
                <p>Tìm việc làm phù hợp với chuyên môn của bạn</p>
            </div>
            <div class="category-grid">
                <div class="category-card">
                    <i class="fas fa-laptop-code category-icon"></i>
                    <h3>Công nghệ thông tin</h3>
                    <p>1200+ việc làm</p>
                </div>
                <div class="category-card">
                    <i class="fas fa-chart-line category-icon"></i>
                    <h3>Tài chính - Kế toán</h3>
                    <p>800+ việc làm</p>
                </div>
                <div class="category-card">
                    <i class="fas fa-bullhorn category-icon"></i>
                    <h3>Marketing</h3>
                    <p>600+ việc làm</p>
                </div>
                <div class="category-card">
                    <i class="fas fa-users category-icon"></i>
                    <h3>Nhân sự</h3>
                    <p>450+ việc làm</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Jobs Section -->
    <section class="featured-jobs">
        <div class="container">
            <div class="section-title">
                <h2>Việc làm nổi bật</h2>
                <p>Các cơ hội việc làm được cập nhật thường xuyên</p>
            </div>
            <div class="job-grid">
                <div class="job-card">
                    <div class="company-logo"></div>
                    <h3 class="job-title">Senior Frontend Developer</h3>
                    <div class="job-company">Tech Solutions Inc.</div>
                    <div class="job-tags">
                        <span class="tag">ReactJS</span>
                        <span class="tag">TypeScript</span>
                        <span class="tag">3 năm</span>
                    </div>
                    <div class="job-footer">
                        <span class="salary">25-35 triệu</span>
                        <span>Hà Nội</span>
                    </div>
                </div>
                <div class="job-card">
                    <div class="company-logo"></div>
                    <h3 class="job-title">Product Marketing Manager</h3>
                    <div class="job-company">Global Marketing Corp</div>
                    <div class="job-tags">
                        <span class="tag">Marketing</span>
                        <span class="tag">Digital</span>
                        <span class="tag">5 năm</span>
                    </div>
                    <div class="job-footer">
                        <span class="salary">30-40 triệu</span>
                        <span>TP.HCM</span>
                    </div>
                </div>
                <div class="job-card">
                    <div class="company-logo"></div>
                    <h3 class="job-title">HR Business Partner</h3>
                    <div class="job-company">VN Group</div>
                    <div class="job-tags">
                        <span class="tag">HR</span>
                        <span class="tag">Management</span>
                        <span class="tag">4 năm</span>
                    </div>
                    <div class="job-footer">
                        <span class="salary">20-25 triệu</span>
                        <span>Đà Nẵng</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-content">
            <div class="footer-section">
                <h3>Về WorkHub</h3>
                <ul class="footer-links">
                    <li><a href="#">Giới thiệu</a></li>
                    <li><a href="#">Blog</a></li>
                    <li><a href="#">Điều khoản sử dụng</a></li>
                    <li><a href="#">Chính sách bảo mật</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Dành cho ứng viên</h3>
                <ul class="footer-links">
                    <li><a href="#">Tìm việc làm</a></li>
                    <li><a href="#">Tạo CV</a></li>
                    <li><a href="#">Cẩm nang nghề nghiệp</a></li>
                    <li><a href="#">Tra cứu lương</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Dành cho nhà tuyển dụng</h3>
                <ul class="footer-links">
                    <li><a href="#">Đăng tin tuyển dụng</a></li>
                    <li><a href="#">Tìm hồ sơ</a></li>
                    <li><a href="#">Giải pháp talent solution</a></li>
                    <li><a href="#">Báo giá dịch vụ</a></li>
                </ul>
            </div>

            <div class="footer-section">
              <h3>Liên hệ</h3>
              <ul class="footer-links">
                  <li><a href="#"><i class="fas fa-phone"></i> 1900 6868</a></li>
                  <li><a href="#"><i class="fas fa-envelope"></i> support@workhub.vn</a></li>
                  <li><a href="#"><i class="fas fa-map-marker-alt"></i> Tầng 20, Tòa nhà ABC</a></li>
                  <li>
                      <div style="display: flex; gap: 1rem; margin-top: 1rem;">
                          <a href="#" style="font-size: 1.5rem;"><i class="fab fa-facebook"></i></a>
                          <a href="#" style="font-size: 1.5rem;"><i class="fab fa-linkedin"></i></a>
                          <a href="#" style="font-size: 1.5rem;"><i class="fab fa-youtube"></i></a>
                      </div>
                  </li>
              </ul>
          </div>
      </div>
      <div style="text-align: center; padding-top: 2rem; border-top: 1px solid rgba(255,255,255,0.1); margin-top: 2rem;">
          <p>&copy; 2024 WorkHub. Tất cả quyền được bảo lưu.</p>
      </div>
  </footer>

  <!-- Stats Section -->
  <section style="background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%); padding: 4rem 1rem; color: white; text-align: center; margin-top: -4rem;">
      <div class="container">
          <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 2rem;">
              <div>
                  <h3 style="font-size: 2.5rem; margin-bottom: 0.5rem;">10K+</h3>
                  <p>Việc làm đang tuyển</p>
              </div>
              <div>
                  <h3 style="font-size: 2.5rem; margin-bottom: 0.5rem;">5K+</h3>
                  <p>Doanh nghiệp tin dùng</p>
              </div>
              <div>
                  <h3 style="font-size: 2.5rem; margin-bottom: 0.5rem;">1M+</h3>
                  <p>Ứng viên tiềm năng</p>
              </div>
              <div>
                  <h3 style="font-size: 2.5rem; margin-bottom: 0.5rem;">50K+</h3>
                  <p>Tuyển dụng thành công</p>
              </div>
          </div>
      </div>
  </section>

  <!-- Top Companies Section -->
  <section style="padding: 4rem 1rem; background-color: white;">
      <div class="container">
          <div class="section-title">
              <h2>Nhà tuyển dụng hàng đầu</h2>
              <p>Cơ hội việc làm từ các công ty uy tín</p>
          </div>
          <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 2rem; margin-top: 2rem;">
              <?php for($i = 1; $i <= 8; $i++): ?>
              <div style="background: var(--neutral-bg); height: 100px; border-radius: 8px; display: flex; align-items: center; justify-content: center; transition: transform 0.3s;">
                  <div style="color: var(--text-light); font-weight: bold;">Logo công ty <?php echo $i; ?></div>
              </div>
              <?php endfor; ?>
          </div>
      </div>
  </section>

  <!-- Why Choose Us Section -->
  <section style="padding: 4rem 1rem; background-color: var(--neutral-bg);">
      <div class="container">
          <div class="section-title">
              <h2>Tại sao chọn WorkHub?</h2>
              <p>Nền tảng tuyển dụng hàng đầu tại Việt Nam</p>
          </div>
          <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 2rem; margin-top: 2rem;">
              <div class="category-card">
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

  <!-- Download App Section -->
  <section style="padding: 4rem 1rem;">
      <div class="container" style="display: grid; grid-template-columns: 1fr 1fr; gap: 4rem; align-items: center;">
          <div>
              <h2 style="font-size: 2rem; margin-bottom: 1rem;">Tải ứng dụng WorkHub</h2>
              <p style="margin-bottom: 2rem;">Tìm việc làm mọi lúc mọi nơi với ứng dụng WorkHub trên điện thoại</p>
              <div style="display: flex; gap: 1rem;">
                  <img src="/api/placeholder/150/50" alt="App Store" style="border-radius: 8px;">
                  <img src="/api/placeholder/150/50" alt="Google Play" style="border-radius: 8px;">
              </div>
          </div>
          <div style="text-align: center;">
              <img src="/api/placeholder/300/600" alt="Mobile App" style="max-width: 100%; border-radius: 20px; box-shadow: 0 20px 40px rgba(0,0,0,0.1);">
          </div>
      </div>
  </section>

  <!-- Career Tips Section -->
  <section style="padding: 4rem 1rem; background-color: var(--neutral-bg);">
      <div class="container">
          <div class="section-title">
              <h2>Cẩm nang nghề nghiệp</h2>
              <p>Kiến thức hữu ích cho sự nghiệp của bạn</p>
          </div>
          <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem;">
              <?php for($i = 1; $i <= 3; $i++): ?>
              <div style="background: white; border-radius: 8px; overflow: hidden; transition: transform 0.3s;">
                  <img src="/api/placeholder/400/200" alt="Career Tips" style="width: 100%; height: 200px; object-fit: cover;">
                  <div style="padding: 1.5rem;">
                      <h3 style="margin-bottom: 1rem;">Bí quyết phỏng vấn thành công</h3>
                      <p style="color: var(--text-light); margin-bottom: 1rem;">Những kỹ năng cần thiết để tự tin trong buổi phỏng vấn</p>
                      <a href="#" style="color: var(--primary); text-decoration: none; font-weight: 500;">Đọc thêm →</a>
                  </div>
              </div>
              <?php endfor; ?>
          </div>
      </div>
  </section>

  <!-- Job Alert Banner -->
  <section style="padding: 4rem 1rem; background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);">
      <div class="container" style="text-align: center; color: white;">
          <h2 style="font-size: 2rem; margin-bottom: 1rem;">Không bỏ lỡ cơ hội việc làm</h2>
          <p style="margin-bottom: 2rem;">Đăng ký nhận thông báo việc làm phù hợp với bạn</p>
          <form style="max-width: 500px; margin: 0 auto;">
              <div style="display: flex; gap: 1rem;">
                  <input type="email" placeholder="Nhập email của bạn" style="flex: 1; padding: 0.8rem 1rem; border: none; border-radius: 5px;">
                  <button type="submit" class="search-button" style="white-space: nowrap;">
                      Đăng ký ngay
                  </button>
              </div>
          </form>
      </div>
  </section>

  <script>
      // Add smooth scrolling
      document.querySelectorAll('a[href^="#"]').forEach(anchor => {
          anchor.addEventListener('click', function (e) {
              e.preventDefault();
              document.querySelector(this.getAttribute('href')).scrollIntoView({
                  behavior: 'smooth'
              });
          });
      });

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
  </script>
</body>
</html>
