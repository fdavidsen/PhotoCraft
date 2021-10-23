@extends('auth/layouts/app')
@section('title', 'Verify Registration')

@section('content')
  <form action="/register/verify" method="POST">
    @csrf
    
    <div class="mb-5">
      <label for="password" class="form-label">Password</label>
      <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" autocomplete="current-password" autofocus>
      @error('password')
        <div class="form-text text-danger">{{ $message }}</div>  
      @enderror
    </div>
    
    <button type="submit" class="btn btn-primary float-end">Verify</button>
  </form>
@endsection