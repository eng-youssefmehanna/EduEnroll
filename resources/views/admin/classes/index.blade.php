@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Classes</h2>
        <a href="{{ route('classes.create') }}" class="btn btn-primary">Add Class</a>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>School</th>
                <th>Grade Level</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($classes as $class)
            <tr>
                <td>{{ $class->name }}</td>
                <td>{{ $class->school->name }}</td>
                <td>{{ $class->grade_level }}</td>
                <td>
                    <a href="{{ route('classes.edit', $class->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('classes.destroy', $class->id) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection