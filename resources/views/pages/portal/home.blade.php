@extends('layouts-portal.base')

@section('title','Home - SwiftNet')
@push('styles')
<link rel="stylesheet" href="{{ asset('css/portal/home.css') }}">
@endpush

@section('content')
<section class="hero-section">
  <div class="container">
    <div class="row align-items-center gy-4">
      <div class="col-lg-6">
        <h1 class="display-5 fw-bold">Fast, Reliable Internet — Built for You</h1>
        <p class="lead text-muted mb-4">Choose from Bronze to Platinum. Simple pricing, instant installation and 24/7 support.</p>

        <div class="d-flex gap-3 flex-wrap">
          <a href="#packages" class="btn btn-primary btn-lg">View Packages</a>
          <a href="#contact" class="btn btn-outline-secondary btn-lg">Contact Sales</a>
        </div>

        <div class="mt-4 d-flex flex-wrap gap-3">
          <div class="stat">
            <h4 class="mb-0">99.9%</h4>
            <small class="text-muted">Uptime</small>
          </div>
          <div class="stat">
            <h4 class="mb-0">24/7</h4>
            <small class="text-muted">Support</small>
          </div>
          <div class="stat">
            <h4 class="mb-0">Free</h4>
            <small class="text-muted">Router (on signup)</small>
          </div>
        </div>
      </div>

      <div class="col-lg-6">
        <div class="hero-card shadow-lg">
          <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
              <small class="text-muted">Limited Offer</small>
              <h5 class="mb-0">Get first month 50% off</h5>
            </div>
            <div class="badge bg-primary text-white">Save</div>
          </div>

          <img src="{{ asset('portal-src/assets/img/front/front1.jpg') }}"
            alt="SwiftNet High-Speed Connection"
            class="img-fluid card-img-top rounded-top rounded-bottom mb-3"
            style="max-height: 300px; object-fit: cover;">

          <p class="text-muted mb-0">Professional-grade network, quick setup and local support team ready to assist.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<section id="packages" class="py-5 bg-white">
  <div class="container">
    <div class="text-center mb-5">
      <h2 class="fw-bold">Internet Packages</h2>
      <p class="text-muted">Flexible plans for home & business. Cancel anytime.</p>
    </div>

    <div class="row g-4">
      @php
      $packages = [
      ['name'=>'Bronze Pack','price'=>'499','speed'=>'10 Mbps','color'=>'muted','badge'=>'Popular'],
      ['name'=>'Silver Pack','price'=>'799','speed'=>'25 Mbps','color'=>'primary','badge'=>'Best Value'],
      ['name'=>'Gold Pack','price'=>'1299','speed'=>'50 Mbps','color'=>'warning','badge'=>'Recommended'],
      ['name'=>'Platinum Pack','price'=>'2499','speed'=>'100 Mbps','color'=>'dark','badge'=>'Premium'],
      ];
      @endphp

      @foreach($packages as $pkg)
      <div class="col-12 col-md-6 col-lg-3">
        <div class="package-card h-100 shadow-sm border-0">
          <div class="package-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">{{ $pkg['name'] }}</h5>
            <span class="badge bg-{{ $pkg['color']=='muted' ? 'secondary' : $pkg['color'] }}">{{ $pkg['badge'] }}</span>
          </div>

          <div class="package-body p-4">
            <div class="price d-flex align-items-baseline gap-2 mb-2">
              <h3 class="mb-0">৳{{ $pkg['price'] }}</h3>
              <small class="text-muted">/ month</small>
            </div>

            <p class="text-muted mb-3">{{ $pkg['speed'] }}</p>

            <ul class="list-unstyled text-sm mb-4">
              <li class="mb-2"><i class="bi bi-check2-circle text-success me-2"></i> Unlimited browsing (fair usage)</li>
              <li class="mb-2"><i class="bi bi-check2-circle text-success me-2"></i> 24/7 support</li>
              <li class="mb-2"><i class="bi bi-check2-circle text-success me-2"></i> Free router (on signup)</li>
            </ul>

            <a href="#" class="btn btn-outline-{{ $pkg['color']=='muted' ? 'secondary' : $pkg['color'] }} w-100">Choose Plan</a>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>

<section id="features" class="py-5">
  <div class="container">
    <div class="row g-4 align-items-center">
      <div class="col-md-6">
        <h3 class="fw-bold">Why choose SwiftNet?</h3>
        <p class="text-muted">Local team, dedicated support and strong SLA for business customers.</p>

        <div class="mt-4">
          <div class="d-flex mb-3">
            <div class="feature-icon me-3"><i class="bi bi-lightning-charge-fill"></i></div>
            <div>
              <h6 class="mb-0">Fast Connection</h6>
              <small class="text-muted">Low latency & stable speeds</small>
            </div>
          </div>

          <div class="d-flex mb-3">
            <div class="feature-icon me-3"><i class="bi bi-shield-fill-check"></i></div>
            <div>
              <h6 class="mb-0">Secure & Reliable</h6>
              <small class="text-muted">Network monitoring & SLA</small>
            </div>
          </div>

          <div class="d-flex">
            <div class="feature-icon me-3"><i class="bi bi-headset"></i></div>
            <div>
              <h6 class="mb-0">24/7 Support</h6>
              <small class="text-muted">Ticket + phone support</small>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-6 text-center">
        <img src="https://images.unsplash.com/photo-1577100078641-e92b0a906760?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&q=80&w=387" alt="infrastructure" class="img-fluid rounded shadow-sm">
      </div>
    </div>
  </div>
</section>


@endsection