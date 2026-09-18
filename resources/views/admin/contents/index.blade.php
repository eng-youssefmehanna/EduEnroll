@extends('layouts.app')

@section('title', 'Contents — ' . $course->title)

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2>{{ $course->title }}</h2>
            <p class="text-muted mb-0">Course Contents</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('courses.contents.create', $course) }}" class="btn btn-primary">Add Content</a>
            <a href="{{ route('courses.index') }}" class="btn btn-outline-secondary">Back to Courses</a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($contents->isEmpty())
        <p class="text-muted">No content added yet.</p>
    @else
        <table class="table table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Type</th>
                    <th>Order</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($contents as $content)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $content->title }}</td>
                    <td><span class="badge bg-secondary">{{ $content->type }}</span></td>
                    <td>{{ $content->order }}</td>
                    <td>
                        <a href="{{ route('courses.contents.edit', [$course, $content]) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('courses.contents.destroy', [$course, $content]) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this content?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
