@extends('layouts.app')

@section('title', 'Billing List')
@section('content')
<div class="container mt-4">
    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">Billing Management</h3>
        <a href="{{ route('billings.create') }}" class="btn btn-primary">
            + Create New Bill
        </a>
    </div>

    <table class="table table-bordered table-striped align-middle">
        <thead class="table-dark">
            <tr class="text-center">
                <th style="width: 5%">#</th>
                <th style="width: 15%">Billing Month</th>
                <th style="width: 20%">Customer (Username)</th>
                <th style="width: 15%">Package</th>
                <th style="width: 10%">Amount</th>
                <th style="width: 10%">Due Date</th>
                <th style="width: 10%">Status</th>
                <th style="width: 15%">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($billings as $bill)
            <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td class="text-center">{{ \Carbon\Carbon::parse($bill->billing_month)->format('F, Y') }}</td>
                <td>
                    <strong>{{ $bill->customer->name ?? 'N/A' }}</strong><br>
                    <small class="text-muted">({{ $bill->connection->username ?? 'N/A' }})</small>
                </td>
                <td>{{ $bill->package->package_name ?? 'N/A' }}</td>
                <td class="text-right">৳ {{ number_format($bill->amount - $bill->discount, 2) }}</td>
                <td class="text-center">{{ $bill->due_date }}</td>
                <td class="text-center">
                    @php
                        $statusClass = [
                            'unpaid' => 'danger',
                            'paid' => 'success',
                            'partially_paid' => 'warning',
                            'cancelled' => 'secondary'
                        ][$bill->status] ?? 'dark';
                    @endphp
                    <span class="badge bg-{{ $statusClass }}">{{ ucfirst(str_replace('_', ' ', $bill->status)) }}</span>
                </td>
                <td class="text-center">
                    <a href="{{ route('billings.edit', $bill->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('billings.destroy', $bill->id) }}" method="POST"
                        class="d-inline-block"
                        onsubmit="return confirm('Are you sure you want to delete this bill?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
            @if($billings->isEmpty())
            <tr>
                <td colspan="8" class="text-center text-muted">No billing records found.</td>
            </tr>
            @endif
        </tbody>
    </table>
    <div class="d-flex justify-content-center mt-3">
        {{ $billings->links() }}
    </div>
</div>
@endsection