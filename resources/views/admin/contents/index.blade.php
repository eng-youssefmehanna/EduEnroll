@extends('layouts.app')

@section('title', 'Contents — ' . $course->title)

@section('hero')
    <p class="eyebrow">Admin — Courses</p>
    <h1>{{ $course->title }}</h1>
    <p class="sub">Manage course content items.</p>
@endsection

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <span style="font-size:1rem; font-weight:700;">{{ $contents->count() }} item{{ $contents->count() !== 1 ? 's' : '' }}</span>
        <div class="d-flex gap-2">
            <a href="{{ route('courses.contents.create', $course) }}" class="btn btn-accent px-4">
                <i class="bi bi-plus-lg me-1"></i>Add Content
            </a>
            <a href="{{ route('courses.index') }}" class="btn btn-dark-solid px-4">
                <i class="bi bi-arrow-left me-1"></i>Back
            </a>
        </div>
    </div>

    @if($contents->isEmpty())
        <div class="text-center py-5 text-muted">
            <i class="bi bi-collection fs-1 d-block mb-3"></i>
            No content added yet.
        </div>
    @else
        <div class="edu-card">
            <table class="table edu-table mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Type</th>
                        <th>Order</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($contents as $content)
                    <tr>
                        <td class="text-muted">{{ $loop->iteration }}</td>
                        <td class="fw-semibold">{{ $content->title }}</td>
                        <td><span class="tag">{{ $content->type }}</span></td>
                        <td class="text-muted">{{ $content->order }}</td>
                        <td class="text-end">
                            <a href="{{ route('courses.contents.edit', [$course, $content]) }}"
                               class="btn btn-sm btn-dark-solid me-1">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('courses.contents.destroy', [$course, $content]) }}"
                                  method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm"
                                        style="background:#fee2e2;color:#dc2626;border:none;"
                                        onclick="return confirm('Delete this content?')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection