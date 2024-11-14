@extends('layouts.admin')

@section('title', 'Edit User')

@section('content')
<div class="container">
    <h1>Edit User</h1>
    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
        </div>
        <div class="mb-3">
            <label for="role" class="form-label">Role</label>
            <input type="text" class="form-control" id="role" name="role" value="{{ $user->role }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
    <form action="{{ route('admin.users.banned', $user->id) }}" method="POST" style="margin-top: 10px;">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="note" class="form-label">Note</label>
            <textarea class="form-control" id="note" name="note" rows="3" required></textarea>
        </div>
        <button type="submit" class="btn btn-danger">Ban</button>
    </form>
    <form action="{{ route('admin.users.unbanned', $user->id) }}" method="POST" style="margin-top: 10px;">
        @csrf
        @method('PUT')
        <button type="submit" class="btn btn-success">Unban</button>
    </form>
</div>
@endsection
