@extends('auth/layouts/app')
@section('title', 'Reset Password')

@section('content')
  <form action="/reset-password" method="POST">
    @csrf
    <input type="hidden" name="token" value="{{ $token }}">

    <div class="mb-3">
      <label for="email" class="form-label">Email address</label>
      <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" autofocus>
      @error('email')
        <div class="form-text text-danger">{{ $message }}</div>  
      @enderror
    </div>

    <div class="mb-3">
      <label for="password" class="form-label">New password</label>
      <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
      @error('password')
        <div class="form-text text-danger">{{ $message }}</div>  
      @enderror
    </div>

    <div class="mb-5">
      <label for="password-confirm" class="form-label">Confirm new password</label>
      <input type="password" class="form-control" id="password-confirm" name="password_confirmation">
    </div>

    <button type="submit" class="btn btn-primary float-end">Reset password</button>
  </form>
@endsection