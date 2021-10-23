<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    <link href="{{ asset('css/admin/styles.css') }}" rel="stylesheet">
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab&display=swap" rel="stylesheet">

    <title>@yield('title') - PhotoCraft</title>
  </head>
  <body class="pb-5">
    <nav class="navbar navbar-dark bg-dark shadow-sm fixed-top">
      <div class="container-fluid">
        <button class="navbar-toggler px-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar">
          <i class="fas fa-bars mx-1"></i>
          <span class="d-none d-md-inline me-1">Menu</span>
        </button>
        <h6 class="title fw-bold mb-0">@yield('title')</h6>
        <form action="/logout" method="POST" class="d-flex">
          @csrf
          <button type="submit" class="btn btn-sm btn-outline-success">Logout</button>
        </form>
      </div>
    </nav>

    <main class="container">
      <div class="row justify-content-center">
        <div class="col-md-6">
          <div class="card border-0">
            <div class="card-body">
              {{-- Message --}}
              @if (Session::has('message'))
                <div class="alert alert-warning alert-dismissible fade show mb-4" role="alert">
                  {{ Session::get('message') }}
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              @endif

              {{-- Content --}}
              @yield('content')
            </div>
          </div>
        </div>
      </div>
    </main>
    
    {{-- Sidebar --}}
    @include('admin/layouts/sidebar')
    


    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="{{ asset('js/admin/scripts.js') }}"></script>
    <script src="{{ asset('js/admin/message.js') }}"></script>
    <script src="{{ asset('js/admin/about-me.js') }}"></script>
    <script src="{{ asset('js/admin/photo-section.js') }}"></script>
  </body>
</html>