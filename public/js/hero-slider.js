$(document).ready(function(){

    // Initialize sliders
    function initializeSlider(selector, autoplay) {
        $(selector).owlCarousel({
            loop: true,
            margin: 10,
            nav: false,
            dots: true,
            autoplay: autoplay,
            autoplayTimeout: 5000,
            responsive: {
                0: {
                    items: 1
                }
            }
        });
    }

    // Initialize sliders without data-autoplay="false"
    initializeSlider('.hero-slider:not([data-autoplay="false"])', true);

    // Initialize sliders with data-autoplay="false"
    initializeSlider('.hero-slider[data-autoplay="false"]', false);

  // Snow effect
  function createSnow() {
      const snowContainer = document.getElementById('snow-container');
      const snow = document.createElement('div');
      snow.classList.add('snow');

      // Random position
      snow.style.left = Math.random() * 100 + '%';

      // Random size
      const size = (Math.random() * 5) + 3;
      snow.style.width = size + 'px';
      snow.style.height = size + 'px';

      // Random animation duration
      const duration = (Math.random() * 3) + 8;
      snow.style.animationDuration = duration + 's';

      snowContainer.appendChild(snow);

      // Remove snow after animation
      setTimeout(() => {
          snow.remove();
      }, duration * 1000);
  }

  // Create snow at intervals
  setInterval(createSnow, 200);

  // Create initial batch of snow
  for(let i = 0; i < 20; i++) {
      setTimeout(createSnow, Math.random() * 3000);
  }
});
