@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Schools</h2>
        <a href="{{ route('schools.create') }}" class="btn btn-primary">Add School</a>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Address</th>
                <th>Phone</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($schools as $school)
            <tr>
                <td>{{ $school->name }}</td>
                <td>{{ $school->address }}</td>
                <td>{{ $school->phone }}</td>
                <td>
                    <a href="{{ route('schools.edit', $school->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('schools.destroy', $school->id) }}" method="POST" style="display:inline">
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