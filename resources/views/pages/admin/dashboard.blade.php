{{-- resources/views/dashboard.blade.php --}}
@extends('layouts.app')

@section('title', 'Admin Dashboard')
@section('content')
<div class="container py-4">
    <div class="row g-3">
        {{-- Card 1 --}}
        <div class="col-12 col-sm-6 col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <h6 class="text-muted">Total Users</h6>
                    <h3 class="fw-bold">120</h3>
                </div>
            </div>
        </div>

        {{-- Card 2 --}}
        <div class="col-12 col-sm-6 col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <h6 class="text-muted">Active Users</h6>
                    <h3 class="fw-bold text-success">95</h3>
                </div>
            </div>
        </div>

        {{-- Card 3 --}}
        <div class="col-12 col-sm-6 col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <h6 class="text-muted">Inactive Users</h6>
                    <h3 class="fw-bold text-danger">25</h3>
                </div>
            </div>
        </div>

        {{-- Card 4 --}}
        <div class="col-12 col-sm-6 col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <h6 class="text-muted">Pending Support Ticket</h6>
                    <h3 class="fw-bold text-warning">8</h3>
                </div>
            </div>
        </div>

        {{-- Card 5 --}}
        <div class="col-12 col-sm-6 col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <h6 class="text-muted">Total Users | Package 01</h6>
                    <h3 class="fw-bold">35</h3>
                </div>
            </div>
        </div>

        {{-- Card 6 --}}
        <div class="col-12 col-sm-6 col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <h6 class="text-muted">Total Users | Package 02</h6>
                    <h3 class="fw-bold">28</h3>
                </div>
            </div>
        </div>

        {{-- Card 7 --}}
        <div class="col-12 col-sm-6 col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <h6 class="text-muted">Total Users | Package 03</h6>
                    <h3 class="fw-bold">22</h3>
                </div>
            </div>
        </div>

        {{-- Card 8 --}}
        <div class="col-12 col-sm-6 col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <h6 class="text-muted">Total Users | Package 04</h6>
                    <h3 class="fw-bold">15</h3>
                </div>
            </div>
        </div>

        {{-- Card 9 --}}
        <div class="col-12 col-sm-6 col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <h6 class="text-muted">Total Pending Payments</h6>
                    <h3 class="fw-bold text-danger">5</h3>
                </div>
            </div>
        </div>

        {{-- Card 10 --}}
        <div class="col-12 col-sm-6 col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <h6 class="text-muted">Total Sales Amount</h6>
                    <h3 class="fw-bold text-primary">$12,450</h3>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
