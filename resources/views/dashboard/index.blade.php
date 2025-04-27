@extends('layouts.app')

@section('content')

<div class="container">
    @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <h2>Welcome, {{ $user['name'] ?? 'Guest' }}</h2>

    <p>Email: {{ $user['email'] ?? 'N/A' }}</p>
    <a href="{{url('logout')}}" class="btn btn-primary" role="button">Logout</a>
    <a href="{{url('change-password')}}" class="btn btn-primary" role="button">Change Password</a>
</div>
@endsection