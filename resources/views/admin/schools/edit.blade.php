@extends('layouts.app')

@section('title', 'Edit School')

@section('hero')
    <p class="eyebrow">Admin — Schools</p>
    <h1>Edit School.</h1>
    <p class="sub">{{ $school->name }}</p>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="edu-card p-4">
                <form action="{{ route('schools.update', $school->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Name</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $school->name) }}">
                        @error('name') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Address</label>
                        <input type="text" name="address" class="form-control" value="{{ old('address', $school->address) }}">
                        @error('address') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Phone</label>
                        <input type="text" name="phone" class="form-control" value="{{ old('phone', $school->phone) }}">
                        @error('phone') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>
                    <div class="d-flex gap-2">
                        <button class="btn btn-accent px-4 fw-bold">Update</button>
                        <a href="{{ route('schools.index') }}" class="btn btn-dark-solid px-4">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection