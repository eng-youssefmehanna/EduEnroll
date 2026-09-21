@extends('layouts.app')

@section('title', 'Add Content — ' . $course->title)

<<<<<<< HEAD
@section('hero')
    <p class="eyebrow">Admin — {{ $course->title }}</p>
    <h1>Add Content.</h1>
    <p class="sub">Add a new content item to this course.</p>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="edu-card p-4">
                @if($errors->any())
                    <div class="alert alert-danger border-0 rounded-3 mb-4">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('courses.contents.store', $course) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Title</label>
                        <input type="text" name="title" class="form-control" value="{{ old('title') }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Type</label>
                        <select name="type" class="form-select">
                            <option value="">Select Type</option>
                            <option value="video" {{ old('type') == 'video' ? 'selected' : '' }}>Video</option>
                            <option value="pdf"   {{ old('type') == 'pdf'   ? 'selected' : '' }}>PDF</option>
                            <option value="text"  {{ old('type') == 'text'  ? 'selected' : '' }}>Text</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Content (URL or Text)</label>
                        <textarea name="content_url_or_text" class="form-control" rows="4">{{ old('content_url_or_text') }}</textarea>
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Order</label>
                        <input type="number" name="order" class="form-control" value="{{ old('order', 1) }}" min="1">
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-accent px-4 fw-bold">Add Content</button>
                        <a href="{{ route('courses.contents.index', $course) }}" class="btn btn-dark-solid px-4">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
=======
@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Add Content — {{ $course->title }}</h2>
        <a href="{{ route('courses.contents.index', $course) }}" class="btn btn-outline-secondary">Back</a>
    </div>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('courses.contents.store', $course) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control" value="{{ old('title') }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Type</label>
            <select name="type" class="form-select">
                <option value="">-- Select Type --</option>
                <option value="video" {{ old('type') == 'video' ? 'selected' : '' }}>Video</option>
                <option value="pdf" {{ old('type') == 'pdf' ? 'selected' : '' }}>PDF</option>
                <option value="text" {{ old('type') == 'text' ? 'selected' : '' }}>Text</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Content (URL or Text)</label>
            <textarea name="content_url_or_text" class="form-control" rows="4">{{ old('content_url_or_text') }}</textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Order</label>
            <input type="number" name="order" class="form-control" value="{{ old('order', 1) }}" min="1">
        </div>
        <button type="submit" class="btn btn-primary">Add Content</button>
    </form>
</div>
@endsection
>>>>>>> 3319af2ead54f2c80c8479404738180b4d9c795a
