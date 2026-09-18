@extends('layouts.app')

@section('title', $course->title)

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>{{ $course->title }}</h2>
        <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">Back to Dashboard</a>
    </div>

    @if($contents->isEmpty())
        <p class="text-muted">No content available yet.</p>
    @else
        <div class="accordion" id="courseContents">
            @foreach($contents as $content)
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button {{ $loop->first ? '' : 'collapsed' }}" type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#content-{{ $loop->index }}">
                        {{ $content->order }}. {{ $content->title }}
                        <span class="badge bg-secondary ms-2">{{ $content->type }}</span>
                    </button>
                </h2>
                <div id="content-{{ $loop->index }}"
                    class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}"
                    data-bs-parent="#courseContents">
                    <div class="accordion-body">
                        @if($content->type === 'video')
                            <a href="{{ $content->content_url_or_text }}" target="_blank" class="btn btn-primary">Watch Video</a>
                        @elseif($content->type === 'pdf')
                            <a href="{{ $content->content_url_or_text }}" target="_blank" class="btn btn-danger">Open PDF</a>
                        @else
                            <p>{{ $content->content_url_or_text }}</p>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
