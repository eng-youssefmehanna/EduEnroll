@extends('layouts.app')

@section('title', $course->title)

@section('hero')
    <p class="eyebrow">Course Detail</p>
    <h1>{{ $course->title }}</h1>
    <p class="sub">Instructor: {{ $course->instructor_name }}</p>
@endsection

@section('content')
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="edu-card p-4 mb-4">
                <h5 class="fw-bold mb-3">About this course</h5>
                <p class="text-muted mb-0">{{ $course->description }}</p>
            </div>

            <div class="edu-card p-4">
                <h5 class="fw-bold mb-3">Contents</h5>
                @if($course->contents->isEmpty())
                    <p class="text-muted mb-0">No content added yet.</p>
                @else
                    <ul class="list-unstyled mb-0">
                        @foreach($course->contents as $content)
                        <li class="d-flex align-items-center justify-content-between py-2
                                   {{ !$loop->last ? 'border-bottom' : '' }}">
                            <span class="fw-semibold">{{ $content->title }}</span>
                            <span class="tag">{{ $content->type }}</span>
                        </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>

        <div class="col-lg-4">
            <div class="edu-card p-4">
                <div class="mb-3">
                    <span class="tag me-2">
                        <i class="bi bi-file-earmark me-1"></i>{{ $course->contents->count() }} items
                    </span>
                    <span class="tag">
                        <i class="bi bi-people me-1"></i>
                        {{ $course->max_students ? $course->max_students . ' max' : 'Unlimited' }}
                    </span>
                </div>

                @auth
                    @if($isEnrolled)
                        <a href="{{ route('my-courses.content', $course) }}"
                           class="btn btn-accent w-100 fw-bold">
                            <i class="bi bi-play-circle me-2"></i>Go to Course
                        </a>
                    @else
                        <form action="{{ route('enroll', $course) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-accent w-100 fw-bold">
                                <i class="bi bi-plus-circle me-2"></i>Enroll Now
                            </button>
                        </form>
                    @endif
                @else
                    <a href="/login" class="btn btn-dark-solid w-100 fw-bold">
                        <i class="bi bi-box-arrow-in-right me-2"></i>Login to Enroll
                    </a>
                @endauth
            </div>
        </div>
    </div>
@endsection