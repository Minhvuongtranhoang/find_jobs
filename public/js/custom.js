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
