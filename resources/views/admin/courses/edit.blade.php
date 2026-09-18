@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Edit Course</h2>
    <form action="{{ route('courses.update', $course->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Title</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $course->title) }}">
            @error('title') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control">{{ old('description', $course->description) }}</textarea>
            @error('description') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label>Instructor Name</label>
            <input type="text" name="instructor_name" class="form-control" value="{{ old('instructor_name', $course->instructor_name) }}">
            @error('instructor_name') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label>Max Students <small class="text-muted">(leave blank for unlimited)</small></label>
            <input type="number" name="max_students" class="form-control" value="{{ old('max_students', $course->max_students) }}">
            @error('max_students') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <button class="btn btn-primary">Update</button>
        <a href="{{ route('courses.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection