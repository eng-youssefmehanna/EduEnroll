@extends('layouts.app')

@section('title', 'Enrollments')

@section('hero')
    <p class="eyebrow">Admin</p>
    <h1>Enrollments.</h1>
    <p class="sub">View all student course enrollments.</p>
@endsection

@section('content')
    @if($enrollments->isEmpty())
        <div class="text-center py-5 text-muted">
            <i class="bi bi-people fs-1 d-block mb-3"></i>
            No enrollments yet.
        </div>
    @else
        <div class="edu-card">
            <table class="table edu-table mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Student</th>
                        <th>Email</th>
                        <th>Course</th>
                        <th>Enrolled At</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($enrollments as $enrollment)
                    <tr>
                        <td class="text-muted">{{ $loop->iteration }}</td>
                        <td class="fw-semibold">{{ $enrollment->student->name }}</td>
                        <td class="text-muted">{{ $enrollment->student->email }}</td>
                        <td>{{ $enrollment->course->title }}</td>
                        <td class="text-muted">{{ $enrollment->enrolled_at->format('Y-m-d H:i') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection