@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <div class="min-vh-100 d-flex align-items-center justify-content-center py-5"
         style="background:var(--dark);">
        <div class="w-100" style="max-width:440px;">

            <div class="text-center mb-4">
                <a href="/" class="text-decoration-none">
                    <span style="font-size:1.5rem;font-weight:900;color:#fff;">
                        Edu<span style="color:var(--accent);">Enroll</span>
                    </span>
                </a>
                <p class="text-white-50 small mt-1">Sign in to your account</p>
            </div>

            <div class="edu-card p-4">
                <x-auth-session-status class="mb-3" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label fw-semibold">Email</label>
                        <input id="email" type="email" name="email"
                               class="form-control" value="{{ old('email') }}"
                               required autofocus autocomplete="username">
                        @error('email')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label fw-semibold">Password</label>
                        <input id="password" type="password" name="password"
                               class="form-control"
                               required autocomplete="current-password">
                        @error('password')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <div class="form-check">
                            <input id="remember_me" type="checkbox" name="remember"
                                   class="form-check-input">
                            <label for="remember_me" class="form-check-label text-muted small">
                                Remember me
                            </label>
                        </div>
                    </div>

                    <div class="d-flex align-items-center justify-content-between">
                        @if(Route::has('password.request'))
                            <a href="{{ route('password.request') }}"
                               class="text-muted small">Forgot password?</a>
                        @endif
                        <button type="submit" class="btn btn-accent px-4 fw-bold">
                            Log in <i class="bi bi-arrow-right ms-1"></i>
                        </button>
                    </div>
                </form>
            </div>

            <p class="text-center text-white-50 small mt-3">
                Don't have an account?
                <a href="{{ route('register') }}" style="color:var(--accent);">Register</a>
            </p>
        </div>
    </div>
@endsection