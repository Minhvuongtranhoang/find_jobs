document.addEventListener('DOMContentLoaded', function() {
  const dropdownItems = document.querySelectorAll('.dropdown-item');
  const dropdownToggle = document.getElementById('dropdownMenuButton');
  const toggleText = dropdownToggle.querySelector('span');

  dropdownItems.forEach(item => {
    item.addEventListener('click', function(e) {
      e.preventDefault();
      // Remove active class from all items
      dropdownItems.forEach(i => i.classList.remove('active'));
      // Add active class to clicked item
      this.classList.add('active');
      // Update dropdown button text with smooth transition
      const newText = `Lọc theo: ${this.getAttribute('data-value')}`;
      toggleText.style.opacity = '0';
      setTimeout(() => {
        toggleText.textContent = newText;
        toggleText.style.opacity = '1';
      }, 150);
    });
  });
});
