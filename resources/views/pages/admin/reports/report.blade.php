{{-- resources/views/pages/admin/report.blade.php --}}
@extends('layouts.app')

@section('title', 'Reports')

@section('content')

<div class="container py-4">
<!-- Page header -->
<div class="d-flex justify-content-between align-items-center mb-4">
<div>
<h3 class="mb-0">Reports</h3>
<small class="text-muted">Overview / Dynamic Subscriptions Report</small>
</div>
<nav aria-label="breadcrumb">
<ol class="breadcrumb mb-0">
<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
<li class="breadcrumb-item active" aria-current="page">Reports</li>
</ol>
</nav>
</div>

<!-- Filters (Dynamic) -->
<div class="card mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('reports.index') }}" class="row g-3">
            
            {{-- From Date Filter --}}
            <div class="col-md-3">
                <label for="from_date" class="form-label">From Date</label>
                <input type="date" name="from_date" id="from_date" class="form-control" value="{{ $startDate ?? date('Y-m-01') }}">
            </div>
            
            {{-- To Date Filter --}}
            <div class="col-md-3">
                <label for="to_date" class="form-label">To Date</label>
                <input type="date" name="to_date" id="to_date" class="form-control" value="{{ $endDate ?? date('Y-m-d') }}">
            </div>
            
            {{-- Package Filter (Dynamic Data) --}}
            <div class="col-md-3">
                <label for="package_id" class="form-label">Package</label>
                <select name="package_id" id="package_id" class="form-select">
                    <option value="">All Packages</option>
                    {{-- প্যাকেজ ডেটা কন্ট্রোলার থেকে আসছে --}}
                    @foreach($packages as $package)
                        <option value="{{ $package->id }}" 
                            {{ (string)$selectedPackageId === (string)$package->id ? 'selected' : '' }}>
                            {{ $package->package_name }} (৳{{ number_format($package->price) }})
                        </option>
                    @endforeach
                </select>
            </div>
            
            <div class="col-md-3 d-flex align-items-end gap-2">
                {{-- Apply Button --}}
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-filter me-1"></i> Apply Filter
                </button>
                
                {{-- Reset Button --}}
                <a href="{{ route('reports.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-redo me-1"></i> Reset
                </a>
                
                {{-- Export Buttons (Placeholder for future development) --}}
                <div class="ms-auto d-flex gap-1">
                    <button type="button" class="btn btn-sm btn-outline-success" disabled title="Not implemented yet">Export CSV</button>
                    <button type="button" class="btn btn-sm btn-outline-danger" disabled title="Not implemented yet">Export PDF</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Summary cards (Dynamic) -->
<div class="row g-3 mb-4">
    
    {{-- Total Users --}}
    <div class="col-sm-6 col-md-3">
        <div class="card text-center shadow-sm">
            <div class="card-body">
                <h6 class="text-muted">Total Users</h6>
                <h3 class="mb-0">{{ number_format($totalCustomers) }}</h3>
                <small class="text-success">System Total</small>
            </div>
        </div>
    </div>

    {{-- Active Users --}}
    <div class="col-sm-6 col-md-3">
        <div class="card text-center shadow-sm">
            <div class="card-body">
                <h6 class="text-muted">Active Users</h6>
                <h3 class="mb-0 text-success">{{ number_format($activeCustomers) }}</h3>
                <small class="text-muted">Current Active Connections</small>
            </div>
        </div>
    </div>

    {{-- Pending Payments --}}
    <div class="col-sm-6 col-md-3">
        <div class="card text-center shadow-sm">
            <div class="card-body">
                <h6 class="text-muted">Pending Payments (Bills)</h6>
                <h3 class="mb-0 text-warning">{{ number_format($totalPendingBillsCount) }}</h3>
                <small class="text-muted">Total pending amount: ৳{{ number_format($totalPendingAmount, 2) }}</small>
            </div>
        </div>
    </div>

    {{-- Total Sales (Filtered Range) --}}
    <div class="col-sm-6 col-md-3">
        <div class="card text-center shadow-sm">
            <div class="card-body">
                <h6 class="text-muted">Total Sales (Collection)</h6>
                <h3 class="mb-0 text-primary">৳{{ number_format($totalSalesAmount, 2) }}</h3>
                <small class="text-muted">Transactions: {{ number_format($totalTransactions) }} ({{ date('Y-m-d', strtotime($startDate)) }} to {{ date('Y-m-d', strtotime($endDate)) }})</small>
            </div>
        </div>
    </div>
</div>

<!-- Table: Dynamic Report Rows -->
<div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <strong>Subscriptions Report ({{ $connections->count() }} Records)</strong>
        <small class="text-muted">Data for connections started between **{{ date('Y-m-d', strtotime($startDate)) }}** and **{{ date('Y-m-d', strtotime($endDate)) }}**</small>
    </div>
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Customer</th>
                    <th>Package</th>
                    <th>Start Date</th>
                    <th>Status</th>
                    <th>Monthly Fee</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                {{-- Dynamic rows using data from the Connection model --}}
                @forelse($connections as $connection)
                <tr>
                    <td>{{ $connection->id }}</td>
                    <td>
                        {{ $connection->customer->name ?? 'N/A' }}
                        <small class="d-block text-muted">{{ $connection->customer->phone ?? 'N/A' }}</small>
                    </td>
                    <td>{{ $connection->package->package_name ?? 'N/A' }}</td>
                    <td>{{ \Carbon\Carbon::parse($connection->start_date)->format('Y-m-d') }}</td>
                    <td>
                        @php
                            $statusClass = [
                                'active' => 'success',
                                'inactive' => 'danger',
                                'pending' => 'warning text-dark',
                                'suspended' => 'secondary',
                            ][$connection->status] ?? 'info';
                        @endphp
                        <span class="badge bg-{{ $statusClass }}">{{ ucfirst($connection->status) }}</span>
                    </td>
                    <td>৳{{ number_format($connection->monthly_fee, 2) }}</td>
                    <td>
                        {{-- View Link placeholder --}}
                        <a href="#" class="btn btn-sm btn-outline-primary" title="View Customer Details">View</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center text-muted py-4">No connections found for the selected criteria.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer text-muted">
        Total connections found: **{{ number_format($connections->count()) }}**
    </div>
</div>

<!-- Notes / quick stats (Dynamic) -->
<div class="row g-3">
    <div class="col-md-6">
        <div class="card p-3">
            <h6 class="mb-2">Report Notes</h6>
            <ul class="mb-0">
                <li class="text-muted">The **Subscriptions Report** displays **Connection** records based on the **Start Date** filter.</li>
                <li class="text-muted">Use the filters above to refine the date range and package type.</li>
                <li class="text-muted">All summary cards are calculated dynamically based on the current system data (not filtered by date range, except Sales).</li>
            </ul>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card p-3">
            <h6 class="mb-2">Summary by Package Price</h6>
            {{-- Dynamic Summary by Package Price --}}
            @foreach($packages as $package)
                <div class="d-flex justify-content-between">
                    <small>{{ $package->package_name }}</small><strong>৳{{ number_format($package->price, 2) }}</strong>
                </div>
            @endforeach
        </div>
    </div>
</div>


</div>
@endsection