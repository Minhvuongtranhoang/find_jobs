@extends('layouts.job-seeker')

@section('title', 'Công ty Hàng đầu')

@section('content')
<div class="container py-5">
    <h1 class="text-center mb-4">Công ty Hàng đầu</h1>
    <p class="text-center mb-5">Danh sách các công ty có số lượng nhân viên lớn nhất.</p>
    <div class="row">
        @foreach ($companies as $company)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow">
                    @if($company->logo)
                        <img src="{{ asset($company->logo) }}" class="card-img-top" alt="{{ $company->name }}">
                    @else
                        <img src="https://via.placeholder.com/150" class="card-img-top" alt="{{ $company->name }}">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $company->name }}</h5>
                        <p class="card-text">
                            <strong>Ngành:</strong> {{ $company->industry ?? 'Không xác định' }}<br>
                            <strong>Nhân viên:</strong> {{ $company->employee_count ?? 'N/A' }}
                        </p>
                        @if($company->website)
                            <a href="{{ $company->website }}" class="btn btn-primary" target="_blank">Xem Website</a>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
