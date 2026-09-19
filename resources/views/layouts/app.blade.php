<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Web Schools')</title>

  <link rel="icon" type="image/png" href="{{ asset('assets/images/favicon.ico') }}">
  <link rel="stylesheet" href="{{ asset('assets/libs/bootstrap/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/libs/bootstrap-icons/bootstrap-icons.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/libs/apexcharts/apexcharts.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/libs/flatpickr/flatpickr.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
  
  <style>
      body {
          background-color: #f8f9fa;
      }
      /* Header Fixed Top dengan Outline & Border Radius */
      .custom-header-nav {
          background: rgba(255, 255, 255, 0.95);
          backdrop-filter: blur(10px);
          border-radius: 1rem;
          border: 1px solid rgba(0, 0, 0, 0.08);
          box-shadow: 0 4px 20px rgba(0,0,0,0.03);
          margin: 10px auto 0 auto;
          max-width: 1280px;
          padding: 10px 24px;
      }
      /* Mengatur jarak konten agar tidak tertutup header fixed */
      .content-wrapper {
          margin-top: 100px; 
          max-width: 1280px;
      }
      .nav-center-menu .nav-link {
          color: #495057;
          font-weight: 500;
          padding: 8px 16px;
          border-radius: 50rem;
          transition: all 0.2s ease;
      }
      .nav-center-menu .nav-link:hover, 
      .nav-center-menu .nav-link.active {
          color: #0d6efd;
          background-color: rgba(13, 110, 253, 0.08);
      }
      .card-stat-solid { 
          border-radius: 1rem !important;
          transition: transform 0.3s ease; 
      }
      .card-stat-solid:hover { transform: translateY(-5px); }
  </style>
  
  @stack('styles')
</head>

<body>

  <!-- Panggil Header yang sudah dibuat sebelumnya secara otomatis -->
  @include('layouts.header')

  <!-- TEMPAT KONTEN UTAMA MASUK -->
  <div class="content-wrapper mx-auto px-3">
      @yield('content')

      <!-- FOOTER GLOBAL -->
      <footer class="custom-header-nav mb-4 py-3 text-center text-muted small border">
        <div>
          <span class="fw-bold text-dark"><i class="bi bi-mortarboard-fill text-primary"></i> WEB SCHOOLS</span> | &copy; 2026 Hak Cipta Dilindungi Undang-Undang.
        </div>
      </footer>
  </div>

  <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>
  <script src="{{ asset('assets/libs/flatpickr/flatpickr.min.js') }}"></script>
  <script src="{{ asset('assets/js/dashboard.js') }}"></script>
  
  @stack('scripts')
</body>

</html>