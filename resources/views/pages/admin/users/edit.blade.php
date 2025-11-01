@extends('layouts.app')

@section('content')

<div class="container mt-5">
<div class="card shadow-lg">
<div class="card-header bg-warning text-dark">
<h4 class="mb-0">Edit user: {{ $user->name }}</h4>
</div>
<div class="card-body">

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') 

        <div class="mb-3">
            <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Leave blank to keep current password">
            <small class="form-text text-muted">Leave blank to keep current password.</small>
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $user->phone) }}">
        </div>

        <div class="mb-3">
            <label for="role" class="form-label">Role <span class="text-danger">*</span></label>
            <select class="form-control" id="role" name="role" required>
                <option value="technician" {{ old('role', $user->role) == 'technician' ? 'selected' : '' }}>Technician</option>
                <option value="manager" {{ old('role', $user->role) == 'manager' ? 'selected' : '' }}>Manager</option>
                <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label d-block">Current Avatar</label>
            @if ($user->avatar_url)
                <img src="{{ $user->avatar_url }}" alt="Current Avatar" class="img-thumbnail mb-2" style="width: 100px; height: 100px; object-fit: cover;">
            @else
                <p class="text-muted">No avatar uploaded.</p>
            @endif
            
            <label for="avatar" class="form-label">Upload New Avatar</label>
            <input type="file" class="form-control" id="avatar" name="avatar" accept="image/*">
            <small class="form-text text-muted">Upload a new image to replace the current one.</small>
        </div>
        
        <hr>

        <div class="d-flex justify-content-between">
            <a href="{{ route('users.index') }}" class="btn btn-secondary">Back to List</a>
            <button type="submit" class="btn btn-warning">Update</button>
        </div>
    </form>
</div>
</div>
</div>
@endsection