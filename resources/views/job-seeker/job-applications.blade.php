@extends('layouts.job-seeker')

@section('title', 'Công việc đã ứng tuyển')

@section('content')
  <section class="py-5 bg-light">

    <div class="container">
        <h3 style="margin-bottom: 20px"><span style="color: #3C6E71; font-weight: bold;">Danh sách công việc đã ứng tuyển</span></h3>
        @if($applications->isEmpty())
            <div class="alert alert-warning">
                Bạn chưa ứng tuyển công việc nào.
            </div>
        @else
        <div class="card-body p-0">
          <div class="table-responsive">
            <table class="table table-hover table-nowrap">
              <thead>
                  <tr>
                      <th>Công ty</th>
                      <th>Vị trí ứng tuyển</th>
                      <th>Ngày ứng tuyển</th>
                      <th>Thời gian</th>
                      <th>Tình trạng</th>
                  </tr>
              </thead>
              <tbody>
                  @foreach($applications as $application)
                      <tr onclick="window.location='{{ route('detail-job', $application->job->id) }}';" style="cursor: pointer;">
                          <td>{{ ($application->job->company)->name ?? 'Chưa cập nhật'}}</td>
                          <td>{{ $application->job->title}} </td>
                          <td>{{ $application->created_at->format('d-m-Y') }}</td>
                          <td>{{ $application->created_at->format('h:m')}}</td>
                          <td>
                            <span
                                  @class([
                                      'status-badge status-approved' => $application->status === 'approved',
                                      'status-badge status-rejected' => $application->status === 'rejected',
                                      'status-badge status-pending' => $application->status === 'pending',
                                  ])>
                              {{ ucfirst($application->status) }}
                            </span>
                          </td>
                      </tr>
                  @endForeach
              </tbody>
            </table>

        </div>
      </div>
        @endif
    </div>
  </section>
@push('styles')
<link rel="styleSheet" href="{{ asset('css/dropdown-menu.css') }}">
@endPush

@endSection
