<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Portal Resmi SDIT Al-Hikmah - Sistem Informasi dan Data Sekolah Terpadu">

    <title>@yield('title', 'SDIT Al-Hikmah - Portal Resmi')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/publik/layouts.css') }}">
</head>

<body>
    @php
        if (!isset($profil)) {
            $profil = \App\Models\ProfilSekolah::first();
        }
    @endphp

    <div class="top-bar d-none d-md-block">
        <div class="container">
            <div class="row justify-content-between align-items-center">
                <div class="col-auto d-flex align-items-center gap-4">
                    <span><i
                            class="bi bi-envelope-fill text-success me-1"></i>{{ optional($profil)->email ?? 'info@sekolah.com' }}</span>
                    <span><i
                            class="bi bi-telephone-fill text-success me-1"></i>{{ optional($profil)->telepon ?? '-' }}</span>
                </div>
                <div class="col-auto d-flex align-items-center gap-3">
                    <span class="text-white-50">Ikuti Kami:</span>
                    <a href="https://www.instagram.com/sdit.alhikmah.mgrj/" class="transition text-white"><i
                            class="bi bi-instagram"></i></a>
                    <a href="https://www.youtube.com/@sd-ital-hikmah-kalapasewu6968" class="transition text-white"><i
                            class="bi bi-youtube"></i></a>
                </div>
            </div>
        </div>
    </div>

    <nav class="navbar navbar-expand-lg navbar-dark fixed-top navbar-floating">
        <div class="container-fluid px-3">
            <a class="navbar-brand fw-bold text-white fs-5 d-flex align-items-center gap-2 text-decoration-none"
                href="{{ url('/') }}">
                @php $logo = optional($profil)->logo; @endphp
                @if ($logo && file_exists(public_path('uploads/profil/' . $logo)))
                    <img src="{{ asset('uploads/profil/' . $logo) }}" alt="Logo"
                        style="height: 40px; border-radius: 50%;">
                @else
                    <img src="{{ asset('uploads/profil/logo_1791247116_6ac4430c6648d.jpeg') }}"
                        alt="Logo SDIT Al-Hikmah" style="height: 40px; border-radius: 50%;">
                @endif
                <span>{{ optional($profil)->nama_sekolah ?? 'SDIT Al-Hikmah' }}</span>
            </a>

            <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                <ul class="navbar-nav gap-2 gap-lg-1 fw-medium">
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

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle px-3 rounded-pill {{ request()->is('info-guru*') || request()->is('info-siswa*') ? 'text-white fw-bold bg-white bg-opacity-25' : 'text-white' }}"
                            href="#" id="navbarDropdownData" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Data
                        </a>
                        <ul class="dropdown-menu border-0 shadow" aria-labelledby="navbarDropdownData">
                            <li>
                                <a class="dropdown-item py-2 px-3 {{ request()->is('info-guru*') ? 'text-primary fw-bold bg-success bg-opacity-10' : 'text-dark' }}"
                                    href="{{ url('/info-guru') }}"><i
                                        class="bi bi-person-workspace me-2 text-success"></i>Guru & Staf</a>
                            </li>
                            <li>
                                <a class="dropdown-item py-2 px-3 {{ request()->is('info-siswa*') ? 'text-primary fw-bold bg-success bg-opacity-10' : 'text-dark' }}"
                                    href="{{ url('/info-siswa') }}"><i
                                        class="bi bi-person-badge me-2 text-success"></i>Siswa</a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle px-3 rounded-pill {{ request()->is('info-berita*') || request()->is('info-pengumuman*') ? 'text-white fw-bold bg-white bg-opacity-25' : 'text-white' }}"
                            href="#" id="navbarDropdownInfo" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Informasi
                        </a>
                        <ul class="dropdown-menu border-0 shadow" aria-labelledby="navbarDropdownInfo">
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

                <div class="d-lg-none mt-3 pb-2 text-center">
                    @auth
                        <a href="{{ url('/dashboard') }}"
                            class="btn btn-outline-light rounded-pill px-4 fw-semibold w-100">
                            <i class="bi bi-grid-fill me-2"></i> Dashboard
                        </a>
                    @endauth
                </div>
            </div>

            <div class="d-none d-lg-flex align-items-center gap-2">
                @auth
                    <a href="{{ url('/dashboard') }}"
                        class="btn btn-outline-light rounded-pill px-4 fw-semibold shadow-sm btn-dashboard">
                        <i class="bi bi-grid-fill me-2"></i> Dashboard
                    </a>
                @endauth
            </div>
        </div>
    </nav>


    <main style="min-height: 80vh; padding-top: 100px;">
        @yield('content')
    </main>

    <footer class="text-white pt-5 pb-4 mt-5"
        style="background-color: var(--dark-navy, #1a2530); border-top-left-radius: 35px; border-top-right-radius: 35px; box-shadow: 0 -10px 30px rgba(0,0,0,0.05);">
        <div class="container py-4">
            <div class="row g-4 justify-content-between">
                <div class="col-lg-4 text-center text-lg-start">
                    <h4 class="fw-bold mb-3 text-white"><i
                            class="bi bi-mortarboard-fill text-success me-2"></i>{{ optional($profil)->nama_sekolah ?? 'SDIT Al-Hikmah' }}
                    </h4>
                    <p class="text-white-50 small mb-4" style="line-height: 1.8;">
                        Portal informasi pendidikan terpadu untuk mencetak generasi unggul, cerdas,
                        berkarakter, dan berdaya saing global berbasis Sains & Tahfidz.
                    </p>
                </div>
                <div class="col-lg-3 col-6">
                    <h5 class="fw-bold text-white mb-3 fs-6">Navigasi Utama</h5>
                    <ul class="list-unstyled d-flex flex-column gap-2 text-white-50 small">
                        <li><a href="{{ url('/') }}"
                                class="text-white-50 text-decoration-none transition-link">Beranda</a></li>
                        <li><a href="{{ url('/tentang') }}"
                                class="text-white-50 text-decoration-none transition-link">Profil Sekolah</a></li>
                        <li><a href="{{ url('/info-prestasi') }}"
                                class="text-white-50 text-decoration-none transition-link">Prestasi</a></li>
                        <li><a href="{{ url('/info-ekskul') }}"
                                class="text-white-50 text-decoration-none transition-link">Ekstrakurikuler</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-6">
                    <h5 class="fw-bold text-white mb-3 fs-6">Informasi & Galeri</h5>
                    <ul class="list-unstyled d-flex flex-column gap-2 text-white-50 small">
                        <li><a href="{{ url('/info-guru') }}"
                                class="text-white-50 text-decoration-none transition-link">Data Guru</a></li>
                        <li><a href="{{ url('/info-siswa') }}"
                                class="text-white-50 text-decoration-none transition-link">Data Siswa</a></li>
                        <li><a href="{{ url('/info-berita') }}"
                                class="text-white-50 text-decoration-none transition-link">Berita Terkini</a></li>
                        <li><a href="{{ url('/info-pengumuman') }}"
                                class="text-white-50 text-decoration-none transition-link">Pengumuman</a></li>
                    </ul>
                </div>
            </div>
            <hr class="border-light border-opacity-10 my-4">
            <div class="row align-items-center justify-content-between text-white-50 small">
                <div class="col-md-auto text-center text-md-start mb-2 mb-md-0">
                    &copy; {{ date('Y') }}
                    <strong>{{ optional($profil)->nama_sekolah ?? 'SDIT Al-Hikmah' }}</strong>. Seluruh Hak Cipta
                    Dilindungi.
                </div>
                <div class="col-md-auto text-center text-md-end">
                    <span>Sistem Informasi Sekolah v1.0</span>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            once: true,
            duration: 800,
            offset: 50
        });
    </script>
</body>

</html>
