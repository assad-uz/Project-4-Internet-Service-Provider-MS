{{-- resources/views/report.blade.php --}}
@extends('layouts.app')

@section('title', 'Reports')

@section('content')
<div class="container py-4">
    <!-- Page header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="mb-0">Reports</h3>
            <small class="text-muted">Overview / Static sample report</small>
        </div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Reports</li>
            </ol>
        </nav>
    </div>

    <!-- Filters (static inputs) -->
    <div class="card mb-4">
        <div class="card-body">
            <form class="row g-3">
                <div class="col-md-3">
                    <label class="form-label">From</label>
                    <input type="date" class="form-control" value="{{ date('Y-m-01') }}" disabled>
                </div>
                <div class="col-md-3">
                    <label class="form-label">To</label>
                    <input type="date" class="form-control" value="{{ date('Y-m-d') }}" disabled>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Package</label>
                    <select class="form-select" disabled>
                        <option>All Packages</option>
                        <option>Bronze Pack</option>
                        <option>Silver Pack</option>
                        <option>Gold Pack</option>
                        <option>Platinum Pack</option>
                    </select>
                </div>
                <div class="col-md-3 d-flex align-items-end gap-2">
                    <button type="button" class="btn btn-primary" disabled>Apply (static)</button>
                    <button type="button" class="btn btn-outline-secondary" disabled>Reset</button>
                    <div class="ms-auto">
                        <button class="btn btn-sm btn-outline-success" disabled>Export CSV</button>
                        <button class="btn btn-sm btn-outline-danger" disabled>Export PDF</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Summary cards -->
    <div class="row g-3 mb-4">
        <div class="col-sm-6 col-md-3">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h6 class="text-muted">Total Users</h6>
                    <h3 class="mb-0">1,240</h3>
                    <small class="text-success">+12 this month</small>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-md-3">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h6 class="text-muted">Active Users</h6>
                    <h3 class="mb-0 text-success">980</h3>
                    <small class="text-muted">Active now: 120</small>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-md-3">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h6 class="text-muted">Pending Payments</h6>
                    <h3 class="mb-0 text-warning">18</h3>
                    <small class="text-muted">Total pending amount: ৳7,250</small>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-md-3">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h6 class="text-muted">Total Sales (This month)</h6>
                    <h3 class="mb-0 text-primary">৳125,400</h3>
                    <small class="text-muted">Transactions: 312</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Table: Static Report Rows -->
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <strong>Subscriptions Report (Static)</strong>
            <small class="text-muted">Showing sample rows</small>
        </div>
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Customer</th>
                        <th>Package</th>
                        <th>Start Date</th>
                        <th>Status</th>
                        <th>Monthly Fee</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Static sample rows --}}
                    <tr>
                        <td>1</td>
                        <td>Md. Karim</td>
                        <td>Gold Pack</td>
                        <td>2025-09-05</td>
                        <td><span class="badge bg-success">Active</span></td>
                        <td>৳900</td>
                        <td><button class="btn btn-sm btn-outline-primary" disabled>View</button></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Shahida Begum</td>
                        <td>Silver Pack</td>
                        <td>2025-10-01</td>
                        <td><span class="badge bg-warning text-dark">Pending</span></td>
                        <td>৳750</td>
                        <td><button class="btn btn-sm btn-outline-primary" disabled>View</button></td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Rafi</td>
                        <td>Bronze Pack</td>
                        <td>2025-08-12</td>
                        <td><span class="badge bg-danger">Inactive</span></td>
                        <td>৳600</td>
                        <td><button class="btn btn-sm btn-outline-primary" disabled>View</button></td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Naila</td>
                        <td>Platinum Pack</td>
                        <td>2025-09-20</td>
                        <td><span class="badge bg-success">Active</span></td>
                        <td>৳1,100</td>
                        <td><button class="btn btn-sm btn-outline-primary" disabled>View</button></td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>Hasan</td>
                        <td>Gold Pack</td>
                        <td>2025-10-10</td>
                        <td><span class="badge bg-warning text-dark">Pending</span></td>
                        <td>৳900</td>
                        <td><button class="btn btn-sm btn-outline-primary" disabled>View</button></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="card-footer text-muted">
            Showing 5 of 5 sample rows (static)
        </div>
    </div>

    <!-- Notes / quick stats (static) -->
    <div class="row g-3">
        <div class="col-md-6">
            <div class="card p-3">
                <h6 class="mb-2">Quick Notes</h6>
                <ul class="mb-0">
                    <li class="text-muted">This is a static report view. Replace with dynamic data when ready.</li>
                    <li class="text-muted">Filters and export buttons are placeholders (disabled).</li>
                </ul>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card p-3">
                <h6 class="mb-2">Summary by Package (static)</h6>
                <div class="d-flex justify-content-between">
                    <small>Bronze</small><strong>600</strong>
                </div>
                <div class="d-flex justify-content-between">
                    <small>Silver</small><strong>750</strong>
                </div>
                <div class="d-flex justify-content-between">
                    <small>Gold</small><strong>900</strong>
                </div>
                <div class="d-flex justify-content-between">
                    <small>Platinum</small><strong>1,100</strong>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
