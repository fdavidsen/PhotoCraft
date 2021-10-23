<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    <link href="{{ asset('css/home/styles.css') }}" rel="stylesheet">
    <link href="{{ asset('css/home/topbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/home/skin-zest.min.css') }}" rel="stylesheet" media="screen">
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab&display=swap" rel="stylesheet">
    
    <title>{{ $admin->first_name . $admin->last_name }} - PhotoCraft</title>
  </head>
  <body data-bs-spy="scroll" data-bs-target="#navbarNav">
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top py-3">
      <div class="container-fluid">
        <a class="navbar-brand me-5" href="#">
          <i class="fas fa-camera me-1"></i>
          {{ $admin->first_name }}<span>{{ $admin->last_name }}</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <div class="navbar-nav ms-auto">
            <a class="nav-link px-4 active" href="#home">Home</a>
            <a class="nav-link px-4" href="#portfolio">Portfolio</a>
            <a class="nav-link px-4" href="#about">About</a>
            <a class="nav-link px-4" href="#contact">Contact</a>
          </div>
        </div>
      </div>
    </nav>

    <div class="section py-0" id="home">
      <div id="carouselIndicators" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-indicators">
          @for ($i = 0; $i < count($carousel); $i++)
            <button type="button" class="{{ $i == 0 ? 'active' : '' }}" data-bs-target="#carouselIndicators" data-bs-slide-to="{{ $i }}" aria-current="true" aria-label="Slide {{ $i + 1 }}"></button>
          @endfor
        </div>

        <div class="carousel-inner">
          @php $i = 0 @endphp
          @foreach ($carousel as $item)
            <div class="carousel-item {{ $i == 0 ? 'active' : '' }}" data-bs-interval="10000">
              <img class="lazy d-block w-100" data-src="{{ asset('img/photo/' . $item->filename) }}" alt="{{ $item->caption }}">
              <div class="carousel-caption">
                <p class="text-break-spaces">{{ $item->caption }}</p>
              </div>
            </div>
            @php $i++ @endphp
          @endforeach
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#carouselIndicators" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselIndicators" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    </div>

    <div class="section" id="portfolio">
      <div class="container-fluid">
        <div class="row text-center mb-5">
          <h1 class="text-uppercase underline">Portfolio</h1>
        </div>
        <div class="row justify-content-center bg-dark">
          @foreach ($portfolio as $item)
            <div class="photo col-4 p-0">
              <a class="lightbox" data-lightbox-gallery="portfolio" href="{{ asset('img/photo/' . $item->filename) }}" title="{{ $item->caption }}">
                <div class="lazy lightbox-img w-100" data-bg="{{ asset('img/photo/' . $item->filename) }}"></div>
              </a>
            </div>
          @endforeach
        </div>
      </div>
    </div>

    <div class="section" id="about">
      <div class="container">
        <div class="row text-center">
          <h1 class="d-md-none text-uppercase underline">About Me</h1>
        </div>
        <div class="row align-items-center justify-content-center">
          <div class="col-md-4 text-center">
            <img class="w-100 mt-5 mb-3" src="{{ asset('img/' . $admin->photo) }}" alt="{{ $admin->first_name . $admin->last_name }}">
            <h4 class="mb-4">{{ $admin->first_name . ' ' . $admin->last_name }}</h4>
          </div>
          <div class="col-md-8">
            <h2 class="d-none d-md-block text-uppercase underline mb-5">About Me</h2>
            <p class="text-break-spaces mb-4" id="bio">{{ $admin->bio }}</p>
            <div id="skills-container">
              @foreach (json_decode($admin->skills) as $item)
                <p class="mb-1">{{ $item->name }} <span class="percentage ms-3">{{ $item->percentage }}</span></p>
                <div class="progress mb-3">
                  <div class="progress-bar" role="progressbar" aria-valuenow="{{ $item->percentage }}" aria-valuemin="0" aria-valuemax="100"></div>
                </div>                
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="section" id="contact">
      <div class="container">
        <div class="row text-center mb-5">
          <h1 class="text-uppercase underline">Contact Me</h1>
        </div>
        <div class="row align-items-center justify-content-center">
          <div class="col-md-5">
            <div class="card mb-5">
              <div class="card-body">
                <h5 class="card-title mb-0">Let's Contact!</h5>
                <p class="card-text text-break-spaces mt-2">{{ $admin->greetings }}</p>
              </div>
              <ul class="list-group list-group-flush border-bottom-0">
                @if ($admin->email)
                  <li class="list-group-item border-0"><i class="fas fa-envelope"></i>{{ $admin->email }}</li>
                @endif
                @if ($admin->phone)
                  <li class="list-group-item border-0"><i class="fas fa-phone"></i>{{ $admin->phone }}</li>
                @endif
                @if ($admin->location)
                  <li class="list-group-item border-0"><i class="fas fa-map-marker-alt me-3"></i>{{ $admin->location }}</li>
                @endif
              </ul>
              <div class="d-flex justify-content-evenly">
                @if ($admin->facebook)
                  <a href="https://facebook.com/{{ $admin->facebook }}" class="card-link"><i class="fab fa-facebook-f"></i></a>  
                @endif
                @if ($admin->twitter)
                  <a href="https://twitter.com/{{ $admin->twitter }}" class="card-link"><i class="fab fa-twitter"></i></a>  
                @endif
                @if ($admin->telegram)
                  <a href="https://t.me/{{ $admin->telegram }}" class="card-link"><i class="fab fa-telegram-plane"></i></a>  
                @endif
                @if ($admin->instagram)
                  <a href="https://www.instagram.com/{{ $admin->instagram }}" class="card-link"><i class="fab fa-instagram"></i></a>
                @endif
                @if ($admin->whatsapp)
                  <a href="https://wa.me/{{ $admin->whatsapp }}?text=Hello%2C+..." class="card-link"><i class="fab fa-whatsapp"></i></a>
                @endif
              </div>
            </div>
          </div>
          <div class="col-md-7">
            <form>             
              <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name">
                <div class="form-text text-danger"></div>  
              </div>

              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" id="email">
                <div class="form-text text-danger"></div>  
              </div>

              <div class="mb-3">
                <label for="message" class="form-label">Message</label>
                <div class="position-relative">
                  <textarea class="form-control" id="message" maxlength="1000" rows="5"></textarea>
                  <span class="limit text-muted small">1000</span>
                  <div class="form-text text-danger"></div>
                </div>
              </div>

              <div class="alert alert-warning d-none" role="alert"></div>

              <div class="d-grid gap-2 mt-5">
                <button type="submit" class="btn btn-dark">Send</button>
                <button type="button" class="btn btn-dark d-none" disabled>
                  <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                  Loading...
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <footer class="bg-dark text-light small p-3">
      Developed by <a href="https://fdavidsen.ml">FredericD</a>
      <a class="float-end" href="/admin">Admin</a>
    </footer>
    

    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/vanilla-lazyload@17.4.0/dist/lazyload.min.js"></script>
    <script src="{{ asset('js/home/topbox.min.js') }}"></script>
    <script src="{{ asset('js/home/scripts.js') }}"></script>
  </body>
</html>