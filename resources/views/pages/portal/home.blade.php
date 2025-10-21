{{-- resources/views/home.blade.php --}}
@extends('layouts.app')

@section('content')
<!-- custom styles (optional) -->
<style>
    .package-card { transition: transform .18s ease, box-shadow .18s ease; }
    .package-card:hover { transform: translateY(-8px); box-shadow: 0 10px 30px rgba(0,0,0,0.08); }
    .hero { background: linear-gradient(90deg, #0d6efd22 0%, #6610f322 100%); border-radius: .5rem; }
    .feature-icon { font-size: 1.6rem; }
</style>

<!-- Hero -->
<section class="container py-5">
    <div class="row align-items-center">
        <div class="col-md-6">
            <h1 class="display-5 fw-bold">বিশ্বস্ত ও দ্রুত ইন্টারনেট — যে ঠিকানায় আপনি চান</h1>
            <p class="lead text-muted">Bronze থেকে Platinum—আপনার চাহিদা অনুযায়ী প্যাকেজ। দ্রুত ইন্সটলেশন, ২৪/৭ সাপোর্ট এবং সাশ্রয়ী মূল্য।</p>
            <div class="mt-4">
                <a href="#packages" class="btn btn-primary btn-lg me-2">প্যাকেজ দেখুন</a>
                <a href="#contact" class="btn btn-outline-secondary btn-lg">কাস্টম প্ল্যান জানুন</a>
            </div>
            <ul class="list-unstyled mt-4">
                <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> সহজ অনলাইন সাইনআপ</li>
                <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> সীমাহীন ব্রাউজিং (fair use)</li>
                <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> দ্রুত ইন্সটলেশন</li>
            </ul>
        </div>

        <div class="col-md-6">
            <div class="hero p-4">
                <img src="https://via.placeholder.com/600x360?text=ISP+Hero+Image" alt="ISP" class="img-fluid rounded">
            </div>
        </div>
    </div>
</section>

<!-- Packages -->
<section id="packages" class="container py-5">
    <div class="text-center mb-4">
        <h2 class="fw-bold">আমাদের প্যাকেজ</h2>
        <p class="text-muted">আপনার ব্যবহারের ধরন অনুযায়ী প্যাকেজ বেছে নিন</p>
    </div>

    <div class="row g-4">
        @foreach($packages as $pkg)
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="card package-card h-100 border-0">
                <div class="card-body d-flex flex-column">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <h5 class="card-title">{{ $pkg['name'] }}</h5>
                        <span class="badge bg-{{ $pkg['color'] }}">{{ $pkg['badge'] }}</span>
                    </div>

                    <div class="mb-3">
                        <h3 class="fw-bold">৳{{ $pkg['price'] }} <small class="text-muted fs-6">/ মাস</small></h3>
                        <div class="text-muted">{{ $pkg['speed'] }}</div>
                    </div>

                    <ul class="list-unstyled mt-3 mb-4">
                        @foreach($pkg['features'] as $feature)
                            <li class="mb-2"><i class="bi bi-check2-circle text-success me-2"></i> {{ $feature }}</li>
                        @endforeach
                    </ul>

                    <div class="mt-auto">
                        <a href="{{ route('signup') ?? '#' }}" class="btn btn-{{ $pkg['color'] == 'dark' ? 'dark' : 'primary' }} w-100">Sign Up</a>
                        <a href="#contact" class="d-block text-center mt-2 text-muted">More info</a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>

<!-- Why us / features -->
<section class="container py-5">
    <div class="row g-4 align-items-center">
        <div class="col-md-6">
            <h3 class="fw-bold">কেন আমাদের সাথে যুক্ত হবেন?</h3>
            <p class="text-muted">প্রফেশনাল সার্ভিস, নির্ভরযোগ্য কভারেজ এবং দ্রুত সাপোর্ট — সবই আপনার হাতে।</p>

            <div class="row gy-3">
                <div class="col-12">
                    <div class="d-flex">
                        <div class="me-3 feature-icon text-primary"><i class="bi bi-lightning-charge-fill"></i></div>
                        <div>
                            <h6 class="mb-1">দ্রুত কনেকশন</h6>
                            <p class="text-muted mb-0">কম লেগেসি, দ্রুত আপ-টাইম।</p>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="d-flex">
                        <div class="me-3 feature-icon text-success"><i class="bi bi-headset"></i></div>
                        <div>
                            <h6 class="mb-1">২৪/৭ সাপোর্ট</h6>
                            <p class="text-muted mb-0">দ্রুত রেসপন্স টিকিট সিস্টেম।</p>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="d-flex">
                        <div class="me-3 feature-icon text-warning"><i class="bi bi-shield-lock-fill"></i></div>
                        <div>
                            <h6 class="mb-1">নিরাপত্তা ও SLA</h6>
                            <p class="text-muted mb-0">প্রিমিয়াম গ্রাহকের জন্য বিশেষ সার্ভিস লেভেল।</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-md-6 text-center">
            <img src="https://via.placeholder.com/520x320?text=Network+Infrastructure" alt="Network" class="img-fluid rounded">
        </div>
    </div>
</section>

<!-- Contact / CTA -->
<section id="contact" class="container py-5">
    <div class="row align-items-center g-4">
        <div class="col-md-7">
            <h3 class="fw-bold">আপনার জন্য সঠিক প্ল্যান জানতে চান?</h3>
            <p class="text-muted">ফর্ম পূরণ করুন, আমাদের সেলস টিম আপনাকে উপযুক্ত প্যাকেজ সাজেস্ট করবে।</p>

            <form action="{{ route('contact.submit') ?? '#' }}" method="POST" class="row g-3">
                @csrf
                <div class="col-md-6">
                    <input name="name" type="text" class="form-control" placeholder="আপনার নাম" required>
                </div>
                <div class="col-md-6">
                    <input name="phone" type="text" class="form-control" placeholder="মোবাইল নং" required>
                </div>
                <div class="col-12">
                    <input name="address" type="text" class="form-control" placeholder="ঠিকানা (ঐচ্ছিক)">
                </div>
                <div class="col-12">
                    <select name="interested_package" class="form-select">
                        <option value="">ইচ্ছুক প্যাকেজ</option>
                        @foreach($packages as $pkg)
                            <option value="{{ $pkg['name'] }}">{{ $pkg['name'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12">
                    <button class="btn btn-primary btn-lg">সম্পর্ক করুন</button>
                </div>
            </form>
        </div>

        <div class="col-md-5">
            <div class="card border-0 shadow-sm p-3">
                <div class="card-body text-center">
                    <h5>গভীর সংযোগ / emergency</h5>
                    <p class="mb-1">সাপোর্ট লাইভ: <strong>+880 1XXXXXXXXX</strong></p>
                    <p class="mb-0">ইমেইল: <strong>support@yourisp.com</strong></p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="bg-light py-4 mt-5">
    <div class="container d-flex flex-column flex-md-row justify-content-between align-items-center">
        <div class="mb-2 mb-md-0">
            <strong>YourISP</strong> &copy; {{ date('Y') }}. All rights reserved.
        </div>
        <div>
            <a href="#" class="text-muted me-3">Privacy</a>
            <a href="#" class="text-muted">Terms</a>
        </div>
    </div>
</footer>
@endsection
