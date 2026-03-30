
<x-guest-layout>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Forgot Password</title>

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

        <style>
            @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap');
            body {
                font-family: 'Inter', sans-serif;
                background-color: #f3f4f6;
            }
        </style>
    </head>

    <body class="min-vh-100 d-flex align-items-center justify-content-center p-4">

    <!-- Forgot Password Card -->
    <div class="w-100" style="max-width: 420px;">
        <div class="card shadow-lg border-0 rounded-4 p-4 p-md-5">

            <!-- Header -->
            <header class="text-center mb-4">
                <h1 class="h3 fw-bold text-dark">Forgot Password?</h1>
                <p class="text-secondary mb-0">
                    Enter your email and we'll send you a password reset link.
                </p>
            </header>

            <!-- Session Status -->
            <x-auth-session-status class="mb-3" :status="session('status')" />

            <!-- Forgot Password Form -->
            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="form-label fw-medium text-dark-emphasis">Email Address</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                           placeholder="you@example.com"
                           class="form-control rounded-3 border-secondary-subtle py-2 @error('email') is-invalid @enderror">

                    <x-input-error :messages="$errors->get('email')" class="mt-1 text-danger" />
                </div>

                <!-- Submit Button -->
                <div class="d-grid gap-2 mt-4">
                    <button type="submit" class="btn btn-primary btn-lg rounded-3 fw-bold shadow-sm">
                        Send Password Reset Link
                    </button>
                </div>
            </form>

            <!-- Footer / Back to Login -->
            <div class="text-center pt-4 mt-4 border-top">
                <p class="text-secondary mb-0">
                    Remember your password?
                    <a href="{{ route('login') }}" class="text-decoration-none text-primary-emphasis fw-medium">
                        Log In
                    </a>
                </p>
            </div>

        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    </body>
    </html>
</x-guest-layout>
