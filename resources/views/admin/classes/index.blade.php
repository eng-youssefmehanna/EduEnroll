@extends('layouts.app')

@section('title', 'Classes')

@section('hero')
    <p class="eyebrow">Admin</p>
    <h1>Classes.</h1>
    <p class="sub">Manage all classes across schools.</p>
@endsection

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <span style="font-size:1rem; font-weight:700;">{{ $classes->count() }} class{{ $classes->count() !== 1 ? 'es' : '' }}</span>
        <a href="{{ route('classes.create') }}" class="btn btn-accent px-4">
            <i class="bi bi-plus-lg me-1"></i>Add Class
        </a>
    </div>

    @if($classes->isEmpty())
        <div class="text-center py-5 text-muted">
            <i class="bi bi-collection fs-1 d-block mb-3"></i>
            No classes yet.
        </div>
    @else
        <div class="edu-card">
            <table class="table edu-table mb-0">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>School</th>
                        <th>Grade Level</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($classes as $class)
                    <tr>
                        <td class="fw-semibold">{{ $class->name }}</td>
                        <td class="text-muted">{{ $class->school->name }}</td>
                        <td><span class="tag">{{ $class->grade_level }}</span></td>
                        <td class="text-end">
                            <a href="{{ route('classes.edit', $class->id) }}"
                               class="btn btn-sm btn-dark-solid me-1">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('classes.destroy', $class->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm"
                                        style="background:#fee2e2;color:#dc2626;border:none;"
                                        onclick="return confirm('Delete this class?')">
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