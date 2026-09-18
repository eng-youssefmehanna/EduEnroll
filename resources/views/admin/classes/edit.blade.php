@extends('layouts.app')

@section('title', 'Edit Class')

@section('hero')
    <p class="eyebrow">Admin — Classes</p>
    <h1>Edit Class.</h1>
    <p class="sub">{{ $class->name }}</p>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="edu-card p-4">
                <form action="{{ route('classes.update', $class->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label fw-semibold">School</label>
                        <select name="school_id" class="form-select">
                            <option value="">Select School</option>
                            @foreach($schools as $school)
                                <option value="{{ $school->id }}" {{ $class->school_id === $school->id ? 'selected' : '' }}>
                                    {{ $school->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('school_id') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Name</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $class->name) }}">
                        @error('name') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Grade Level</label>
                        <input type="text" name="grade_level" class="form-control" value="{{ old('grade_level', $class->grade_level) }}">
                        @error('grade_level') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>
                    <div class="d-flex gap-2">
                        <button class="btn btn-accent px-4 fw-bold">Update</button>
                        <a href="{{ route('classes.index') }}" class="btn btn-dark-solid px-4">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection