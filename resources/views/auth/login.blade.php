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
    <button type="submit" class="btn btn-primary">Login</button>
</form>
@endsection