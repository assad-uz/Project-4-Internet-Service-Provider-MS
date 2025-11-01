@extends('layouts.app')

@section('title', 'Packages List')
@section('content')
<div class="container mt-4">
    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">Package Management</h3>
        <a href="{{ route('packages.create') }}" class="btn btn-primary">
            + Create New Package
        </a>
    </div>

    <table class="table table-bordered table-striped align-middle">
        <thead class="table-dark">
            <tr class="text-center">
                <th style="width: 5%">#</th>
                <th style="width: 20%">Code</th>
                <th style="width: 30%">Package Name</th>
                <th style="width: 15%">Speed (Mbps)</th>
                <th style="width: 15%">Price (BDT)</th>
                <th style="width: 15%">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($packages as $package)
            <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td>{{ $package->package_code ?? 'N/A' }}</td>
                <td>{{ $package->package_name }}</td>
                <td class="text-center">{{ $package->speed }}</td>
                <td class="text-right">৳ {{ number_format($package->price, 2) }}</td>
                <td class="text-center">
                    <a href="{{ route('packages.edit', $package->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('packages.destroy', $package->id) }}" method="POST"
                        class="d-inline-block"
                        onsubmit="return confirm('Are you sure you want to delete this package?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
            @if($packages->isEmpty())
            <tr>
                <td colspan="6" class="text-center text-muted">No packages found.</td>
            </tr>
            @endif
        </tbody>
    </table>
    <div class="d-flex justify-content-center mt-3">
        {{ $packages->links() }}
    </div>
</div>
@endsection