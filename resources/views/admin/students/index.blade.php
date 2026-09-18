@extends('layouts.app')

@section('title', 'Students')

@section('hero')
    <p class="eyebrow">Admin</p>
    <h1>Students.</h1>
    <p class="sub">Manage all registered students.</p>
@endsection

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <span style="font-size:1rem; font-weight:700;">{{ $students->count() }} student{{ $students->count() !== 1 ? 's' : '' }}</span>
        <a href="{{ route('students.create') }}" class="btn btn-accent px-4">
            <i class="bi bi-plus-lg me-1"></i>Add Student
        </a>
    </div>

    @if($students->isEmpty())
        <div class="text-center py-5 text-muted">
            <i class="bi bi-person-x fs-1 d-block mb-3"></i>
            No students yet.
        </div>
    @else
        <div class="edu-card">
            <table class="table edu-table mb-0">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Class</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($students as $student)
                    <tr>
                        <td class="fw-semibold">{{ $student->name }}</td>
                        <td class="text-muted">{{ $student->email }}</td>
                        <td>
                            @if($student->schoolClass)
                                <span class="tag">{{ $student->schoolClass->name }}</span>
                            @else
                                <span class="text-muted small">No Class</span>
                            @endif
                        </td>
                        <td class="text-end">
                            <a href="{{ route('students.edit', $student->id) }}"
                               class="btn btn-sm btn-dark-solid me-1">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('students.destroy', $student->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm"
                                        style="background:#fee2e2;color:#dc2626;border:none;"
                                        onclick="return confirm('Delete this student?')">
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