@extends('layouts.app')

@section('title', 'Create Billing Record')
@section('content')
<div class="container mt-5">
<div class="card shadow-lg">
    <div class="card-header bg-success text-white">
        <h4 class="mb-0">Create New Billing Record</h4>
    </div>
    <div class="card-body">
        @if ($errors->any())
            <div class="alert alert-danger"><ul>@foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach</ul></div>
        @endif

        <form action="{{ route('billings.store') }}" method="POST">
            @csrf

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="connection_id" class="form-label">Connection (Customer) <span class="text-danger">*</span></label>
                    <select class="form-select" id="connection_id" name="connection_id" required>
                        <option value="" disabled selected>Select Connection</option>
                        @foreach($connections as $conn)
                            <option value="{{ $conn->id }}" {{ old('connection_id') == $conn->id ? 'selected' : '' }}>
                                {{ $conn->username }} ({{ $conn->customer->name ?? 'N/A' }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="billing_month" class="form-label">Billing Month <span class="text-danger">*</span></label>
                    <input type="date" class="form-control" id="billing_month" name="billing_month" 
                           value="{{ old('billing_month', date('Y-m-01')) }}" required>
                    <small class="text-muted">Set to the 1st day of the billing month.</small>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="amount" class="form-label">Total Amount (Before Discount) <span class="text-danger">*</span></label>
                    <input type="number" step="0.01" class="form-control" id="amount" name="amount" value="{{ old('amount') }}" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="discount" class="form-label">Discount Amount (BDT)</label>
                    <input type="number" step="0.01" class="form-control" id="discount" name="discount" value="{{ old('discount', 0.00) }}">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="due_date" class="form-label">Due Date <span class="text-danger">*</span></label>
                    <input type="date" class="form-control" id="due_date" name="due_date" value="{{ old('due_date', date('Y-m-10')) }}" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                    <select class="form-select" id="status" name="status" required>
                        @foreach($statuses as $s)
                            <option value="{{ $s }}" {{ old('status') == $s ? 'selected' : '' }}>
                                {{ ucfirst(str_replace('_', ' ', $s)) }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('billings.index') }}" class="btn btn-secondary">Back to list</a>
                <button type="submit" class="btn btn-success">Generate Bill</button>
            </div>
        </form>
    </div>
</div>
</div>
@endsection