@extends('layouts.app')

@section('title', 'Payment Records')
@section('content')
<div class="container mt-4">
    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">Payment Records</h3>
        <a href="{{ route('payments.create') }}" class="btn btn-primary">
            + Record New Payment
        </a>
    </div>

    <table class="table table-bordered table-striped align-middle">
        <thead class="table-dark">
            <tr class="text-center">
                <th style="width: 5%">#</th>
                <th style="width: 15%">Payment Date</th>
                <th style="width: 20%">Customer (Bill Month)</th>
                <th style="width: 15%">Amount Paid</th>
                <th style="width: 15%">Method / Txn ID</th>
                <th style="width: 15%">Collected By</th>
                <th style="width: 15%">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($payments as $payment)
            <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td class="text-center">{{ \Carbon\Carbon::parse($payment->payment_date)->format('Y-m-d') }}</td>
                <td>
                    <strong>{{ $payment->customer->name ?? 'N/A' }}</strong><br>
                    <small class="text-muted">Bill: {{ \Carbon\Carbon::parse($payment->billing->billing_month ?? null)->format('F, Y') }}</small>
                </td>
                <td class="text-right">৳ {{ number_format($payment->amount, 2) }}</td>
                <td class="text-center">
                    <span class="badge bg-info">{{ ucfirst($payment->payment_method) }}</span>
                    <br>
                    <small class="text-muted">{{ $payment->transaction_id }}</small>
                </td>
                <td>
                    {{ $payment->collector->name ?? 'N/A' }}
                </td>
                <td class="text-center">
                    <a href="{{ route('payments.edit', $payment->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('payments.destroy', $payment->id) }}" method="POST"
                        class="d-inline-block"
                        onsubmit="return confirm('WARNING: Are you sure you want to delete this payment? It will recalculate the bill status.');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
            @if($payments->isEmpty())
            <tr>
                <td colspan="7" class="text-center text-muted">No payment records found.</td>
            </tr>
            @endif
        </tbody>
    </table>
    <div class="d-flex justify-content-center mt-3">
        {{ $payments->links() }}
    </div>
</div>
@endsection