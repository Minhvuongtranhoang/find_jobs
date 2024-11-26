@extends('layouts.job-seeker')
<style>
  /* Company Card Styles */
.company-card {
    position: relative;
    background-color: #ffffff;
    border-radius: 12px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
    overflow: hidden;
    height: 100%;
}

.company-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
}

.company-logo {
    position: relative;
    height: 200px;
    display: flex;
    align-items: center;
    justify-content: center;
    /* background-color: #f8f9fa; */
    overflow: hidden;
}

.company-logo img {
    max-width: 80%;
    max-height: 150px;
    object-fit: contain;
    transition: transform 0.3s ease;
}

.company-card:hover .company-logo img {
    transform: scale(1.1);
}

.card-body {
    padding: 20px;
    text-align: center;
}

.card-title {
    font-size: 1.2rem;
    font-weight: 700;
    color: #333;
    margin-bottom: 15px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.card-text {
    color: #6c757d;
    margin-bottom: 15px;
    line-height: 1.6;
}

.company-card .btn {
    margin: 0 5px;
    padding: 8px 15px;
    font-size: 0.9rem;
    border-radius: 20px;
    transition: all 0.3s ease;
}

.company-card .btn-primary {
    background-color: #007bff;
    border-color: #007bff;
}

.company-card .btn-primary:hover {
    background-color: #0056b3;
    border-color: #0056b3;
}

/* Responsive Adjustments */
@media (max-width: 768px) {
    .company-card {
        margin-bottom: 20px;
    }

    .company-logo {
        height: 150px;
    }
}

.company-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 4px;
    background: linear-gradient(to right, #007bff, #00c6ff);
}
</style>
@section('content')
<div class="container">
    <h1 class="mb-4">Danh sách công ty</h1>

    @if ($companies->count())
        <div class="row">
            @foreach ($companies as $company)
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="company-card text-center">
                        <a href="{{ route('companies.show', $company->id) }}" class="company-link">
                            <div class="company-logo">
                                @if ($company->logo)
                                    <img
                                        src="{{ filter_var($company->logo, FILTER_VALIDATE_URL) ? $company->logo : Storage::url($company->logo) }}"
                                        alt="{{ $company->name }}"
                                        class="img-fluid"
                                    >
                                @else
                                    <img
                                        src="{{ asset('default-logo.png') }}"
                                        alt="Default Logo"
                                        class="img-fluid"
                                    >
                                @endif
                            </div>
                        </a>
                        <div class="card-body">
                            <h5 class="card-title">{{ $company->name }}</h5>
                            <p class="card-text">
                                <strong>Ngành:</strong> {{ $company->industry ?? 'N/A' }}<br>
                                <strong>Nhân viên:</strong> {{ $company->employee_count ?? 'N/A' }}<br>
                            </p>
                            @if ($company->website)
                                <a href="{{ $company->website }}" target="_blank" class="btn btn-primary">Website</a>
                            @endif
                        </div>
                    </div>
                </div>
            @endForeach
        </div>

        <div class="d-flex justify-content-center">
            {{ $companies->links() }}
        </div>
    @else
        <p>Không có công ty nào để hiển thị.</p>
    @endif
</div>
@endsection
