<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
  <div class="container">
    <a class="navbar-brand fw-bold text-primary" href="{{ url('/') }}">
      <i class="bi bi-wifi me-1"></i> YourISP
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="mainNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="#packages">Packages</a></li>
        <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
      </ul>

      <div class="ms-lg-3 mt-2 mt-lg-0">
        <a href="{{ route('login') }}" class="btn btn-outline-primary btn-sm me-2">Login</a>
        <a href="{{ route('register') }}" class="btn btn-primary btn-sm text-white">Register</a>
      </div>
    </div>
  </div>
</nav>
