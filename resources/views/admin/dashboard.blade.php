@extends('admin/layouts/app')
@section('title', 'Dashboard')

@section('content')
  <div id="dashboard">
    <a href="/admin/core/message" class="card border-start-primary text-decoration-none mb-3">
      <div class="card-body">
        <div class="row align-items-center px-1">
          <div class="col">
            <h6 class="fw-bold text-primary text-uppercase mb-1">Unread Messages</h6>
            <h5 class="fw-bold mb-0">{{ $unread_count }}</h5>
          </div>
          <div class="col-auto">
            <i class="fas fa-envelope-open"></i>
          </div>
        </div>
      </div>
    </a>

    <div class="card border-start-secondary mb-3">
      <div class="card-body">
        <div class="row align-items-center px-1">
          <div class="col">
            <h6 class="fw-bold text-secondary text-uppercase mb-1">Today's Visitors</h6>
            <h5 class="fw-bold mb-0">{{ $today_visitors }}</h5>
          </div>
          <div class="col-auto">
            <i class="fas fa-user-tie"></i>
          </div>
        </div>
      </div>
    </div>

    <div class="card border-start-success mb-3">
      <div class="card-body">
        <div class="row align-items-center px-1">
          <div class="col">
            <h6 class="fw-bold text-success text-uppercase mb-1">Total Unique Visitors</h6>
            <h5 class="fw-bold mb-0">{{ $unique_visitors }}</h5>
          </div>
          <div class="col-auto">
            <i class="fas fa-user-secret"></i>
          </div>
        </div>
      </div>
    </div>

    <div class="card border-start-warning mb-3">
      <div class="card-body">
        <div class="row align-items-center px-1">
          <div class="col">
            <h6 class="fw-bold text-warning text-uppercase mb-1">Total Visitors</h6>
            <h5 class="fw-bold mb-0">{{ $total_visitors }}</h5>
          </div>
          <div class="col-auto">
            <i class="fas fa-users"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection