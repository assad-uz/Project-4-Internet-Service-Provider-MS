@extends('layouts.app')

@section('title', 'Create Package')
@section('content')
<div class="container mt-5">
<div class="card shadow-lg">
    <div class="card-header bg-success text-white">
        <h4 class="mb-0">Create New Package</h4>
    </div>
    <div class="card-body">
        @if ($errors->any())
            <div class="alert alert-danger"><ul>@foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach</ul></div>
        @endif

        <form action="{{ route('packages.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="package_code" class="form-label">Package Code (Optional)</label>
                <input type="text" class="form-control" id="package_code" name="package_code" value="{{ old('package_code') }}">
            </div>
            
            <div class="mb-3">
                <label for="package_name" class="form-label">Package Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="package_name" name="package_name" value="{{ old('package_name') }}" required>
            </div>

            <div class="mb-3">
                <label for="speed" class="form-label">Speed (in Mbps) <span class="text-danger">*</span></label>
                <input type="number" class="form-control" id="speed" name="speed" value="{{ old('speed') }}" required>
            </div>
            
            <div class="mb-3">
                <label for="price" class="form-label">Price (BDT) <span class="text-danger">*</span></label>
                <input type="number" step="0.01" class="form-control" id="price" name="price" value="{{ old('price') }}" required>
            </div>

            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('packages.index') }}" class="btn btn-secondary">Back to list</a>
                <button type="submit" class="btn btn-success">Save Package</button>
            </div>
        </form>
    </div>
</div>
</div>
@endsection