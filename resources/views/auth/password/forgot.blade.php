@extends('auth/layouts/app')
@section('title', 'Reset Password')

@section('content')
  <form action="/forgot-password" method="POST">
    @csrf

    <div class="mb-5">
      <label for="email" class="form-label">Email address</label>
      <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" autofocus>
      @error('email')
        <div class="form-text text-danger">{{ $message }}</div>  
      @enderror
    </div>

    <button type="submit" class="btn btn-primary float-end">Reset password</button>
  </form>
@endsection