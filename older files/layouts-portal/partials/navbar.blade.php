<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
  <div class="container">
    <a class="navbar-brand d-flex align-items-center fw-bold text-primary" href="{{ url('/') }}">
<img src="{{ asset('portal-src/assets/img/logo/my_logo.png') }}" 
alt="SwiftNet Logo" 
height="35" 
class="me-2 me-md-3"> 

<span class="fs-4">SwiftNet</span>
 </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="mainNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="#packages">Packages</a></li>
        <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
        <li class="nav-item"><a class="nav-link" href="{{url('/dashboard')}}">Login</a></li>
      </ul>
    </div>
  </div>
</nav>
