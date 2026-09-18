@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Add Course</h2>
    <form action="{{ route('courses.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Title</label>
            <input type="text" name="title" class="form-control" value="{{ old('title') }}">
            @error('title') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control">{{ old('description') }}</textarea>
            @error('description') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label>Instructor Name</label>
            <input type="text" name="instructor_name" class="form-control" value="{{ old('instructor_name') }}">
            @error('instructor_name') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label>Max Students <small class="text-muted">(leave blank for unlimited)</small></label>
            <input type="number" name="max_students" class="form-control" value="{{ old('max_students') }}">
            @error('max_students') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <button class="btn btn-primary">Save</button>
        <a href="{{ route('courses.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection