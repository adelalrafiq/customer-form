@extends('layouts.app')

@section('title', 'Login')
    
@section('content')
<h2>Login</h2>
<form method="POST" action="{{ route('login') }}">
    @csrf
    <div class="form-group">
        <label for="email">Email address</label>
        <input type="email" name="email" class="form-control" id="email" required>
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" class="form-control" id="password" required>
    </div>
    <div class="container-fluid full-height d-flex justify-content-center align-items-center">
    <button type="submit" class="btn btn-primary fab-extended">Login</button>
    </div>
</form>
<div class="container-fluid full-height d-flex justify-content-center align-items-center">
    <div class="text-left">
        <p class="mb-2">Email address: admin@gmail.com</p>
        <p>Password: admin</p>
    </div>
</div>
@endsection