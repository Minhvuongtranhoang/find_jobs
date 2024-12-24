<div class="list-group">
  @foreach($applications as $application)
      <a href="{{ route('detail-job', $application->job->id) }}" class="list-group-item list-group-item-action">
          <div class="d-flex w-100 justify-content-between">
              <h5 class="mb-1">{{ $application->job->title }}</h5>
              <small>{{ $application->created_at->format('h:m, d/m/Y') }}</small>
          </div>
          <p class="mb-1 text-muted">
              Công ty: {{ optional($application->job->company)->name ?? 'Chưa cập nhật' }}
          </p>
          <p class="mb-1">
              Trạng thái ứng tuyển:
              <span class="badge bg-{{ $application->status == 'approved' ? 'success' : ($application->status == 'rejected' ? 'danger' : 'secondary') }}">
                  {{ ucfirst($application->status) }}
              </span>
          </p>
      </a>
  @endForeach
</div>
