@include('layouts-portal.partials.header')
@include('layouts-portal.partials.navbar')

<main class="container py-5">
  <div class="text-center mb-5">
    <h1 class="fw-bold text-primary">Welcome to YourISP</h1>
    <p class="text-muted">Fast, reliable, and affordable Internet Packages</p>
  </div>

  <div id="packages" class="row g-4">
    <!-- Bronze -->
    <div class="col-md-3">
      <div class="card text-center shadow-sm border-0">
        <div class="card-header bg-warning fw-bold">Bronze Pack</div>
        <div class="card-body">
          <h5>৳499 / month</h5>
          <p>Speed: 10 Mbps<br>Unlimited Usage</p>
          <a href="#" class="btn btn-outline-primary">Subscribe</a>
        </div>
      </div>
    </div>
    <!-- Silver -->
    <div class="col-md-3">
      <div class="card text-center shadow-sm border-0">
        <div class="card-header bg-secondary text-white fw-bold">Silver Pack</div>
        <div class="card-body">
          <h5>৳899 / month</h5>
          <p>Speed: 25 Mbps<br>Unlimited Usage</p>
          <a href="#" class="btn btn-outline-primary">Subscribe</a>
        </div>
      </div>
    </div>
    <!-- Gold -->
    <div class="col-md-3">
      <div class="card text-center shadow-sm border-0">
        <div class="card-header bg-warning text-dark fw-bold">Gold Pack</div>
        <div class="card-body">
          <h5>৳1499 / month</h5>
          <p>Speed: 50 Mbps<br>Unlimited Usage</p>
          <a href="#" class="btn btn-outline-primary">Subscribe</a>
        </div>
      </div>
    </div>
    <!-- Platinum -->
    <div class="col-md-3">
      <div class="card text-center shadow-sm border-0">
        <div class="card-header bg-dark text-white fw-bold">Platinum Pack</div>
        <div class="card-body">
          <h5>৳2499 / month</h5>
          <p>Speed: 100 Mbps<br>Unlimited Usage</p>
          <a href="#" class="btn btn-outline-primary">Subscribe</a>
        </div>
      </div>
    </div>
  </div>

  <div id="contact" class="text-center mt-5">
    <h3>Need Help?</h3>
    <p>Contact our support team 24/7</p>
    <a href="#" class="btn btn-success">Contact Us</a>
  </div>
</main>

@include('layouts-portal.partials.footer')
