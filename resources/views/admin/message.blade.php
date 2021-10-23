@extends('admin/layouts/app')
@section('title', 'Message')

@section('content')
  <div id="message">
    <div class="d-flex justify-content-end">
      <button type="button" class="btn btn-light position-relative me-2" id="read" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Mark all as read">
        <i class="fas fa-envelope-open text-secondary"></i>
        <span class="badge bg-danger rounded-circle p-1 ms-1">{{ $unread_count != 0 ? $unread_count : '' }}</span>
      </button>

      <div class="notification-container">
        <button type="button" class="btn btn-light" id="notification" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Turn on/off email notifications for new messages">
          <i class="fas {{ $setting->email_notification == 1 ? 'fa-bell' : 'fa-bell-slash text-secondary' }}"></i>
        </button>
        <button class="btn btn-light d-none" type="button" disabled>
          <span class="spinner-border spinner-border-sm text-muted" role="status" aria-hidden="true"></span>
          <span class="visually-hidden">Loading...</span>
        </button>
      </div>
    </div>

    <div class="d-flex">
      <input class="form-control" type="search" placeholder="Search" aria-label="Search">
    </div>
    
    @foreach ($message as $item)
      <div class="card mb-3 {{ $item->seen == 0 ? 'border-warning' : '' }}" id="message-{{ $item->id }}" data-id="{{ $item->id }}" data-search="{{ $item->name . ' ' . $item->email . ' ' . $item->message }}">
        <div class="card-header">
          <div class="row align-items-center">
            <div class="col-auto">
              <div class="user-icon bg-dark text-center">
                <i class="fas fa-user"></i>
              </div>
            </div>
            <div class="col px-0">
              <h6 class="mb-0">{{ $item->name }}</h6>
              <small>{{ $item->email }}</small>
            </div>
            <div class="col-auto ps-1">
              {{ $item->received_at }}
            </div>
          </div>
        </div>
        <div class="card-body">
          <p class="card-text">{{ $item->message }}</p>
          <i class="fas fa-trash-alt delete" data-id="{{ $item->id }}"></i>
        </div> 
      </div>
    @endforeach
  </div>
@endsection