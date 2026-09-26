<!-- ==========================================
     START: Header / Navbar Template (Fixed Top)
     ========================================== -->
<header class="fixed-top px-3 py-2">
  <nav class="custom-header-nav d-flex flex-wrap align-items-center justify-content-between">
    
    <!-- Logo Baru (Ikon Buku/Akademik + Outline Tipis) -->
    <a href="/" class="d-flex align-items-center text-dark text-decoration-none">
      <div class="bg-primary text-white p-2 rounded-3 me-2 d-flex align-items-center justify-content-center shadow-sm" style="width: 38px; height: 38px;">
        <i class="bi bi-mortarboard-fill fs-5"></i>
      </div>
      <div>
        <span class="fw-bold fs-6 tracking-wide text-dark d-block lh-1">WEB SCHOOLS</span>
        <small class="text-muted" style="font-size: 10px;">PORTAL EDUKASI</small>
      </div>
    </a>

    <!-- Menu Navigasi di Tengah (Center) -->
    <ul class="nav nav-center-menu align-items-center my-2 my-lg-0">
      <li class="nav-item"><a href="/" class="nav-link {{ Request::is('/') ? 'active' : '' }}">Beranda</a></li>
      <li class="nav-item"><a href="/profil" class="nav-link {{ Request::is('profil') ? 'active' : '' }}">Profil Sekolah</a></li>
      <li class="nav-item"><a href="/ekstrakurikuler" class="nav-link {{ Request::is('ekstrakurikuler') ? 'active' : '' }}">Ekstrakurikuler</a></li>
      <li class="nav-item"><a href="/galeri" class="nav-link {{ Request::is('galeri') ? 'active' : '' }}">Galeri</a></li>
      <li class="nav-item"><a href="/berita" class="nav-link {{ Request::is('berita') ? 'active' : '' }}">Berita</a></li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle {{ Request::is('guru*') || Request::is('siswa*') ? 'active' : '' }}" href="#" data-bs-toggle="dropdown">Akademik</a>
        <ul class="dropdown-menu shadow border-0 rounded-4 p-2">
          <li><a class="dropdown-item rounded-3 py-2" href="/guru"><i class="bi bi-person-badge me-2 text-success"></i> Data Guru</a></li>
          <li><a class="dropdown-item rounded-3 py-2" href="/siswa"><i class="bi bi-people me-2 text-primary"></i> Data Siswa</a></li>
          <li><a class="dropdown-item" href="{{ route('users.index') }}"><i class="bi bi-person-fill-gear me-2 text-info"></i> Data users</a></li>
        </ul>
      </li>
    </ul>

    <!-- Profil User & Logout di Kanan -->
    <div class="dropdown">
      <button class="btn btn-light border rounded-pill dropdown-toggle d-flex align-items-center py-1 px-3 shadow-sm" type="button" data-bs-toggle="dropdown">
        <img src="{{ Auth::user()->photo && file_exists(public_path('uploads/profiles/' . Auth::user()->photo)) ? asset('uploads/profiles/' . Auth::user()->photo) : asset('assets/images/avatar.jpg') }}" alt="Profile" class="rounded-circle me-2 border" width="30" height="30" style="object-fit: cover;">
        <span class="fw-semibold small text-dark">{{ Auth::user()->name }}</span>
      </button>
      <ul class="dropdown-menu dropdown-menu-end shadow border-0 rounded-4 p-2 mt-2">
        <li class="px-3 py-1 text-muted small text-capitalize fw-bold">Role: {{ Auth::user()->role }}</li>
        <li><hr class="dropdown-divider"></li>
        <li><a class="dropdown-item rounded-3 py-2" href="{{ route('profile.edit') }}"><i class="bi bi-person me-2 text-primary"></i> Profil Saya</a></li>
        <li>
          <form action="{{ route('logout') }}" method="POST" class="m-0 p-0">
            @csrf
            <button type="submit" class="dropdown-item rounded-3 py-2 text-danger bg-transparent border-0">
              <i class="bi bi-box-arrow-right me-2"></i> Keluar
            </button>
          </form>
        </li>
      </ul>
    </div>

  </nav>
</header>
<!-- ==========================================
     END: Header Template
     ========================================== -->