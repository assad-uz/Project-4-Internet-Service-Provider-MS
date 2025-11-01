@extends('layouts.app')

@section('title', 'Distribution Boxes')
@section('content')
<div class="container mt-4">
    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">Distribution Box Management</h3>
        <a href="{{ route('distribution_boxes.create') }}" class="btn btn-primary">
            + Create New Box
        </a>
    </div>

    <table class="table table-bordered table-striped align-middle">
        <thead class="table-dark">
            <tr class="text-center">
                <th style="width: 5%">#</th>
                <th style="width: 15%">Box Code</th>
                <th style="width: 30%">Name</th>
                <th style="width: 20%">Area</th>
                <th style="width: 15%">Created At</th>
                <th style="width: 15%">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($distributionBoxes as $box)
            <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td>{{ $box->box_code }}</td>
                <td>{{ $box->name ?? 'N/A' }}</td>
                <td>{{ $box->area->name ?? 'Deleted Area' }}</td>
                <td>{{ $box->created_at->format('d M Y') }}</td>
                <td class="text-center">
                    <a href="{{ route('distribution_boxes.edit', $box->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('distribution_boxes.destroy', $box->id) }}" method="POST"
                        class="d-inline-block"
                        onsubmit="return confirm('Are you sure you want to delete this box?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
            @if($distributionBoxes->isEmpty())
            <tr>
                <td colspan="6" class="text-center text-muted">No distribution boxes found.</td>
            </tr>
            @endif
        </tbody>
    </table>
    <div class="d-flex justify-content-center mt-3">
        {{ $distributionBoxes->links() }}
    </div>
</div>
@endsection