@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Add School</h2>
    <form action="{{ route('schools.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}">
            @error('name') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label>Address</label>
            <input type="text" name="address" class="form-control" value="{{ old('address') }}">
            @error('address') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label>Phone</label>
            <input type="text" name="phone" class="form-control" value="{{ old('phone') }}">
            @error('phone') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <button class="btn btn-primary">Save</button>
        <a href="{{ route('schools.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection