@extends('layouts.app')

@section('content')
<div class="container text-center mt-5">
    <h1>Selamat Datang di Website Kami</h1>

    @auth
        <p>Halo, {{ Auth::user()->name }}!</p>
        <a href="{{ route('dashboard') }}" class="btn btn-success m-2">Go to Dashboard</a>
        <form action="{{ route('logout') }}" method="POST" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-danger">Logout</button>
        </form>
    @else
        <a href="{{ route('login') }}" class="btn btn-primary m-2">Login</a>
        <a href="{{ route('register') }}" class="btn btn-outline-primary m-2">Register</a>
    @endauth
</div>
@endsection
