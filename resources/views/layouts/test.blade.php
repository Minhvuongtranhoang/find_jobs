<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Enhanced Responsive Carousel</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      background-color: #f5f5f5;
    }

    .carousel-container {
      position: relative;
      width: 100%;
      max-width: 1200px;
      margin: 0 auto;
      padding: 40px 20px;
      overflow: hidden;
    }

    .images-wrapper {
      position: relative;
      height: 250px;
      width: 100%;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .carousel-image {
      position: absolute;
      height: auto;
      max-height: 100%;
      width: auto;
      max-width: 100%;
      object-fit: contain;
      transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
      cursor: pointer;
      border-radius: 12px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .carousel-image.left {
      transform: translateX(-100%) scale(0.8);
      opacity: 0.5;
      z-index: 1;
    }

    .carousel-image.right {
      transform: translateX(100%) scale(0.8);
      opacity: 0.5;
      z-index: 1;
    }

    .carousel-image.center {
      transform: translateX(0) scale(1);
      opacity: 1;
      z-index: 2;
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
    }

    .controls-container {
      position: absolute;
      left: 50%;
      transform: translateX(-50%);
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 10px 20px;
      border-radius: 30px;
      backdrop-filter: blur(4px);
    }

    .control-btn {
      background: none;
      border: none;
      color: #3C6E71;
      font-size: 20px;
      cursor: pointer;
      width: 30px;
      height: 30px;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: all 0.3s ease;
    }

    .carousel-indicators {
      display: flex;
      align-items: center;
      gap: 8px;
      margin: 0 10px;
    }

    .carousel-indicators button {
      width: 8px;
      height: 8px;
      border-radius: 50%;
      background-color: #ffffff;
      border: none;
      transition: all 0.3s ease;
      padding: 0;
      cursor: pointer;
    }

    .carousel-indicators button.active {
      background-color: #3C6E71;
      width: 10px;
      height: 10px;
    }

    @media (max-width: 768px) {
      .images-wrapper {
        height: 300px;
      }

      .carousel-image {
        max-width: 95%;
      }

      .controls-container {
        padding: 8px 16px;
      }

      .control-btn {
        font-size: 16px;
        width: 24px;
        height: 24px;
      }
    }

    @media (max-width: 480px) {
      .images-wrapper {
        height: 250px;
      }

      .carousel-container {
        padding: 20px 10px;
      }
    }
  </style>
</head>
<body>

<div class="carousel-container">
  <div class="images-wrapper">
    <img src="https://taimienphi.vn/tmp/cf/aut/hinh-anh-tuyen-dung-dep-hinh-dang-tin-tuyen-dung-1.jpg" class="carousel-image" alt="Image 1" data-index="0">
    <img src="https://asd.mediacdn.vn/adt/tuyendungvccorp/hinh-anh-tuyen-nhan-vien-ban-hang-03_4884de2f-6641-4aa9-9d03-6411191fd411.jpg" class="carousel-image" alt="Image 2" data-index="1">
    <img src="https://thuthuat.taimienphi.vn/cf/Images/ptx/2019/2/19/hinh-anh-tuyen-dung-dep-hinh-dang-tin-tuyen-dung.jpg" class="carousel-image" alt="Image 3" data-index="2">
  </div>

  <div class="controls-container">
    <button class="control-btn" id="prevBtn">&#10094;</button>
    <div class="carousel-indicators">
      <button type="button" data-index="0" aria-label="Slide 1"></button>
      <button type="button" data-index="1" aria-label="Slide 2"></button>
      <button type="button" data-index="2" aria-label="Slide 3"></button>
    </div>
    <button class="control-btn" id="nextBtn">&#10095;</button>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
  const images = Array.from(document.querySelectorAll('.carousel-image'));
  const indicators = Array.from(document.querySelectorAll('.carousel-indicators button'));
  const prevBtn = document.getElementById('prevBtn');
  const nextBtn = document.getElementById('nextBtn');
  let currentIndex = 0;
  let touchStartX = 0;
  let touchEndX = 0;

  function updateCarousel(newIndex) {
    currentIndex = newIndex;

    images.forEach((img, index) => {
      img.classList.remove('left', 'center', 'right');

      if (index === currentIndex) {
        img.classList.add('center');
      } else if (index === (currentIndex - 1 + images.length) % images.length) {
        img.classList.add('left');
      } else {
        img.classList.add('right');
      }
    });

    indicators.forEach((indicator, index) => {
      indicator.classList.toggle('active', index === currentIndex);
    });
  }

  // Add touch support
  const carousel = document.querySelector('.images-wrapper');

  carousel.addEventListener('touchstart', (e) => {
    touchStartX = e.touches[0].clientX;
  });

  carousel.addEventListener('touchend', (e) => {
    touchEndX = e.changedTouches[0].clientX;
    handleSwipe();
  });

  function handleSwipe() {
    const swipeDistance = touchEndX - touchStartX;
    const minSwipeDistance = 50;

    if (Math.abs(swipeDistance) > minSwipeDistance) {
      if (swipeDistance > 0) {
        // Swipe right - show previous
        const newIndex = (currentIndex - 1 + images.length) % images.length;
        updateCarousel(newIndex);
      } else {
        // Swipe left - show next
        const newIndex = (currentIndex + 1) % images.length;
        updateCarousel(newIndex);
      }
    }
  }

  // Add auto-play
  let autoplayInterval = setInterval(() => {
    const newIndex = (currentIndex + 1) % images.length;
    updateCarousel(newIndex);
  }, 5000);

  // Pause autoplay on hover
  carousel.addEventListener('mouseenter', () => {
    clearInterval(autoplayInterval);
  });

  carousel.addEventListener('mouseleave', () => {
    autoplayInterval = setInterval(() => {
      const newIndex = (currentIndex + 1) % images.length;
      updateCarousel(newIndex);
    }, 5000);
  });

  // Event listeners
  indicators.forEach((indicator, index) => {
    indicator.addEventListener('click', () => {
      clearInterval(autoplayInterval);
      updateCarousel(index);
    });
  });

  prevBtn.addEventListener('click', () => {
    clearInterval(autoplayInterval);
    const newIndex = (currentIndex - 1 + images.length) % images.length;
    updateCarousel(newIndex);
  });

  nextBtn.addEventListener('click', () => {
    clearInterval(autoplayInterval);
    const newIndex = (currentIndex + 1) % images.length;
    updateCarousel(newIndex);
  });

  // Initialize
  updateCarousel(0);
});
</script>
</body>
</html>
