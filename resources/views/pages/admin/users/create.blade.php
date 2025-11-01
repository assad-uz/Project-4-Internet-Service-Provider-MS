@extends('layouts.app')

@section('content')

<div class="container mt-5">
<div class="card shadow-lg">
<div class="card-header bg-success text-white">
<h4 class="mb-0">Create New User</h4>
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

    <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') }}">
        </div>
        
        <div class="mb-3">
            <label for="role" class="form-label">Role <span class="text-danger">*</span></label>
            <select class="form-control" id="role" name="role" required>
                <option value="technician" {{ old('role') == 'technician' ? 'selected' : '' }}>Technician</option>
                <option value="manager" {{ old('role') == 'manager' ? 'selected' : '' }}>Manager</option>
                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
            </select>
        </div>
        
        <div class="mb-3">
            <label for="avatar" class="form-label">Avatar (Profile Picture)</label>
            <input type="file" class="form-control" id="avatar" name="avatar" accept="image/*">
            <small class="form-text text-muted">Max 2MB. Allowed formats: jpeg, png, jpg, gif.</small>
        </div>

        <div class="d-flex justify-content-between mt-4">
            <a href="{{ route('users.index') }}" class="btn btn-secondary">Back to list</a>
            <button type="submit" class="btn btn-success">Save user</button>
        </div>
    </form>
</div>
</div>
</div>
@endsection