@extends('layouts.app')

@section('title', 'Create Package')

@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Admin / Packages /</span> Create
    </h4>

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

    {{-- Form Card --}}
    <div class="card mb-4">
        <h5 class="card-header">New Internet Package Information</h5>
        <div class="card-body">
            <form action="{{ route('packages.store') }}" method="POST">
                @csrf

                {{-- Package Code --}}
                <div class="mb-3">
                    <label for="package_code" class="form-label">Package Code</label>
                    <input type="text" class="form-control" id="package_code" name="package_code"
                        value="{{ old('package_code') }}" required placeholder="e.g., 101 or FIBER-100">
                    @error('package_code')
                    <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Package Name --}}
                <div class="mb-3">
                    <label for="package_name" class="form-label">Package Name</label>
                    <input type="text" class="form-control" id="package_name" name="package_name"
                        value="{{ old('package_name') }}" required placeholder="e.g., Bronze Pack">
                    @error('package_name')
                    <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Speed --}}
                <div class="mb-3">
                    <label for="speed" class="form-label">Speed (Mbps)</label>
                    <input type="text" class="form-control" id="speed" name="speed"
                        value="{{ old('speed') }}" required placeholder="e.g., 50 Mbps ps">
                    @error('speed')
                    <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Price --}}
                <div class="mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input type="number" step="0.01" class="form-control" id="price" name="price"
                        value="{{ old('price') }}" required placeholder="e.g., 999.50">
                    @error('price')
                    <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mt-4 pt-2">
                    <button type="submit" class="btn btn-success me-2">
                        <i class="bx bx-save me-1"></i> Save Package
                    </button>
                    <a href="{{ route('packages.index') }}" class="btn btn-secondary">
                        <i class="bx bx-arrow-back me-1"></i> Back to List
                    </a>
                </div>
            </form>
        </div>
    </div>


</div>
@endsection