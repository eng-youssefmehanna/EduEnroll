@extends('layouts.app')

@section('title', 'My Dashboard')

@section('hero')
    <p class="eyebrow">My Learning</p>
    <h1>My Courses.</h1>
    <p class="sub">Pick up where you left off.</p>
@endsection

@section('content')
    @if($courses->isEmpty())
        <div class="text-center py-5">
            <i class="bi bi-journal-x fs-1 d-block mb-3 text-muted"></i>
            <p class="text-muted mb-3">You are not enrolled in any courses yet.</p>
            <a href="/" class="btn btn-accent px-4 fw-bold">Browse Courses</a>
        </div>
    @else
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @foreach($courses as $course)
            <div class="col">
                <div class="edu-card h-100 p-4 d-flex flex-column">
                    <div class="d-flex gap-3 mb-3">
                        <div class="icon-box">
                            <i class="bi bi-journal-bookmark"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-1">{{ $course->title }}</h6>
                            <span class="tag tag-accent">{{ $course->instructor_name }}</span>
                        </div>
                    </div>
                    <p class="text-muted small mb-3" style="flex:1;">
                        <i class="bi bi-file-earmark me-1"></i>{{ $course->contents->count() }} items
                    </p>
                    <a href="{{ route('my-courses.content', $course) }}"
                       class="btn btn-accent btn-sm px-3 align-self-end">
                        Continue <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    @endif
@endsection