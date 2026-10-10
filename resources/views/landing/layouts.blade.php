<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SDIT Al-Hikmah - Portal Resmi')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>
        :root {
            --primary-green: #0F8B44;
            --accent-green: #0c7338;
            --soft-bg: #f8fafc;
            --dark-navy: #0f172a;
        }

        body {
            background-color: var(--soft-bg);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #334155;
            overflow-x: hidden;
        }

        .top-bar {
            background-color: var(--dark-navy);
            font-size: 0.85rem;
            color: #cbd5e1;
            padding: 10px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        .top-bar a {
            color: #cbd5e1;
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .top-bar a:hover {
            color: #ffffff;
        }

        /* Navbar Floating Modern dengan Glassmorphism & Border Lembut */
        .navbar-floating {
            background: #0F8B44;
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-radius: 50px;
            margin: 15px auto;
            max-width: 95%;
            padding: 10px 30px;
            box-shadow: 0 10px 30px -5px rgba(15, 139, 68, 0.08), 0 0 0 1px rgba(15, 139, 68, 0.08);
            transition: all 0.3s ease;
        }

        .navbar-brand img {
            width: 42px;
            height: 42px;
            object-fit: cover;
            border-radius: 50%;
            border: 2px solid #ffffff;
            /* Mengubah border logo menjadi putih agar lebih menyatu */
            box-shadow: 0 4px 10px rgba(15, 139, 68, 0.2);
        }

        /* Styling Dropdown yang Lebih Estetik & Melayang Halus */
        .dropdown-menu {
            border: 1px solid rgba(15, 139, 68, 0.12) !important;
            box-shadow: 0 15px 35px -5px rgba(0, 0, 0, 0.08) !important;
            background: rgba(255, 255, 255, 0.98) !important;
            backdrop-filter: blur(12px);
            border-radius: 16px !important;
            padding: 8px !important;
            margin-top: 12px !important;
            animation: dropdownFade 0.25s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .dropdown-item {
            font-size: 0.93rem;
            border-radius: 10px;
            padding: 10px 14px;
            transition: all 0.2s ease;
            font-weight: 500;
        }

        .dropdown-item:hover {
            background-color: rgba(15, 139, 68, 0.08) !important;
            color: var(--primary-green) !important;
            transform: translateX(4px);
        }

        @keyframes dropdownFade {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Tombol Modern Berkeliling Halus */
        .btn-rounded {
            border-radius: 50px;
            padding: 10px 25px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(15, 139, 68, 0.15);
        }

        .btn-primary {
            background-color: var(--primary-green) !important;
            border-color: var(--primary-green) !important;
        }

        .btn-primary:hover {
            background-color: var(--accent-green) !important;
            border-color: var(--accent-green) !important;
            box-shadow: 0 6px 18px rgba(15, 139, 68, 0.25);
            transform: translateY(-2px);
        }

        .text-primary {
            color: var(--primary-green) !important;
        }

        .bg-primary {
            background-color: var(--primary-green) !important;
        }

        /* Kartu dengan Border Tipis dan Efek Melayang Premium */
        .card-modern {
            border: 1px solid rgba(226, 232, 240, 0.8);
            border-radius: 20px;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.04), 0 8px 10px -6px rgba(0, 0, 0, 0.04);
            transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1);
            background: #ffffff;
        }

        .card-modern:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 35px -10px rgba(15, 139, 68, 0.12);
            border-color: rgba(15, 139, 68, 0.3);
        }

        .gallery-img {
            height: 240px;
            object-fit: cover;
            width: 100%;
            transition: transform 0.5s ease;
        }

        .card-modern:hover .gallery-img {
            transform: scale(1.05);
        }
    </style>
</head>

<body>

    <!-- TOPBAR -->
    <div class="top-bar d-none d-md-block">
        <div class="container">
            <div class="row justify-content-between align-items-center">
                <div class="col-auto d-flex align-items-center gap-4">
                    <span><i class="bi bi-envelope-fill text-success me-1"></i>{{ $profil->email ?? '-' }}</span>
                    <span><i class="bi bi-telephone-fill text-success me-1"></i>{{ $profil->telepon ?? '-' }}</span>
                </div>
                <div class="col-auto d-flex align-items-center gap-3">
                    <span class="text-white-50">Ikuti Kami:</span>
                    <a href="https://www.instagram.com/sdit.alhikmah.mgrj/" class="transition"><i
                            class="bi bi-instagram"></i></a>
                    <a href="https://www.youtube.com/@sd-ital-hikmah-kalapasewu6968" class="transition"><i
                            class="bi bi-youtube"></i></a>
                </div>
            </div>
        </div>
    </div>

    <!-- NAVBAR (navbar-dark agar ikon toggler putih) -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top navbar-floating">
        <div class="container-fluid px-3">
            <a class="navbar-brand fw-bold text-white fs-5 d-flex align-items-center gap-2 text-decoration-none"
                href="{{ url('/') }}">
                @php $logo = optional($profil)->logo; @endphp
                @if ($logo && file_exists(public_path('uploads/profil/' . $logo)))
                    <img src="{{ asset('uploads/profil/' . $logo) }}" alt="Logo">
                @else
                    <img src="{{ asset('uploads/profil/logo_1791247116_6ac4430c6648d.jpeg') }}"
                        alt="Logo SDIT Al-Hikmah">
                @endif
                <span>{{ $profil->nama_sekolah }}</span>
            </a>
            <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                <ul class="navbar-nav gap-1 fw-medium">
                    <li class="nav-item">
                        <a class="nav-link px-3 rounded-pill {{ request()->is('/') ? 'text-white fw-bold bg-white bg-opacity-25' : 'text-white' }}"
                            href="{{ url('/') }}">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-3 rounded-pill {{ request()->is('tentang*') ? 'text-white fw-bold bg-white bg-opacity-25' : 'text-white' }}"
                            href="{{ url('/tentang') }}">Profil Sekolah</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-3 rounded-pill {{ request()->is('info-prestasi*') ? 'text-white fw-bold bg-white bg-opacity-25' : 'text-white' }}"
                            href="{{ url('/info-prestasi') }}">Prestasi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-3 rounded-pill {{ request()->is('info-ekskul*') ? 'text-white fw-bold bg-white bg-opacity-25' : 'text-white' }}"
                            href="{{ url('/info-ekskul') }}">Ekstrakurikuler</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-3 rounded-pill {{ request()->is('info-guru*') ? 'text-white fw-bold bg-white bg-opacity-25' : 'text-white' }}"
                            href="{{ url('/info-guru') }}">Guru & Staf</a>
                    </li>

                    <!-- MENU DROPDOWN INFORMASI -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle px-3 rounded-pill {{ request()->is('info-berita*') || request()->is('info-pengumuman*') ? 'text-white fw-bold bg-white bg-opacity-25' : 'text-white' }}"
                            href="#" id="navbarDropdownInfo" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Informasi
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownInfo">
                            <li>
                                <a class="dropdown-item py-2 px-3 {{ request()->is('info-berita*') ? 'text-primary fw-bold bg-success bg-opacity-10' : 'text-dark' }}"
                                    href="{{ url('/info-berita') }}">
                                    <i class="bi bi-newspaper me-2 text-success"></i> Berita
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item py-2 px-3 {{ request()->is('info-pengumuman*') ? 'text-primary fw-bold bg-success bg-opacity-10' : 'text-dark' }}"
                                    href="{{ url('/info-pengumuman') }}">
                                    <i class="bi bi-megaphone me-2 text-success"></i> Pengumuman
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link px-3 rounded-pill {{ request()->is('info-galeri*') ? 'text-white fw-bold bg-white bg-opacity-25' : 'text-white' }}"
                            href="{{ url('/info-galeri') }}">Galeri</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-3 rounded-pill {{ request()->is('info-program*') ? 'text-white fw-bold bg-white bg-opacity-25' : 'text-white' }}"
                            href="{{ url('/info-program') }}">Program</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- KONTEN UTAMA -->
    <main style="min-height: 80vh; padding-top: 90px;">
        @yield('content')
    </main>

    <!-- FOOTER -->
    <footer class="text-white pt-5 pb-4 mt-5"
        style="background-color: var(--dark-navy); border-top-left-radius: 35px; border-top-right-radius: 35px; box-shadow: 0 -10px 30px rgba(0,0,0,0.05);">
        <div class="container py-4">
            <div class="row g-4 justify-content-between">
                <div class="col-lg-4">
                    <h4 class="fw-bold mb-3 text-white"><i class="bi bi-mortarboard-fill text-success me-2"></i>SDIT
                        Al-Hikmah</h4>
                    <p class="text-white-50 small mb-4" style="line-height: 1.8;">
                        Portal informasi pendidikan terpadu SDIT Al-Hikmah untuk mencetak generasi unggul, cerdas,
                        berkarakter, dan berdaya saing global berbasis Sains & Tahfidz.
                    </p>
                </div>
                <div class="col-lg-3 col-6">
                    <h5 class="fw-bold text-white mb-3 fs-6">Navigasi Utama</h5>
                    <ul class="list-unstyled d-flex flex-column gap-2 text-white-50 small">
                        <li><a href="{{ url('/') }}" class="text-white-50 text-decoration-none">Beranda</a></li>
                        <li><a href="{{ url('/tentang') }}" class="text-white-50 text-decoration-none">Profil
                                Sekolah</a></li>
                        <li><a href="{{ url('/info-prestasi') }}"
                                class="text-white-50 text-decoration-none">Prestasi</a></li>
                        <li><a href="{{ url('/info-ekskul') }}"
                                class="text-white-50 text-decoration-none">Ekstrakurikuler</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-6">
                    <h5 class="fw-bold text-white mb-3 fs-6">Informasi & Galeri</h5>
                    <ul class="list-unstyled d-flex flex-column gap-2 text-white-50 small">
                        <li><a href="{{ url('/info-guru') }}" class="text-white-50 text-decoration-none">Data
                                Guru</a></li>
                        <li><a href="{{ url('/info-berita') }}" class="text-white-50 text-decoration-none">Berita
                                Terkini</a></li>
                        <li><a href="{{ url('/info-pengumuman') }}"
                                class="text-white-50 text-decoration-none">Pengumuman</a></li>
                        <li><a href="{{ url('/info-galeri') }}" class="text-white-50 text-decoration-none">Galeri
                                Sekolah</a></li>
                    </ul>
                </div>
            </div>
            <hr class="border-light border-opacity-10 my-4">
            <div class="row align-items-center justify-content-between text-white-50 small">
                <div class="col-md-auto text-center text-md-start mb-2 mb-md-0">
                    &copy; {{ date('Y') }} <strong>SDIT Al-Hikmah</strong>. Seluruh Hak Cipta Dilindungi.
                </div>
                <div class="col-md-auto text-center text-md-end">
                    <span>Sistem Informasi Sekolah</span>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            once: true,
            duration: 800
        });
    </script>
</body>

</html>
