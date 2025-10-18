@extends('layouts.app')

@section('content')

<div class="container mt-5">
<div class="card shadow-lg">
<div class="card-header bg-warning text-dark">
<h4 class="mb-0">Edit user: {{ $user->name }}</h4>
</div>
<div class="card-body">

        {{-- Validation Errors --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Form for updating user data --}}
        {{-- Action points to users.update route with user ID, and method is PUT --}}
        <form action="{{ route('users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT') 

            {{-- Name Field --}}
            <div class="mb-3">
                <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                {{-- Prefilling old data from database or previous attempt --}}
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>
            </div>

            {{-- Email Field --}}
            <div class="mb-3">
                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
            </div>

            {{-- Password Field (Optional on Edit) --}}
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Leave blank to keep current password">
                <small class="form-text text-muted">Leave blank to keep current password.</small>
            </div>

            {{-- Address Field --}}
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <textarea class="form-control" id="address" name="address">{{ old('address', $user->address) }}</textarea>
            </div>
            
            {{-- Phone Field --}}
            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $user->phone) }}">
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