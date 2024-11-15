@extends('layouts.job-seeker')

@section('content')
<div class="container">
    <h1 class="mb-4">Danh sách công ty</h1>

    @if ($companies->count())
        <div class="row">
            @foreach ($companies as $company)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        @if ($company->logo)
                            <img 
                                src="{{ asset($company->logo) }}" 
                                alt="{{ $company->name }}" 
                                class="card-img-top" 
                                style="height: 200px; object-fit: contain;"
                            >
                        @else
                            <img 
                                src="{{ asset('default-logo.png') }}" 
                                alt="Default Logo" 
                                class="card-img-top" 
                                style="height: 200px; object-fit: contain;"
                            >
                        @endif

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
            @endforeach
        </div>

        <div class="d-flex justify-content-center">
            {{ $companies->links() }}
        </div>
    @else
        <p>Không có công ty nào để hiển thị.</p>
    @endif
</div>
@endsection
