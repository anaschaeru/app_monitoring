@extends('layouts.app')
@section('title', 'Welcome')
@section('content')
    <div class="container">
        <h1>Welcome to Monitoring Apps</h1>
        <p>This is a simple monitoring application for students.</p>
        <p><a href="{{ route('login') }}" class="btn btn-primary">Login</a></p>
    </div>
@endsection
