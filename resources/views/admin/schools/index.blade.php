@extends('layouts.app')

@section('title', 'Schools')

@section('hero')
    <p class="eyebrow">Admin</p>
    <h1>Schools.</h1>
    <p class="sub">Manage all schools in the system.</p>
@endsection

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <span style="font-size:1rem; font-weight:700;">{{ $schools->count() }} school{{ $schools->count() !== 1 ? 's' : '' }}</span>
        <a href="{{ route('schools.create') }}" class="btn btn-accent px-4">
            <i class="bi bi-plus-lg me-1"></i>Add School
        </a>
    </div>

    @if($schools->isEmpty())
        <div class="text-center py-5 text-muted">
            <i class="bi bi-building fs-1 d-block mb-3"></i>
            No schools yet.
        </div>
    @else
        <div class="edu-card">
            <table class="table edu-table mb-0">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($schools as $school)
                    <tr>
                        <td class="fw-semibold">{{ $school->name }}</td>
                        <td class="text-muted">{{ $school->address }}</td>
                        <td class="text-muted">{{ $school->phone }}</td>
                        <td class="text-end">
                            <a href="{{ route('schools.edit', $school->id) }}"
                               class="btn btn-sm btn-dark-solid me-1">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('schools.destroy', $school->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm"
                                        style="background:#fee2e2;color:#dc2626;border:none;"
                                        onclick="return confirm('Delete this school?')">
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