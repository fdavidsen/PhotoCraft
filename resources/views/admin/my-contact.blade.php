@extends('admin/layouts/app')
@section('title', 'My Contact')

@section('content')
  <div id="my-contact">
    <form action="/admin/interface/contact/update" method="POST">
      @csrf

      <div class="mb-4">
        <label for="greetings" class="form-label">
          <i class="fas fa-smile me-1"></i>
          Greetings
        </label>
        <textarea class="form-control @error('greetings') is-invalid @enderror" id="greetings" name="greetings" maxlength="1000" rows="5">{{ $admin->greetings }}</textarea>
        @error('greetings')
          <div class="form-text text-danger">{{ $message }}</div>  
        @enderror
      </div>

      <div class="mb-3">
        <label for="email" class="form-label">
          <i class="fas fa-envelope me-1"></i>
          Email
        </label>
        <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="photocraft8@gmail.com" value="{{ $admin->email }}">
        @error('email')
          <div class="form-text text-danger">{{ $message }}</div>  
        @enderror
      </div>
      
      <div class="mb-3">
        <label for="phone" class="form-label">
          <i class="fas fa-phone me-1"></i>
          Phone
        </label>
        <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" placeholder="081234567890" value="{{ $admin->phone }}">
        @error('phone')
          <div class="form-text text-danger">{{ $message }}</div>  
        @enderror
      </div>
      
      <div class="mb-3">
        <label for="location" class="form-label">
          <i class="fas fa-map-marker-alt me-1"></i>
          Location
        </label>
        <input type="text" class="form-control @error('location') is-invalid @enderror" id="location" name="location" placeholder="Medan, ID" value="{{ $admin->location }}">
        @error('location')
          <div class="form-text text-danger">{{ $message }}</div>  
        @enderror
      </div>
      
      <div class="mb-3">
        <label for="facebook" class="form-label">
          <i class="fab fa-facebook-f me-1"></i>
          Facebook
        </label>
        <input type="text" class="form-control @error('facebook') is-invalid @enderror" id="facebook" name="facebook" placeholder="Facebook username" value="{{ $admin->facebook }}">
        @error('facebook')
          <div class="form-text text-danger">{{ $message }}</div>  
        @enderror
      </div>

      <div class="mb-3">
        <label for="twitter" class="form-label">
          <i class="fab fa-twitter me-1"></i>
          Twitter
        </label>
        <input type="text" class="form-control @error('twitter') is-invalid @enderror" id="twitter" name="twitter" placeholder="Twitter username" value="{{ $admin->twitter }}">
        @error('twitter')
          <div class="form-text text-danger">{{ $message }}</div>  
        @enderror
      </div>

      <div class="mb-3">
        <label for="telegram" class="form-label">
          <i class="fab fa-telegram-plane me-1"></i>
          Telegram
        </label>
        <input type="text" class="form-control @error('telegram') is-invalid @enderror" id="telegram" name="telegram" placeholder="Telegram username" value="{{ $admin->telegram }}">
        @error('telegram')
          <div class="form-text text-danger">{{ $message }}</div>  
        @enderror
      </div>

      <div class="mb-3">
        <label for="instagram" class="form-label">
          <i class="fab fa-instagram me-1"></i>
          Instagram
        </label>
        <input type="text" class="form-control @error('instagram') is-invalid @enderror" id="instagram" name="instagram" placeholder="Instagram username" value="{{ $admin->instagram }}">
        @error('instagram')
          <div class="form-text text-danger">{{ $message }}</div>  
        @enderror
      </div>

      <div class="mb-5">
        <label for="whatsapp" class="form-label">
          <i class="fab fa-whatsapp me-1"></i>
          WhatsApp
        </label>
        <input type="text" class="form-control @error('whatsapp') is-invalid @enderror" id="whatsapp" name="whatsapp" placeholder="+6281234567890" value="{{ $admin->whatsapp }}">
        @error('whatsapp')
          <div class="form-text text-danger">{{ $message }}</div>  
        @enderror
      </div>

      <button type="submit" class="btn btn-primary float-end"><i class="fas fa-save text-white me-1"></i> Save</button>
    </form>
  </div>
@endsection