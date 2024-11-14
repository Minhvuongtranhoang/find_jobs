@extends('layouts.admin')

@section('content')
<div class="container">
  <h1>Reports</h1>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Description</th>
        <th>Date</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      @foreach($reports as $report)
      <tr>
        <td>{{ $report->id }}</td>
        <td>{{ $report->title }}</td>
        <td>{{ $report->description }}</td>
        <td>{{ $report->created_at->format('d-m-Y') }}</td>
        <td>
          <a href="{{ route('admin.reports.show', $report->id) }}" class="btn btn-info">View</a>
          <a href="{{ route('admin.reports.edit', $report->id) }}" class="btn btn-warning">Edit</a>
          <form action="{{ route('admin.reports.destroy', $report->id) }}" method="POST" style="display:inline-block;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
