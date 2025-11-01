@extends('layouts.app')

@section('title', 'Customers List')
@section('content')
<div class="container mt-4">
    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">Customer Management</h3>
        <a href="{{ route('customers.create') }}" class="btn btn-primary">
            + Add New Customer
        </a>
    </div>

    <table class="table table-bordered table-striped align-middle">
        <thead class="table-dark">
            <tr class="text-center">
                <th style="width: 5%">#</th>
                <th style="width: 20%">Name & Phone</th>
                <th style="width: 25%">Address</th>
                <th style="width: 15%">Type / Area</th>
                <th style="width: 10%">Status</th>
                <th style="width: 10%">Created</th>
                <th style="width: 15%">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($customers as $customer)
            <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td>
                    <strong>{{ $customer->name }}</strong><br>
                    <small class="text-muted">{{ $customer->phone }}</small>
                </td>
                <td>{{ Str::limit($customer->address, 50) }}</td>
                <td>
                    <span class="badge bg-info">{{ $customer->customerType->name ?? 'N/A' }}</span><br>
                    <small class="text-muted">{{ $customer->area->name ?? 'N/A' }}</small>
                </td>
                <td class="text-center">
                    @php
                        $statusClass = [
                            'active' => 'success',
                            'inactive' => 'secondary',
                            'suspended' => 'danger'
                        ][$customer->status] ?? 'dark';
                    @endphp
                    <span class="badge bg-{{ $statusClass }}">{{ ucfirst($customer->status) }}</span>
                </td>
                <td>{{ $customer->created_at->format('d M Y') }}</td>
                <td class="text-center">
                    <a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('customers.destroy', $customer->id) }}" method="POST"
                        class="d-inline-block"
                        onsubmit="return confirm('Are you sure you want to delete this customer?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
            @if($customers->isEmpty())
            <tr>
                <td colspan="7" class="text-center text-muted">No customers found.</td>
            </tr>
            @endif
        </tbody>
    </table>
    <div class="d-flex justify-content-center mt-3">
        {{ $customers->links() }}
    </div>
</div>
@endsection