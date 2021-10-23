@extends('admin/layouts/app')
@section('title', 'Change Password')

@section('content')
  <div id="change-password">
    <form action="/admin/account/change-password" method="POST">
      @csrf

      <div class="mb-3">
        <label for="old-password" class="form-label">Old password</label>
        <input type="password" class="form-control @error('old_password') is-invalid @enderror" id="old-password" name="old_password" autocomplete="current-password" autofocus>
        @error('old_password')
          <div class="form-text text-danger">{{ $message }}</div>  
        @enderror
      </div>

      <div class="mb-3">
        <label for="new-password" class="form-label">New password</label>
        <input type="password" class="form-control @error('new_password') is-invalid @enderror" id="new-password" name="new_password" autocomplete="new-password">
        @error('new_password')
          <div class="form-text text-danger">{{ $message }}</div>  
        @enderror
      </div>

      <div class="mb-5">
        <label for="new-password-confirm" class="form-label">Confirm new password</label>
        <input type="password" class="form-control" id="new-password-confirm" name="new_password_confirmation" autocomplete="new-password">
      </div>

      <button type="submit" class="btn btn-primary float-end">Update password</button>
    </form>
  </div>
@endsection