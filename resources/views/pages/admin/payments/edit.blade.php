@extends('layouts.app')

@section('title', 'Edit Payment Record')
@section('content')
<div class="container mt-5">
<div class="card shadow-lg">
    <div class="card-header bg-warning text-dark">
        <h4 class="mb-0">Edit Payment Record (ID: {{ $payment->id }})</h4>
        <small class="text-muted">Bill Month: {{ \Carbon\Carbon::parse($payment->billing->billing_month ?? null)->format('F, Y') }}</small>
    </div>
    <div class="card-body">
        @if ($errors->any())
            <div class="alert alert-danger"><ul>@foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach</ul></div>
        @endif

        <form action="{{ route('payments.update', $payment->id) }}" method="POST">
            @csrf
            @method('PUT') 

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="billing_id" class="form-label">Select Bill to Pay <span class="text-danger">*</span></label>
                    <select class="form-select" id="billing_id" name="billing_id" required>
                        <option value="" disabled>Select Bill</option>
                        @foreach($billings as $bill)
                            <option value="{{ $bill->id }}" 
                                {{ old('billing_id', $payment->billing_id) == $bill->id ? 'selected' : '' }}>
                                {{ $bill->customer->name ?? 'N/A' }} ({{ \Carbon\Carbon::parse($bill->billing_month)->format('M, Y') }}) - Due: ৳{{ number_format($bill->amount - $bill->discount, 2) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="amount" class="form-label">Payment Amount (BDT) <span class="text-danger">*</span></label>
                    <input type="number" step="0.01" class="form-control" id="amount" name="amount" 
                           value="{{ old('amount', $payment->amount) }}" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="payment_method" class="form-label">Payment Method <span class="text-danger">*</span></label>
                    <select class="form-select" id="payment_method" name="payment_method" required>
                        @foreach($paymentMethods as $method)
                            <option value="{{ $method }}" 
                                {{ old('payment_method', $payment->payment_method) == $method ? 'selected' : '' }}>
                                {{ ucfirst($method) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="transaction_id" class="form-label">Transaction ID / Reference (Optional)</label>
                    <input type="text" class="form-control" id="transaction_id" name="transaction_id" 
                           value="{{ old('transaction_id', $payment->transaction_id) }}">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="collected_by" class="form-label">Collected By (Collector/Agent)</label>
                    <select class="form-select" id="collected_by" name="collected_by">
                        <option value="" {{ old('collected_by', $payment->collected_by) == null ? 'selected' : '' }}>Self-Collected / Not Applicable</option>
                        @foreach($collectors as $collector)
                            <option value="{{ $collector->id }}" 
                                {{ old('collected_by', $payment->collected_by) == $collector->id ? 'selected' : '' }}>
                                {{ $collector->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="payment_date" class="form-label">Payment Date</label>
                    <input type="date" class="form-control" id="payment_date" name="payment_date" 
                           value="{{ old('payment_date', \Carbon\Carbon::parse($payment->payment_date)->format('Y-m-d')) }}">
                </div>
            </div>

            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('payments.index') }}" class="btn btn-secondary">Back to list</a>
                <button type="submit" class="btn btn-warning">Update Payment</button>
            </div>
        </form>
    </div>
</div>
</div>
@endsection