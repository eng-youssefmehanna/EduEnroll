@extends('layouts.app')

@section('title', 'Add Course')

@section('hero')
    <p class="eyebrow">Admin — Courses</p>
    <h1>Add Course.</h1>
    <p class="sub">Create a new course for students to enroll in.</p>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="edu-card p-4">
                <form action="{{ route('courses.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Title</label>
                        <input type="text" name="title" class="form-control" value="{{ old('title') }}">
                        @error('title') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Description</label>
                        <textarea name="description" class="form-control" rows="4">{{ old('description') }}</textarea>
                        @error('description') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Instructor Name</label>
                        <input type="text" name="instructor_name" class="form-control" value="{{ old('instructor_name') }}">
                        @error('instructor_name') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-semibold">
                            Max Students <small class="text-muted fw-normal">(leave blank for unlimited)</small>
                        </label>
                        <input type="number" name="max_students" class="form-control" value="{{ old('max_students') }}">
                        @error('max_students') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>
                    <div class="d-flex gap-2">
                        <button class="btn btn-accent px-4 fw-bold">Save</button>
                        <a href="{{ route('courses.index') }}" class="btn btn-dark-solid px-4">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection