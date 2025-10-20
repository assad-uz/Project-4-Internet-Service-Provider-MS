@extends('layouts.app')

@section('title', 'Package List')

@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Admin /</span> Packages
    </h4>

    {{-- Success/Error Messages --}}
    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    {{-- Package List Card --}}
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Package List ({{ $packages->total() }} Total)</h5>
            <a href="{{ route('packages.create') }}" class="btn btn-primary">
                <i class="bx bx-plus me-1"></i> Create New Package
            </a>
        </div>

        <div class="table-responsive text-nowrap">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th>Package Code</th>
                        <th>Package Name</th>
                        <th>Speed</th>
                        <th>Price (BDT)</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse ($packages as $package)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td><i class="fab fa-bootstrap fa-lg text-primary me-3"></i> <strong>{{ $package->package_code }}</strong></td>
                        <td>{{ $package->package_name }}</td>
                        <td><span class="badge bg-label-info me-1">{{ $package->speed }}</span></td>
                        <td>{{ number_format($package->price, 2) }}</td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center">
                                {{-- Edit Button (Icon) --}}
                                <a href="{{ route('packages.edit', $package->id) }}"
                                    class="btn btn-warning btn-sm me-2"
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Package">
                                    <i class="bx bx-edit text-dark"></i>
                                </a>

                                {{-- Delete Form (Icon) --}}
                                <form action="{{ route('packages.destroy', $package->id) }}" method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete this package?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="btn btn-danger btn-sm"
                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Delete Package">
                                        <i class="bx bx-trash text-white"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center">No packages found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination Links --}}
        <div class="card-footer d-flex justify-content-center">
            {{ $packages->links() }}
        </div>
    </div>


</div>
@endsection