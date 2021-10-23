@extends('auth/layouts/app')
@section('title', 'Login')

@section('content')
  <form action="/login" method="POST">
    @csrf

    <div class="mb-3">
      <label for="username" class="form-label">Username</label>
      <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" value="{{ old('username') }}" autocomplete="username" autofocus>
      @error('username')
        <div class="form-text text-danger">{{ $message }}</div>  
      @enderror
    </div>

    <div class="mb-3">
      <label for="password" class="form-label">Password</label>
      <a class="small text-decoration-none float-end" href="/forgot-password">Forgot password?</a>
      <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" autocomplete="current-password">
      @error('password')
        <div class="form-text text-danger">{{ $message }}</div>  
      @enderror
    </div>

    <div class="form-check mb-5">
      <input type="checkbox" class="form-check-input" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
      <label class="form-check-label" for="remember">Remember me</label>
    </div>
    <button type="submit" class="btn btn-primary float-end">Login</button>
  </form>
@endsection