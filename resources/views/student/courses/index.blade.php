@extends('layouts.app')

@section('title', 'Browse Courses')

@section('hero')
    <p class="eyebrow">Available Courses</p>
    <h1>Find your<br>next course.</h1>
    <p class="sub">Browse what's available and start learning today.</p>
@endsection

@section('content')
    @if($courses->isEmpty())
        <div class="text-center py-5 text-muted">
            <i class="bi bi-journal-x fs-1 d-block mb-3"></i>
            No courses available yet.
        </div>
    @else
        <div class="d-flex align-items-center justify-content-between mb-4">
            <span style="font-size:1rem; font-weight:700;">
                {{ $courses->count() }} course{{ $courses->count() !== 1 ? 's' : '' }} available
            </span>
        </div>

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
                        {{ Str::limit($course->description, 90) }}
                    </p>
                    <div class="d-flex align-items-center justify-content-between">
                        <span class="text-muted small">
                            <i class="bi bi-file-earmark me-1"></i>{{ $course->contents->count() }} items
                            &nbsp;·&nbsp;
                            <i class="bi bi-people me-1"></i>{{ $course->max_students ? $course->max_students . ' max' : 'Unlimited' }}
                        </span>
                        <a href="{{ route('courses.public.show', $course) }}" class="btn btn-accent btn-sm px-3">
                            View <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @endif
@endsection