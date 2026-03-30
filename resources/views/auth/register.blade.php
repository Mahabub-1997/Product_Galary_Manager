


<x-guest-layout>
    <!DOCTYPE html>
    <html lang="en">
    @include('auth.master.header')

    <body class="min-vh-100 d-flex align-items-center justify-content-center p-4">

    <!-- Register Card Container -->
    <div class="w-100" style="max-width: 420px;">
        <div class="card shadow-lg border-0 rounded-4 p-4 p-md-5">

            <!-- Header -->
            <header class="text-center mb-4">
                <h1 class="h3 fw-bold text-dark">Create Your Account</h1>
                <p class="text-secondary mb-0">
                    Sign up to access your dashboard.
                </p>
            </header>

            <!-- Register Form -->
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div class="mb-3">
                    <label for="name" class="form-label fw-medium text-dark-emphasis">Full Name</label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                           placeholder="Enter your full name"
                           class="form-control rounded-3 border-secondary-subtle py-2 @error('name') is-invalid @enderror">

                    <x-input-error :messages="$errors->get('name')" class="mt-1 text-danger" />
                </div>

                <!-- Email Address -->
                <div class="mb-3">
                    <label for="email" class="form-label fw-medium text-dark-emphasis">Email Address</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required
                           placeholder="you@example.com"
                           class="form-control rounded-3 border-secondary-subtle py-2 @error('email') is-invalid @enderror">

                    <x-input-error :messages="$errors->get('email')" class="mt-1 text-danger" />
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label for="password" class="form-label fw-medium text-dark-emphasis">Password</label>
                    <input id="password" type="password" name="password" required
                           placeholder="Create a strong password"
                           class="form-control rounded-3 border-secondary-subtle py-2 @error('password') is-invalid @enderror">

                    <x-input-error :messages="$errors->get('password')" class="mt-1 text-danger" />
                </div>

                <!-- Confirm Password -->
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label fw-medium text-dark-emphasis">Confirm Password</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required
                           placeholder="Repeat your password"
                           class="form-control rounded-3 border-secondary-subtle py-2 @error('password_confirmation') is-invalid @enderror">

                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1 text-danger" />
                </div>

                <!-- Register Button -->
                <div class="d-grid gap-2 mt-4">
                    <button type="submit"
                            class="btn btn-primary btn-lg rounded-3 fw-bold shadow-sm">
                        Create Account
                    </button>
                </div>

            </form>

    @include('auth.master.footer')

    </body>
    </html>
</x-guest-layout>
