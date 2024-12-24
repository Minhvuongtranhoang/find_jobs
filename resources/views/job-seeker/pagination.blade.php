<style>
  .pagination {
    display: flex;
    align-items: center;
    font-size: 14px;
  }

  .pagination a {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 36px;
    height: 36px;
    text-decoration: none;
    border: 1px solid #3C6E71;
    border-radius: 50%;
    color: #3C6E71;
    font-weight: bold;
    margin: 0 4px;
    transition: background-color 0.3s, color 0.3s;
  }

  .pagination a:hover {
    background-color: #3C6E71;
    color: #ffffff;
  }

  .pagination a.disabled {
    color: #ccc;
    border-color: #ccc;
    cursor: not-allowed;
  }

  .pagination .current-page {
    font-weight: bold;
    margin: 0 8px;
    color: #3C6E71;
  }
</style>

<!-- Phân trang Jobs -->
@if(isset($jobs) && $jobs->isNotEmpty())
<div id="job-list">
    <!-- Hiển thị danh sách công việc -->
    @foreach($jobs as $job)
    <div hidden>{{ $job->title }}</div>
    @endforeach
</div>
<div id="pagination-container-jobs">
    <div class="pagination">
      <a href="{{ $jobs->previousPageUrl() }}" class="{{ $jobs->onFirstPage() ? 'disabled' : '' }}" aria-label="Previous">
        &#8249;
      </a>
      <span class="current-page">
        {{ $jobs->currentPage() }} / {{ $jobs->lastPage() }} pages
      </span>
      <a href="{{ $jobs->nextPageUrl() }}" class="{{ $jobs->hasMorePages() ? '' : 'disabled' }}" aria-label="Next">
        &#8250;
      </a>
    </div>
</div>
@endif

<!-- Phân trang Companies -->
@if(isset($companies) && $companies->isNotEmpty())
<div id="company-list">
    <!-- Hiển thị danh sách công ty -->
    @foreach($companies as $company)
    <div hidden>{{ $company->name }}</div>
    @endforeach
</div>
<div id="pagination-container-companies">
    <div class="pagination">
      <a href="{{ $companies->previousPageUrl() }}" class="{{ $companies->onFirstPage() ? 'disabled' : '' }}" aria-label="Previous">
        &#8249;
      </a>
      <span class="current-page">
        {{ $companies->currentPage() }} / {{ $companies->lastPage() }} pages
      </span>
      <a href="{{ $companies->nextPageUrl() }}" class="{{ $companies->hasMorePages() ? '' : 'disabled' }}" aria-label="Next">
        &#8250;
      </a>
    </div>
</div>
@endif

<script>
  // Xử lý phân trang cho Jobs
  $(document).on('click', '#pagination-container-jobs .pagination a:not(.disabled)', function (e) {
      e.preventDefault();

      let url = $(this).attr('href');
      fetchJobs(url);
  });

  function fetchJobs(url) {
      $.ajax({
          url: url,
          type: 'GET',
          success: function (response) {
              $('#job-list').html(response.jobs);
              $('#pagination-container-jobs').html(response.pagination);
          },
          error: function (xhr) {
              console.error("Error fetching jobs:", xhr.responseText);
          }
      });
  }

  // Xử lý phân trang cho Companies
  $(document).on('click', '#pagination-container-companies .pagination a:not(.disabled)', function (e) {
      e.preventDefault();

      let url = $(this).attr('href');
      fetchCompanies(url);
  });

  function fetchCompanies(url) {
      $.ajax({
          url: url,
          type: 'GET',
          success: function(response) {
              $('#companies-list').html(response.html);
              $('#pagination').html(response.pagination); 
          },
          error: function (xhr) {
              console.error("Error fetching companies:", xhr.responseText);
          }
      });
  }
</script>
