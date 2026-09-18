@extends('layouts.app')

@section('title', 'Add Student')

@section('hero')
    <p class="eyebrow">Admin — Students</p>
    <h1>Add Student.</h1>
    <p class="sub">Register a new student account.</p>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="edu-card p-4">
                <form action="{{ route('students.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Name</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                        @error('name') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                        @error('email') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Password</label>
                        <input type="password" name="password" class="form-control">
                        @error('password') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Class</label>
                        <select name="class_id" class="form-select">
                            <option value="">Select Class</option>
                            @foreach($classes as $class)
                                <option value="{{ $class->id }}" {{ old('class_id') == $class->id ? 'selected' : '' }}>
                                    {{ $class->school->name }} — {{ $class->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('class_id') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>
                    <div class="d-flex gap-2">
                        <button class="btn btn-accent px-4 fw-bold">Save</button>
                        <a href="{{ route('students.index') }}" class="btn btn-dark-solid px-4">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection