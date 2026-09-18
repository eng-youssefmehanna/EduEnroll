<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>EduEnroll</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="/">Edu<span>Enroll</span></a>
            <button class="navbar-toggler border-secondary" type="button"
                    data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-lg-center gap-1">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="/login">
                                <i class="bi bi-box-arrow-in-right me-1"></i>Login
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/register">
                                <i class="bi bi-person-plus me-1"></i>Register
                            </a>
                        </li>
                    @endguest

                    @auth
                        @if(Auth::user()->is_admin)
                            <li class="nav-item">
                                <a class="nav-link" href="/admin/schools">
                                    <i class="bi bi-building me-1"></i>Schools
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/admin/courses">
                                    <i class="bi bi-journal-bookmark me-1"></i>Courses
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/admin/enrollments">
                                    <i class="bi bi-people me-1"></i>Enrollments
                                </a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="/">
                                    <i class="bi bi-grid me-1"></i>Browse
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('dashboard') }}">
                                    <i class="bi bi-speedometer2 me-1"></i>Dashboard
                                </a>
                            </li>
                        @endif
                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="nav-link btn btn-link px-2"
                                        style="color:rgba(255,255,255,.75);">
                                    <i class="bi bi-box-arrow-right me-1"></i>Logout
                                </button>
                            </form>
                        </li>
                        <li class="nav-item ms-2">
                            <div class="nav-avatar">
                                {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                            </div>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    @if(session('success') || session('error'))
    <div class="container mt-3">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show border-0 rounded-3" role="alert">
                <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show border-0 rounded-3" role="alert">
                <i class="bi bi-exclamation-circle me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
    </div>
    @endif

    @hasSection('hero')
    <div class="page-hero">
        <div class="container">
            @yield('hero')
        </div>
    </div>
    @endif

    <div class="container pb-5">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>