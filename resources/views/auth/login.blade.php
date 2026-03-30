<x-guest-layout>
    <!DOCTYPE html>
    <html lang="en">
   @include('auth.master.header')

    <body class="min-vh-100 d-flex align-items-center justify-content-center p-4">

    <!-- Login Card Container -->
    <div class="w-100" style="max-width: 400px;">
        <div class="card shadow-lg border-0 rounded-4 p-4 p-md-5">

            <!-- Header -->
            <header class="text-center mb-4">
                <h1 class="h3 fw-bold text-dark">Welcome Back</h1>
                <p class="text-secondary mb-0">Please sign in to continue to your dashboard.</p>
            </header>

            <!-- Session Status -->
            <x-auth-session-status class="mb-3" :status="session('status')" />

            <!-- Login Form -->
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="form-label fw-medium text-dark-emphasis">Email Address</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                           placeholder="you@example.com"
                           class="form-control rounded-3 border-secondary-subtle py-2 @error('email') is-invalid @enderror">

                    <x-input-error :messages="$errors->get('email')" class="mt-1 text-danger" />
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label for="password" class="form-label fw-medium text-dark-emphasis">Password</label>
                    <input id="password" type="password" name="password" required
                           placeholder="••••••••"
                           class="form-control rounded-3 border-secondary-subtle py-2 @error('password') is-invalid @enderror">

                    <x-input-error :messages="$errors->get('password')" class="mt-1 text-danger" />
                </div>

                <!-- Remember & Forgot -->
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember_me">
                        <label class="form-check-label text-secondary" for="remember_me">
                            Remember me
                        </label>
                    </div>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-decoration-none text-primary-emphasis fw-medium">
                            Forgot your password?
                        </a>
                    @endif
                </div>

                <!-- Login Button -->
                <div class="d-grid gap-2">
                    <button type="submit"
                            class="btn btn-primary btn-lg rounded-3 fw-bold shadow-sm">
                        Log In
                    </button>
                </div>
            </form>



    </body>
   @include('auth.master.footer')
    </html>
</x-guest-layout>
