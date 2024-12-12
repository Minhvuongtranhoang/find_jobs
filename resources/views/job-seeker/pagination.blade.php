<style>
  .pagination {
    display: flex;
    align-items: center;
    font-size: 14px;
  }

  .pagination a {
    color: #6c757d;
    text-decoration: none;
    padding: 6px 12px;
    border: 1px solid #dee2e6;
    border-radius: 0.25rem;
    margin: 0 4px;
  }

  .pagination a:hover {
    background-color: #e9ecef;
  }

  .pagination a.prev-link,
  .pagination a.next-link {
    padding: 6px 10px;
  }

  .pagination .current-page {
    color: #6c757d;
    font-weight: bold;
    margin: 0 8px;
  }

  .text-muted {
    color: #6c757d !important;
  }
  </style>
<div class="d-flex flex-column align-items-center" style="margin-top: 30px">
  <div>
      {{ $jobs->links('vendor.pagination.simple-bootstrap-4') }}
  </div>
  <div class="text-muted mt-2">
      Showing {{ $jobs->firstItem() }} to {{ $jobs->lastItem() }} of {{ $jobs->total() }} results
  </div>
</div>

<script>

// Ajax for jobs
$(document).on('click', '.pagination a', function(e) {
  e.preventDefault();

  let url = $(this).attr('href');
  fetchJobs(url);
});

function fetchJobs(url) {
  $.ajax({
      url: url,
      type: 'GET',
      success: function(response) {
          $('#job-list').html(response.jobs);
          $('#pagination-container').html(response.pagination);
      },
      error: function(xhr) {
          console.error("Error fetching jobs:", xhr.responseText);
      }
  });
}
</script>
