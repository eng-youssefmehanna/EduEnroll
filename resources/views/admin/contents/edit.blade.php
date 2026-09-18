@extends('layouts.app')

@section('title', 'Edit Content — ' . $course->title)

@section('hero')
    <p class="eyebrow">Admin — {{ $course->title }}</p>
    <h1>Edit Content.</h1>
    <p class="sub">{{ $content->title }}</p>
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

                <form action="{{ route('courses.contents.update', [$course, $content]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Title</label>
                        <input type="text" name="title" class="form-control" value="{{ old('title', $content->title) }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Type</label>
                        <select name="type" class="form-select">
                            <option value="">Select Type</option>
                            <option value="video" {{ old('type', $content->type) == 'video' ? 'selected' : '' }}>Video</option>
                            <option value="pdf"   {{ old('type', $content->type) == 'pdf'   ? 'selected' : '' }}>PDF</option>
                            <option value="text"  {{ old('type', $content->type) == 'text'  ? 'selected' : '' }}>Text</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Content (URL or Text)</label>
                        <textarea name="content_url_or_text" class="form-control" rows="4">{{ old('content_url_or_text', $content->content_url_or_text) }}</textarea>
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Order</label>
                        <input type="number" name="order" class="form-control" value="{{ old('order', $content->order) }}" min="1">
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-accent px-4 fw-bold">Update Content</button>
                        <a href="{{ route('courses.contents.index', $course) }}" class="btn btn-dark-solid px-4">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection