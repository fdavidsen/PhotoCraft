@extends('admin/layouts/app')
@section('title', 'Change Username')

@section('content')
  <div id="change-username">
    <form action="/admin/account/change-username" method="POST">
      @csrf

      <div class="mb-5">
        <label for="username" class="form-label">New username</label>
        <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" value="{{ old('username') }}" autofocus>
        @error('username')
          <div class="form-text text-danger">{{ $message }}</div>  
        @enderror
      </div>

      <button type="submit" class="btn btn-primary float-end">Change my username</button>
    </form>
  </div>
@endsection