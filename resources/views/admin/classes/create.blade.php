@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Add Class</h2>
    <form action="{{ route('classes.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>School</label>
            <select name="school_id" class="form-control">
                <option value="">Select School</option>
                @foreach($schools as $school)
                    <option value="{{ $school->id }}">{{ $school->name }}</option>
                @endforeach
            </select>
            @error('school_id') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}">
            @error('name') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label>Grade Level</label>
            <input type="text" name="grade_level" class="form-control" value="{{ old('grade_level') }}">
            @error('grade_level') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <button class="btn btn-primary">Save</button>
        <a href="{{ route('classes.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection