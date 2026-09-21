@extends('layouts.app')

@section('title', 'Register')

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
                <p class="text-white-50 small mt-1">Create your account</p>
            </div>

            <div class="edu-card p-4">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label fw-semibold">Name</label>
                        <input id="name" type="text" name="name"
                               class="form-control" value="{{ old('name') }}"
                               required autofocus autocomplete="name">
                        @error('name')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label fw-semibold">Email</label>
                        <input id="email" type="email" name="email"
                               class="form-control" value="{{ old('email') }}"
                               required autocomplete="username">
                        @error('email')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label fw-semibold">Password</label>
                        <input id="password" type="password" name="password"
                               class="form-control"
                               required autocomplete="new-password">
                        @error('password')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="password_confirmation" class="form-label fw-semibold">
                            Confirm Password
                        </label>
                        <input id="password_confirmation" type="password"
                               name="password_confirmation"
                               class="form-control"
                               required autocomplete="new-password">
                        @error('password_confirmation')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex align-items-center justify-content-between">
                        <a href="{{ route('login') }}"
                           class="text-muted small">Already registered?</a>
                        <button type="submit" class="btn btn-accent px-4 fw-bold">
                            Register <i class="bi bi-arrow-right ms-1"></i>
                        </button>
                    </div>
                </form>
            </div>

            <p class="text-center text-white-50 small mt-3">
                Already have an account?
                <a href="{{ route('login') }}" style="color:var(--accent);">Log in</a>
            </p>
        </div>
    </div>
@endsection
