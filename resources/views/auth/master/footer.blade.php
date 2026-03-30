<!-- Footer -->
<div class="text-center pt-4 mt-4 border-top">
    <p class="text-secondary mb-0">
        Don't have an account?
        @if (Route::has('register'))
            <a href="{{ route('register') }}" class="text-decoration-none text-primary-emphasis fw-medium">
                Sign Up
            </a>
        @endif
    </p>
</div>
</div>
</div>

<!-- Bootstrap JS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
