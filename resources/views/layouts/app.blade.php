<!DOCTYPE html>
<html lang="id" data-bs-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Portal Edukasi - SDIT Al-Hikmah')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/admin/layouts.css') }}">

    <script>
        const storedTheme = localStorage.getItem('theme') || 'light';
        document.documentElement.setAttribute('data-bs-theme', storedTheme);
    </script>

</head>

<body>

    <div id="sidebar-backdrop" class="position-fixed top-0 start-0 w-100 h-100 bg-dark opacity-50 d-none"
        style="z-index: 1035;"></div>

    <!-- SIDEBAR KIRI -->
    <aside id="app-sidebar" class="sidebar">
        @php
            $profil = \App\Models\ProfilSekolah::first();
        @endphp
        <div class="sidebar-brand d-flex align-items-center justify-content-between text-white">
            <div class="d-flex align-items-center gap-3">
                <div class="flex-shrink-0 overflow-hidden rounded-circle d-flex align-items-center justify-content-center"
                    style="width: 48px; height: 48px;">
                    @php $logo = optional($profil)->logo; @endphp
                    @if ($logo && file_exists(public_path('uploads/profil/' . $logo)))
                        <img src="{{ asset('uploads/profil/' . $logo) }}"
                            style="width: 100%; height: 100%; object-fit: cover; transform: scale(1.35);"
                            alt="Logo">
                    @else
                        <img src="{{ asset('uploads/profil/logo_1791247116_6ac4430c6648d.jpeg') }}" alt="Logo Sekolah"
                            style="width: 100%; height: 100%; object-fit: cover; transform: scale(1.35);">
                    @endif
                </div>
                <div class="lh-sm">
                    <h6 class="mb-0 fw-bold" style="font-size: 0.9rem;">{{ $profil->nama_sekolah }}</h6>
                    <small class="text-white-50" style="font-size: 0.6rem;">SAINS & TAHFIDZ</small>
                </div>
            </div>
            <button id="sidebar-close" class="btn text-white-50 d-lg-none fs-4 p-0">
                <i class="bi bi-x"></i>
            </button>
        </div>

        <h6 class="sidebar-heading">Menu Utama</h6>
        <ul class="nav flex-column mb-2">
            <li class="nav-item mb-1"><a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}"><i class="bi bi-grid-1x2"></i>Dashboard</a></li>
            <li class="nav-item mb-1"><a href="{{ route('profil') }}" class="nav-link {{ request()->routeIs('profil*') ? 'active' : '' }}"><i class="bi bi-building"></i>Profil Sekolah</a></li>
            <li class="nav-item mb-1"><a href="{{ route('prestasi.index') }}" class="nav-link {{ request()->routeIs('prestasi.*') ? 'active' : '' }}"><i class="bi bi-award"></i>Prestasi</a></li>
            <li class="nav-item mb-1"><a href="{{ route('ekskul.index') }}" class="nav-link {{ request()->routeIs('ekskul.*') ? 'active' : '' }}"><i class="bi bi-dribbble"></i>Ekstrakurikuler</a></li>
            <li class="nav-item mb-1"><a href="{{ route('galeri.index') }}" class="nav-link {{ request()->routeIs('galeri.*') ? 'active' : '' }}"><i class="bi bi-images"></i>Galeri</a></li>
            <li class="nav-item mb-1"><a href="{{ route('berita.index') }}" class="nav-link {{ request()->routeIs('berita.*') ? 'active' : '' }}"><i class="bi bi-newspaper"></i> Berita</a></li>
            <li class="nav-item mb-1"><a href="{{ route('pengumuman.index') }}" class="nav-link {{ request()->routeIs('pengumuman.*') ? 'active' : '' }}"><i class="bi bi-megaphone"></i> Pengumuman</a></li>
            <li class="nav-item mb-1"><a href="{{ route('program.index') }}" class="nav-link {{ request()->routeIs('program.*') ? 'active' : '' }}"><i class="bi bi-star"></i>Program Sekolah</a></li>
        </ul>

        <h6 class="sidebar-heading mt-4">Master Data</h6>
        <ul class="nav flex-column mb-4">
            <li class="nav-item mb-1"><a href="{{ route('guru.index') }}"class="nav-link {{ request()->routeIs('guru.*') ? 'active' : '' }}"><i class="bi bi-person-video3"></i> Data Guru</a></li>
            <li class="nav-item mb-1"><a href="{{ route('siswa.index') }}"class="nav-link {{ request()->routeIs('siswa.*') ? 'active' : '' }}"><i class="bi bi-person"></i>Data Siswa</a></li>
            @auth
            @if (Auth::user()->role === 'admin')
            <li class="nav-item mb-1"><a href="{{ route('users.index') }}"class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}"><i class="bi bi-shield-lock"></i> Data Pengguna</a></li>
            @endif
            @endauth
        </ul>
        <hr class="text-white">
        <ul class="nav flex-column mb-2">
            <li class="nav-item mb-1 btn-outline-success"><a href="{{ url('/') }}"class="nav-link"><i class="bi bi-globe"></i>Landing page</a></li>
        </ul>
    </aside>

    <!-- WRAPPER KANAN -->
    <div class="main-wrapper">
        <header class="top-navbar gap-3">
            <div class="d-flex align-items-center gap-3 flex-grow-1">
                <button id="sidebar-toggle" class="action-btn d-lg-none" title="Buka Menu">
                    <i class="bi bi-list fs-5"></i>
                </button>

                <form action="{{ route('search.index') }}" method="GET" class="search-container flex-grow-1"
                    id="search-form">
                    <button type="submit" class="border-0 bg-transparent p-0 d-flex align-items-center me-2">
                        <i class="bi bi-search"></i>
                    </button>
                    <input type="text" name="query" id="search-input" value="{{ request('query') }}"
                        placeholder="Cari data siswa, guru, berita...">

                    <span id="clear-search" class="ms-2 {{ request('query') ? '' : 'd-none' }}"
                        title="Reset Pencarian">
                        <i class="bi bi-x-lg"></i>
                    </span>
                </form>
            </div>

            <div class="d-flex align-items-center gap-3 flex-shrink-0">
                <button id="theme-toggle" class="action-btn" title="Ganti Tema">
                    <i class="bi bi-moon-stars"></i>
                </button>

                @auth
                    <div class="dropdown">
                        <div class="user-profile" data-bs-toggle="dropdown" aria-expanded="false">
                            @if (Auth::user()->photo && file_exists(public_path('uploads/profiles/' . Auth::user()->photo)))
                                <img id="previewImage" src="{{ asset('uploads/profiles/' . Auth::user()->photo) }}"
                                    alt="Foto Profil" class="rounded-circle border object-fit-cover shadow-sm"
                                    width="40" height="40" alt="Avatar">
                            @else
                                <div class="rounded-circle d-flex align-items-center justify-content-center fw-bold me-2"
                                    style="width: 35px; height: 35px; font-size: 0.85rem; background-color: rgba(15, 139, 68, 0.1); color: #0F8B44;">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </div>
                            @endif
                            <div class="user-info d-none d-sm-block">
                                <p class="name">{{ Auth::user()->name ?? 'Administrator' }}</p>
                                <p class="role">{{ Auth::user()->role ?? 'Admin' }}</p>
                            </div>
                            <i class="bi bi-chevron-down ms-1 text-white-50" style="font-size: 0.7rem;"></i>
                        </div>

                        <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-3 rounded-3 p-2">
                            <li>
                                <h6 class="dropdown-header fw-bold">Akun Saya</h6>
                            </li>
                            <li><a class="dropdown-item py-2 rounded-2" href="{{ route('profile.edit') }}"><i
                                        class="bi bi-person me-2"></i> Profil Saya</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item py-2 text-danger fw-semibold rounded-2">
                                        <i class="bi bi-box-arrow-right me-2 text-danger"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @endauth
            </div>
        </header>

        <main class="content-area">
            @yield('content')
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Dark Mode Logic
            const themeToggleBtn = document.getElementById('theme-toggle');
            const themeIcon = themeToggleBtn.querySelector('i');
            const htmlElement = document.documentElement;

            function updateIcon(theme) {
                if (theme === 'dark') {
                    themeIcon.classList.remove('bi-moon-stars');
                    themeIcon.classList.add('bi-sun-fill', 'text-warning');
                } else {
                    themeIcon.classList.remove('bi-sun-fill', 'text-warning');
                    themeIcon.classList.add('bi-moon-stars');
                }
            }

            updateIcon(htmlElement.getAttribute('data-bs-theme'));

            themeToggleBtn.addEventListener('click', function() {
                const currentTheme = htmlElement.getAttribute('data-bs-theme');
                const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
                htmlElement.setAttribute('data-bs-theme', newTheme);
                localStorage.setItem('theme', newTheme);
                updateIcon(newTheme);
            });

            const sidebarToggle = document.getElementById('sidebar-toggle');
            const sidebarClose = document.getElementById('sidebar-close');
            const sidebar = document.getElementById('app-sidebar');
            const backdrop = document.getElementById('sidebar-backdrop');

            function toggleSidebar() {
                sidebar.classList.toggle('show');
                backdrop.classList.toggle('d-none');
            }

            if (sidebarToggle) sidebarToggle.addEventListener('click', toggleSidebar);
            if (sidebarClose) sidebarClose.addEventListener('click', toggleSidebar);
            if (backdrop) backdrop.addEventListener('click', toggleSidebar);

            const searchInput = document.getElementById('search-input');
            const clearSearch = document.getElementById('clear-search');

            searchInput.addEventListener('input', function() {
                if (this.value.trim().length > 0) {
                    clearSearch.classList.remove('d-none');
                } else {
                    clearSearch.classList.add('d-none');
                }
            });

            clearSearch.addEventListener('click', function() {
                searchInput.value = '';
                clearSearch.classList.add('d-none');
                window.location.href = "{{ route('home') }}";
            });
        });
    </script>
    @stack('scripts')
</body>

</html>
