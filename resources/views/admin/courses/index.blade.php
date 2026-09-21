@extends('layouts.app')

@section('title', 'Courses')

@section('hero')
    <p class="eyebrow">Admin</p>
    <h1>Courses.</h1>
    <p class="sub">Manage all courses and their content.</p>
@endsection

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <span style="font-size:1rem; font-weight:700;">{{ $courses->count() }} course{{ $courses->count() !== 1 ? 's' : '' }}</span>
        <a href="{{ route('courses.create') }}" class="btn btn-accent px-4">
            <i class="bi bi-plus-lg me-1"></i>Add Course
        </a>
    </div>

<<<<<<< HEAD
    @if($courses->isEmpty())
        <div class="text-center py-5 text-muted">
            <i class="bi bi-journal-x fs-1 d-block mb-3"></i>
            No courses yet.
        </div>
    @else
        <div class="edu-card">
            <table class="table edu-table mb-0">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Instructor</th>
                        <th>Max Students</th>
                        <th>Contents</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($courses as $course)
                    <tr>
                        <td class="fw-semibold">{{ $course->title }}</td>
                        <td class="text-muted">{{ $course->instructor_name }}</td>
                        <td>
                            <span class="tag">{{ $course->max_students ?? 'Unlimited' }}</span>
                        </td>
                        <td>
                            <span class="tag tag-accent">{{ $course->contents->count() }} items</span>
                        </td>
                        <td class="text-end">
                            <a href="{{ route('courses.contents.index', $course) }}"
                               class="btn btn-sm btn-accent me-1">
                                <i class="bi bi-collection"></i>
                            </a>
                            <a href="{{ route('courses.edit', $course->id) }}"
                               class="btn btn-sm btn-dark-solid me-1">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('courses.destroy', $course->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm"
                                        style="background:#fee2e2;color:#dc2626;border:none;"
                                        onclick="return confirm('Delete this course?')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
=======
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Title</th>
                <th>Instructor</th>
                <th>Max Students</th>
                <th>Contents</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($courses as $course)
            <tr>
                <td>{{ $course->title }}</td>
                <td>{{ $course->instructor_name }}</td>
                <td>{{ $course->max_students ?? 'Unlimited' }}</td>
                <td>{{ $course->contents->count() }}</td>
                <td>
                    <a href="{{ route('courses.contents.index', $course) }}" class="btn btn-sm btn-info">Manage Content</a>
                    <a href="{{ route('courses.edit', $course->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('courses.destroy', $course->id) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
>>>>>>> 3319af2ead54f2c80c8479404738180b4d9c795a
@endsection