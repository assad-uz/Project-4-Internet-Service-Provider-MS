<footer class="bg-white border-top mt-5">
  <div class="container py-4 text-center">
    <p class="mb-1 text-muted small">&copy; {{ date('Y') }} SwiftNet. All Rights Reserved.</p>
    <small>
      <a href="{{ url('/privacy') }}" class="text-decoration-none text-muted me-3">Privacy Policy</a>
      <a href="{{ url('/terms') }}" class="text-decoration-none text-muted">Terms & Conditions</a>
    </small>
  </div>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('js/portal.js') }}"></script>
@stack('scripts')
</body>
</html>
