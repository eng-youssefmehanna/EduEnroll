@extends('layouts.app')

@section('content')
    <h2>Dashboard</h2>
    <p>Welcome, {{ Auth::user()->name }}. You are logged in.</p>
@endsection