@extends('layouts.app')

@section('title', 'Edit Billing Record')
@section('content')
<div class="container mt-5">
<div class="card shadow-lg">
    <div class="card-header bg-warning text-dark">
        <h4 class="mb-0">Edit Billing Record ({{ \Carbon\Carbon::parse($billing->billing_month)->format('F, Y') }})</h4>
    </div>
    <div class="card-body">
        @if ($errors->any())
            <div class="alert alert-danger"><ul>@foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach</ul></div>
        @endif

        <form action="{{ route('billings.update', $billing->id) }}" method="POST">
            @csrf
            @method('PUT') 

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="connection_id" class="form-label">Connection (Customer) <span class="text-danger">*</span></label>
                    <select class="form-select" id="connection_id" name="connection_id" required>
                        <option value="" disabled>Select Connection</option>
                        @foreach($connections as $conn)
                            <option value="{{ $conn->id }}" 
                                {{ old('connection_id', $billing->connection_id) == $conn->id ? 'selected' : '' }}>
                                {{ $conn->username }} ({{ $conn->customer->name ?? 'N/A' }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="billing_month" class="form-label">Billing Month <span class="text-danger">*</span></label>
                    <input type="date" class="form-control" id="billing_month" name="billing_month" 
                           value="{{ old('billing_month', $billing->billing_month) }}" required>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="amount" class="form-label">Total Amount (Before Discount) <span class="text-danger">*</span></label>
                    <input type="number" step="0.01" class="form-control" id="amount" name="amount" 
                           value="{{ old('amount', $billing->amount) }}" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="discount" class="form-label">Discount Amount (BDT)</label>
                    <input type="number" step="0.01" class="form-control" id="discount" name="discount" 
                           value="{{ old('discount', $billing->discount) }}">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="due_date" class="form-label">Due Date <span class="text-danger">*</span></label>
                    <input type="date" class="form-control" id="due_date" name="due_date" 
                           value="{{ old('due_date', $billing->due_date) }}" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                    <select class="form-select" id="status" name="status" required>
                        @foreach($statuses as $s)
                            <option value="{{ $s }}" 
                                {{ old('status', $billing->status) == $s ? 'selected' : '' }}>
                                {{ ucfirst(str_replace('_', ' ', $s)) }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('billings.index') }}" class="btn btn-secondary">Back to list</a>
                <button type="submit" class="btn btn-warning">Update Bill</button>
            </div>
        </form>
    </div>
</div>
</div>
@endsection