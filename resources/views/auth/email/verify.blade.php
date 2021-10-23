@extends('auth/layouts/app')
@section('title', 'Verify Email Address')

@section('content')
  <form action="/email/resend" method="POST" class="d-grid gap-2">
    @csrf
    <button type="submit" class="btn btn-primary">Resend verification link</button>
  </form>
@endsection