<div class="col-lg-3 col-md-6 mb-4">
    <div class="company-card text-center">
        <a href="{{ route('companies.show', $company->id) }}" class="company-link">
            <div class="company-logo">
                <img src="{{ $company->logo ? (filter_var($company->logo, FILTER_VALIDATE_URL) ? $company->logo : Storage::url($company->logo)) : asset('default-logo.png') }}"
                     alt="{{ $company->name }}" class="img-fluid">
            </div>
        </a>
        <div class="card-body">
            <h5 class="card-title">{{ $company->name }}</h5>
            <p class="card-text">
                <strong>Ngành:</strong> {{ $company->industry ?? 'N/A' }}<br>
                <strong>Nhân viên:</strong> {{ $company->employee_count ?? 'N/A' }}
            </p>
            @if ($company->website)
                <a href="{{ $company->website }}" target="_blank" class="btn btn-primary">Website</a>
            @endif
        </div>
    </div>
</div>
