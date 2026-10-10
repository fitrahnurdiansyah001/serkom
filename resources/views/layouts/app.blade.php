<!DOCTYPE html>
<html lang="id" data-bs-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Portal Edukasi - SDIT Al-Hikmah')</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Google Fonts: Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Mencegah flash (kedip putih) saat load di mode gelap -->
    <script>
        const storedTheme = localStorage.getItem('theme') || 'light';
        document.documentElement.setAttribute('data-bs-theme', storedTheme);
    </script>

    <!-- Custom CSS Tema Al-Hikmah -->
    <style>
        :root {
            --alhikmah-green: #0F8B44;
            --alhikmah-dark: #111827;
        }

        body {
            font-family: 'Inter', sans-serif;
            overflow-x: hidden;
            transition: background-color 0.3s ease;
        }

        /* Tema Terang & Gelap Utama */
        html[data-bs-theme="light"] body {
            background-color: #f8fafc;
        }

        html[data-bs-theme="dark"] body {
            background-color: #0f172a;
        }

        html[data-bs-theme="dark"] .card {
            background-color: #1e293b !important;
            border-color: rgba(255, 255, 255, 0.05) !important;
        }

        /* SIDEBAR DESKTOP */
        .sidebar {
            background-color: var(--alhikmah-dark);
            min-height: 100vh;
            width: 260px;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1040;
            padding-top: 20px;
            box-shadow: 2px 0 15px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease-in-out;
        }

        .sidebar-brand {
            padding: 0 25px 20px 25px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            margin-bottom: 20px;
        }

        .sidebar-heading {
            color: rgba(255, 255, 255, 0.4);
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 0 25px;
            margin-top: 25px;
            margin-bottom: 10px;
            font-weight: 600;
        }

        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.65);
            padding: 10px 15px;
            margin: 0 15px;
            border-radius: 8px;
            transition: all 0.3s ease;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
        }

        .sidebar .nav-link i {
            font-size: 1.1rem;
            width: 28px;
        }

        .sidebar .nav-link:hover {
            color: #ffffff;
            background-color: rgba(255, 255, 255, 0.05);
            transform: translateX(3px);
        }

        .sidebar .nav-link.active {
            color: #ffffff;
            background-color: var(--alhikmah-green) !important;
            box-shadow: 0 4px 6px rgba(15, 139, 68, 0.2);
            font-weight: 500;
        }

        /* MAIN CONTENT & NAVBAR */
        .main-wrapper {
            margin-left: 260px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            transition: margin-left 0.3s ease-in-out;
        }

        /* Top Navbar Dibuat Selaras dengan Sidebar di Mode Terang maupun Gelap */
        .top-navbar {
            padding: 12px 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 1030;
            background-color: var(--alhikmah-dark);
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        /* Search Container dengan Tombol Clear (X) */
        .search-container {
            background-color: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 20px;
            padding: 6px 16px;
            display: flex;
            align-items: center;
            width: 100%;
            max-width: 400px;
            transition: all 0.3s ease;
        }

        .search-container:focus-within {
            background-color: rgba(255, 255, 255, 0.12);
            border-color: rgba(255, 255, 255, 0.2);
        }

        .search-container input {
            background: transparent;
            border: none;
            width: 100%;
            outline: none;
            padding-left: 8px;
            font-size: 0.9rem;
            color: #ffffff;
        }

        .search-container input::placeholder {
            color: rgba(255, 255, 255, 0.4);
        }

        .search-container i {
            color: rgba(255, 255, 255, 0.5);
        }

        /* Tombol Clear (X) di dalam Search */
        #clear-search {
            color: rgba(255, 255, 255, 0.4);
            cursor: pointer;
            transition: color 0.2s;
            font-size: 0.9rem;
        }

        #clear-search:hover {
            color: #ffffff;
        }

        /* Action Buttons */
        .action-btn {
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.08);
            color: #fff;
            width: 38px;
            height: 38px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s ease;
            flex-shrink: 0;
        }

        .action-btn:hover {
            background: rgba(255, 255, 255, 0.15);
        }

        /* User Profile */
        .user-profile {
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
            padding: 4px 8px;
            border-radius: 8px;
            color: #ffffff;
        }

        .user-profile:hover {
            background-color: rgba(255, 255, 255, 0.05);
        }

        .user-info .name {
            color: #ffffff;
            font-weight: 600;
            font-size: 0.85rem;
            margin: 0;
        }

        .user-info .role {
            color: rgba(255, 255, 255, 0.5);
            font-size: 0.75rem;
            margin: 0;
        }

        .content-area {
            padding: 24px;
            flex-grow: 1;
        }

        @media (max-width: 991.98px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .main-wrapper {
                margin-left: 0 !important;
            }
        }
    </style>
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
                            style="width: 100%; height: 100%; object-fit: cover; transform: scale(1.35);" alt="Logo">
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
            <li class="nav-item mb-1"><a href="{{ route('home') }}"
                    class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}"><i class="bi bi-grid-1x2"></i>
                    Dashboard</a></li>
            <li class="nav-item mb-1"><a href="{{ route('profil') }}"
                    class="nav-link {{ request()->routeIs('profil*') ? 'active' : '' }}"><i class="bi bi-building"></i>
                    Profil Sekolah</a></li>
            <li class="nav-item mb-1"><a href="{{ route('prestasi.index') }}"
                    class="nav-link {{ request()->routeIs('prestasi.*') ? 'active' : '' }}"><i class="bi bi-award"></i>
                    Prestasi</a></li>
            <li class="nav-item mb-1"><a href="{{ route('ekskul.index') }}"
                    class="nav-link {{ request()->routeIs('ekskul.*') ? 'active' : '' }}"><i class="bi bi-dribbble"></i>
                    Ekstrakurikuler</a></li>
            <li class="nav-item mb-1"><a href="{{ route('galeri.index') }}"
                    class="nav-link {{ request()->routeIs('galeri.*') ? 'active' : '' }}"><i class="bi bi-images"></i>
                    Galeri</a></li>
            <li class="nav-item mb-1"><a href="{{ route('berita.index') }}"
                    class="nav-link {{ request()->routeIs('berita.*') ? 'active' : '' }}"><i
                        class="bi bi-newspaper"></i> Berita</a></li>
            <li class="nav-item mb-1"><a href="{{ route('pengumuman.index') }}"
                    class="nav-link {{ request()->routeIs('pengumuman.*') ? 'active' : '' }}"><i
                        class="bi bi-megaphone"></i> Pengumuman</a></li>
            <li class="nav-item"><a href="{{ route('program.index') }}"
                    class="nav-link {{ request()->routeIs('program.*') ? 'active' : '' }}"><i class="bi bi-star"></i>
                    Program Sekolah</a></li>
        </ul>

        <h6 class="sidebar-heading mt-4">Master Data</h6>
        <ul class="nav flex-column mb-4">
            <li class="nav-item mb-1"><a href="{{ route('guru.index') }}"
                    class="nav-link {{ request()->routeIs('guru.*') ? 'active' : '' }}"><i
                        class="bi bi-person-video3"></i> Data Guru</a></li>
            <li class="nav-item mb-1"><a href="{{ route('siswa.index') }}"
                    class="nav-link {{ request()->routeIs('siswa.*') ? 'active' : '' }}"><i class="bi bi-people"></i>
                    Data Siswa</a></li>
            @auth
                @if (Auth::user()->role === 'admin')
                    <li class="nav-item mb-1"><a href="{{ route('users.index') }}"
                            class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}"><i
                                class="bi bi-shield-lock"></i> Data Pengguna</a></li>
                @endif
            @endauth
        </ul>
    </aside>

    <!-- WRAPPER KANAN -->
    <div class="main-wrapper">
        <header class="top-navbar gap-3">
            <div class="d-flex align-items-center gap-3 flex-grow-1">
                <button id="sidebar-toggle" class="action-btn d-lg-none" title="Buka Menu">
                    <i class="bi bi-list fs-5"></i>
                </button>

                <!-- Search Bar dengan Tombol Reset (X) -->
                <form action="{{ route('search.index') }}" method="GET" class="search-container flex-grow-1"
                    id="search-form">
                    <button type="submit" class="border-0 bg-transparent p-0 d-flex align-items-center me-2">
                        <i class="bi bi-search"></i>
                    </button>
                    <input type="text" name="query" id="search-input" value="{{ request('query') }}"
                        placeholder="Cari data siswa, guru, berita...">

                    <!-- Tombol Silang (X) akan muncul jika ada teks pencarian -->
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
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name ?? 'User') }}&background=0F8B44&color=fff"
                                class="rounded-circle object-fit-cover shadow-sm border border-secondary" width="36"
                                height="36" alt="Avatar">
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

            // Mobile Sidebar Toggle Logic
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

            // Search Clear (X) Button Logic
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
                // Jika sedang di halaman pencarian, arahkan kembali ke halaman sebelumnya atau kosongkan pencarian
                window.location.href = "{{ route('home') }}"; // Atau sesuaikan rute kembali Anda
            });
        });
    </script>
    @stack('scripts')
</body>

</html>
