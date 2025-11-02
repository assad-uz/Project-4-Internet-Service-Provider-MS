{{-- resources/views/dashboard.blade.php --}}
@extends('layouts.app')

@section('title', 'Admin Dashboard')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/dashboard.css') }}">
@endpush

@section('content')
<div class="container py-4">
    <div class="row g-3">
        {{-- Card 1: Total Customers --}}
        <div class="col-12 col-sm-6 col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <h6 class="text-muted">Total Customers</h6>
                    <h3 class="fw-bold">{{ number_format($totalCustomers) }}</h3>
                </div>
            </div>
        </div>

        {{-- Card 2: Active Customers --}}
        <div class="col-12 col-sm-6 col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <h6 class="text-muted">Active Customers</h6>
                    <h3 class="fw-bold text-success">{{ number_format($activeCustomers) }}</h3>
                </div>
            </div>
        </div>

        {{-- Card 3: Inactive Customers --}}
        <div class="col-12 col-sm-6 col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <h6 class="text-muted">Inactive Customers</h6>
                    <h3 class="fw-bold text-danger">{{ number_format($inactiveCustomers) }}</h3>
                </div>
            </div>
        </div>

        {{-- Card 4: Pending Support Ticket --}}
        <div class="col-12 col-sm-6 col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <h6 class="text-muted">Pending Support Ticket</h6>
                    <h3 class="fw-bold text-warning">{{ number_format($pendingTickets) }}</h3>
                </div>
            </div>
        </div>

        {{-- প্যাকেজ অনুযায়ী ব্যবহারকারী (ডাইনামিক লুপ) --}}
        @foreach($packageCounts as $packageStat)
        <div class="col-12 col-sm-6 col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <h6 class="text-muted">Total Users | {{ $packageStat->package->package_name ?? 'N/A' }}</h6>
                    <h3 class="fw-bold">{{ number_format($packageStat->total) }}</h3>
                </div>
            </div>
        </div>
        @endforeach
        
        {{-- আপনার স্ট্যাটিক প্যাকেজ কার্ডগুলি সরিয়ে দিন (Card 5-8) --}}


        {{-- Card 9: Total Pending Payments (বকেয়া বিলের সংখ্যা) --}}
        <div class="col-12 col-sm-6 col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <h6 class="text-muted">Total Due Bills</h6>
                    <h3 class="fw-bold text-danger">{{ number_format($totalDueBillingsCount) }}</h3>
                </div>
            </div>
        </div>

        {{-- Card 10: Total Sales Amount (Current Month Collection) --}}
        <div class="col-12 col-sm-6 col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <h6 class="text-muted">Collection ({{ Carbon\Carbon::now()->format('M Y') }})</h6>
                    <h3 class="fw-bold text-primary">৳ {{ number_format($totalSalesAmount, 2) }}</h3>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection