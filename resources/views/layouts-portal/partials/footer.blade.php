<footer class="bg-light border-top mt-5 py-4 text-center">
  <p class="mb-1 text-muted">&copy; {{ date('Y') }} YourISP. All rights reserved.</p>
  <small>
    <a href="{{ url('/privacy') }}" class="text-decoration-none text-muted me-3">Privacy</a>
    <a href="{{ url('/terms') }}" class="text-decoration-none text-muted">Terms</a>
  </small>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('js/portal.js') }}"></script>
@stack('scripts')
</body>
</html>
