<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ config('app.name', 'Book Reviews') }}</title>

  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Font Awesome for animated stars -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

  <!-- Optional: Bootstrap Icons if needed -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

  <!-- 🔥 Custom Styles -->
  <style>
    /* ⭐ Navbar star animation */
    .star-icon .star {
      color: gold;
      margin-right: 2px;
      opacity: 0.2;
      transition: opacity 0.4s, transform 0.4s;
    }

    /* Card star animation if needed elsewhere */
    .star-animate {
      opacity: 0;
      animation: fillStar 1s forwards;
    }
    .star-animate:nth-child(1) { animation-delay: 0s; }
    .star-animate:nth-child(2) { animation-delay: 0.2s; }
    .star-animate:nth-child(3) { animation-delay: 0.4s; }
    .star-animate:nth-child(4) { animation-delay: 0.6s; }
    .star-animate:nth-child(5) { animation-delay: 0.8s; }

    @keyframes fillStar {
      to {
        opacity: 1;
        transform: scale(1.2);
      }
    }

    /* ✅ Highlighted navbar logo */
    .navbar-brand img {
      height: 60px;
      width: auto;
      object-fit: contain;
      max-height: 80px;
      padding: 4px;
      background: #fff; /* White highlight behind logo */
      border-radius: 6px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
      transition: transform 0.3s, box-shadow 0.3s;
    }

    .navbar-brand img:hover {
      transform: scale(1.05);
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.25);
    }

    .navbar-brand {
      display: flex;
      align-items: center;
    }

    /* ✅ Body background image */
    body {
          background: url('{{ asset('images/background.jpg') }}') no-repeat center center fixed;
          background-size: cover;
          filter: brightness(0.9);
    }
  </style>

<style>
  .card,.justify-content-center {
    background-color: rgba(255, 255, 255, 0.9) !important; /* Semi-transparent white */
    border: 1px; /* Optional: remove border if you want a cleaner look */
    backdrop-filter: blur(1.5px); /* Optional: subtle blur effect behind card */
  }



  .bg-primary, .btn-primary{
    background-color: #dc3545!important;
  }

  .btn-primary {
    --bs-btn-color: #fff;
    --bs-btn-bg:#dc3545!important;
    --bs-btn-border-color: #dc3545!important;
    --bs-btn-hover-color: #fff;
    --bs-btn-hover-bg: #dc3545!important;
    --bs-btn-hover-border-color: #dc3545!important;
    --bs-btn-focus-shadow-rgb: 49, 132, 253;
    --bs-btn-active-color: #fff;
    --bs-btn-active-bg: #dc3545!important;
    --bs-btn-active-border-color: #dc3545!important;
    --bs-btn-active-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);
    --bs-btn-disabled-color: #fff;
    --bs-btn-disabled-bg: #dc3545!important;
    --bs-btn-disabled-border-color: #dc3545!important;
}

.btn-outline-primary {
    --bs-btn-color: #000!important;
    --bs-btn-border-color: #dc3545!important;;
    --bs-btn-hover-color: #fff;
    --bs-btn-hover-bg: #dc3545!important;;
    --bs-btn-hover-border-color: #dc3545!important;;
    --bs-btn-focus-shadow-rgb: 13, 110, 253;
    --bs-btn-active-color: #fff;
    --bs-btn-active-bg: #dc3545!important;;
    --bs-btn-active-border-color: #dc3545!important;;
    --bs-btn-active-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);
    --bs-btn-disabled-color: #dc3545!important;;
    --bs-btn-disabled-bg: transparent;
    --bs-btn-disabled-border-color: #dc3545!important;;
    --bs-gradient: none;
}
a{
  color:#dc3545;
}
 
</style>
</head>

<body>
  <!-- ✅ Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
    <div class="container">
      <a class="navbar-brand" href="{{ url('/books') }}">
        <img src="{{ asset('images/logo.png') }}" alt="Book Reviews">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
              data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
              aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link d-flex align-items-center gap-1" href="{{ route('index') }}">
              <span class="star-icon">
                <i class="far fa-star star"></i>
                <i class="far fa-star star"></i>
                <i class="far fa-star star"></i>
                <i class="far fa-star star"></i>
                <i class="far fa-star star"></i>
              </span>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- ✅ Main content -->
  <main class="container">
    @yield('content')
  </main>

  <!-- ✅ Footer -->
  <footer class="bg-light text-center text-muted py-3 mt-5">
    <div class="container">
      &copy; {{ date('Y') }} {{ config('app.name', 'Book Reviews') }}. All rights reserved.
    </div>
  </footer>

  <!-- ✅ Bootstrap Bundle JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

  <!-- ✅ Animated stars script -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const stars = document.querySelectorAll('.star-icon .star');
      stars.forEach((star, index) => {
        setTimeout(() => {
          star.classList.remove('far'); // empty star
          star.classList.add('fas');    // filled star
          star.style.opacity = 1;
          star.style.transform = 'scale(1.2)';
        }, index * 1000); // one star fills every second
      });
    });
  </script>
</body>
</html>
