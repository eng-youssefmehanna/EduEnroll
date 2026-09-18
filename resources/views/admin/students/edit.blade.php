@extends('layouts.app')

@section('title', 'Edit Student')

@section('hero')
    <p class="eyebrow">Admin — Students</p>
    <h1>Edit Student.</h1>
    <p class="sub">{{ $student->name }}</p>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="edu-card p-4">
                <form action="{{ route('students.update', $student->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Name</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $student->name) }}">
                        @error('name') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', $student->email) }}">
                        @error('email') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">
                            Password <small class="text-muted fw-normal">(leave blank to keep current)</small>
                        </label>
                        <input type="password" name="password" class="form-control">
                        @error('password') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Class</label>
                        <select name="class_id" class="form-select">
                            <option value="">Select Class</option>
                            @foreach($classes as $class)
                                <option value="{{ $class->id }}" {{ $student->class_id === $class->id ? 'selected' : '' }}>
                                    {{ $class->school->name }} — {{ $class->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('class_id') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>
                    <div class="d-flex gap-2">
                        <button class="btn btn-accent px-4 fw-bold">Update</button>
                        <a href="{{ route('students.index') }}" class="btn btn-dark-solid px-4">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection