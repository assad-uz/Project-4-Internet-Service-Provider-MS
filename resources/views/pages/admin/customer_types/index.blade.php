@extends('layouts.app')

@section('title', 'Customer Types')
@section('content')
<div class="container mt-4">
    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">Customer Types Management</h3>
        <a href="{{ route('customer_types.create') }}" class="btn btn-primary">
            + Create New Type
        </a>
    </div>

    <table class="table table-bordered table-striped align-middle">
        <thead class="table-dark">
            <tr class="text-center">
                <th style="width: 5%">#</th>
                <th style="width: 65%">Name</th>
                <th style="width: 15%">Created At</th>
                <th style="width: 15%">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($customerTypes as $type)
            <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td>{{ $type->name }}</td>
                <td>{{ $type->created_at->format('d M Y') }}</td>
                <td class="text-center">
                    <a href="{{ route('customer_types.edit', $type->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('customer_types.destroy', $type->id) }}" method="POST"
                        class="d-inline-block"
                        onsubmit="return confirm('Are you sure you want to delete this type?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
            @if($customerTypes->isEmpty())
            <tr>
                <td colspan="4" class="text-center text-muted">No customer types found.</td>
            </tr>
            @endif
        </tbody>
    </table>
    <div class="d-flex justify-content-center mt-3">
        {{ $customerTypes->links() }}
    </div>
</div>
@endsection