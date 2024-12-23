<div class="col-lg-4 col-md-6 col-sm-12 mb-4">
  <div class="category-card text-center h-100 p-3">
      <a href="{{ route('companies.show', $company->id) }}" class="company-link">
          <div class="category-logo">
              <img src="{{ $company->logo ? (filter_var($company->logo, FILTER_VALIDATE_URL) ? $company->logo : Storage::url($company->logo)) : asset('default-logo.png') }}"
                   alt="{{ $company->name }}" class="img-fluid">
          </div>
      </a>

      <h5 class="card-title mt-3">{{ $company->name }}</h5>
      <p class="card-text">
          Ngành: {{ $company->industry ?? 'N/A' }}<br>
          <strong>Nhân viên:</strong> {{ $company->employee_count ?? 'N/A' }}
      </p>
      @if ($company->website)
          <a href="{{ $company->website }}" target="_blank" class="btn btn-primary">Website</a>
      @endif
  </div>
</div>
