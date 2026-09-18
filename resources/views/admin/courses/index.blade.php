@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Courses</h2>
        <a href="{{ route('courses.create') }}" class="btn btn-primary">Add Course</a>
    </div>

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
@endsection