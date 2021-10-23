@extends('auth/layouts/app')
@section('title', 'Register')

@section('content')
  <form action="/register/verified" method="POST">
    @csrf

    <div class="mb-3">
      <label for="username" class="form-label">Username</label>
      <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" value="{{ old('username') }}" autocomplete="username" autofocus>
      @error('username')
        <div class="form-text text-danger">{{ $message }}</div>  
      @enderror
    </div>
    
    <div class="mb-3">
      <label for="email" class="form-label">Email address</label>
      <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}">
      @error('email')
        <div class="form-text text-danger">{{ $message }}</div>  
      @enderror
    </div>
    
    <div class="mb-3">
      <label for="password" class="form-label">Password</label>
      <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" autocomplete="new-password">
      @error('password')
        <div class="form-text text-danger">{{ $message }}</div>  
      @enderror
    </div>
    
    <div class="mb-5">
      <label for="password-confirm" class="form-label">Confirm Password</label>
      <input type="password" class="form-control" id="password-confirm" name="password_confirmation" autocomplete="new-password">
    </div>
    
    <button type="submit" class="btn btn-primary float-end">Register</button>
  </form>
@endsection