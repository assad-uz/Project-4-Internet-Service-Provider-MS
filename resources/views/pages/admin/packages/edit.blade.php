@extends('layouts.app')

@section('title', 'Edit Package')

@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Admin / Packages /</span> Edit
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
        <h5 class="card-header">Edit Package: {{ $package->package_name }} (Code: {{ $package->package_code }})</h5>
        <div class="card-body">

            {{-- Form Action uses PUT method for update, targeting the specific package ID --}}
            <form action="{{ route('packages.update', $package->id) }}" method="POST">
                @csrf
                @method('PUT') {{-- Required for Laravel to handle update request --}}

                {{-- Package Code --}}
                <div class="mb-3">
                    <label for="package_code" class="form-label">Package Code</label>
                    <input type="text" class="form-control" id="package_code" name="package_code"
                        value="{{ old('package_code', $package->package_code) }}" required placeholder="e.g., 101 or FIBER-100">
                    @error('package_code')
                    <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Package Name --}}
                <div class="mb-3">
                    <label for="package_name" class="form-label">Package Name</label>
                    <input type="text" class="form-control" id="package_name" name="package_name"
                        value="{{ old('package_name', $package->package_name) }}" required placeholder="e.g., Bronze Pack">
                    @error('package_name')
                    <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Speed --}}
                <div class="mb-3">
                    <label for="speed" class="form-label">Speed (Mbps)</label>
                    <input type="text" class="form-control" id="speed" name="speed"
                        value="{{ old('speed', $package->speed) }}" required placeholder="e.g., 50 Mbps ps">
                    @error('speed')
                    <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Price --}}
                <div class="mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input type="number" step="0.01" class="form-control" id="price" name="price"
                        value="{{ old('price', $package->price) }}" required placeholder="e.g., 999.50">
                    @error('price')
                    <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mt-4 pt-2">
                    <button type="submit" class="btn btn-success me-2">
                        <i class="bx bx-refresh me-1"></i> Update Package
                    </button>
                    <a href="{{ route('packages.index') }}" class="btn btn-secondary">
                        <i class="bx bx-arrow-back me-1"></i> Cancel & Back to List
                    </a>
                </div>
            </form>
        </div>
    </div>


</div>
@endsection