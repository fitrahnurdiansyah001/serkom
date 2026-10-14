@extends('landing.layouts.layouts')

@section('title', 'Beranda - ' . ($profil->nama_sekolah ?? 'SDIT Al-Hikmah'))

@section('content')
    <section class="container py-5 mt-2">
        <div class="row align-items-center g-5">
            <div class="col-lg-6" data-aos="fade-right">
                <span class="badge rounded-pill px-3 py-2 mb-3 fw-semibold shadow-sm text-white"
                    style="background-color: #0F8B44;">
                    <i class="bi bi-patch-check-fill me-1"></i> Portal Edukasi Terpadu
                </span>
                <h1 class="display-4 fw-bold mb-3 lh-sm" style="letter-spacing: -1px; color: #0F8B44 !important;">
                    {{ $profil->nama_sekolah ?? 'SDIT Al-Hikmah' }}
                </h1>
                <p class="text-secondary fs-5 mb-4" style="line-height: 1.7;">
                    {{ $profil->visi ?? 'Membangun generasi cerdas, berkarakter mulia, kreatif, dan berprestasi unggul di era global berbasis Sains & Tahfidz.' }}
                </p>
                <div class="d-flex flex-wrap gap-3">
                    <a href="{{ url('/tentang') }}" class="btn btn-rounded px-4 py-3 shadow-sm fw-semibold text-white"
                        style="background-color: #0F8B44;">
                        <i class="bi bi-info-circle me-2"></i> Profil Sekolah
                    </a>
                    <a href="{{ url('/info-berita') }}" class="btn btn-rounded px-4 py-3 fw-semibold"
                        style="border: 2px solid #0F8B44; color: #0F8B44;">
                        <i class="bi bi-newspaper me-2"></i> Berita Terbaru
                    </a>
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <div class="position-relative">
                    <img src="{{ isset($profil->foto) && file_exists(public_path('uploads/profil/' . $profil->foto)) ? asset('uploads/profil/' . $profil->foto) : 'https://images.unsplash.com/photo-1523050854058-8df90110c9f1?w=1000' }}"
                        alt="Gedung Sekolah" class="img-fluid w-100 rounded-4 shadow-lg object-fit-cover border border-3 border-white"
                        style="height: 460px;">
                </div>
            </div>
        </div>
    </section>

    @if (isset($pengumumans) && $pengumumans->count() > 0)
        <section class="container my-4">
            <div class="card border-0 shadow-sm rounded-4 text-white p-4 overflow-hidden position-relative"
                style="background: linear-gradient(135deg, #0F8B44 0%, #0c7338 100%);" data-aos="fade-up">
                <div class="row align-items-center position-relative z-1">
                    <div class="col-lg-3 mb-3 mb-lg-0 border-end border-light border-opacity-25">
                        <div class="d-flex align-items-center gap-2">
                            <div class="bg-white rounded-circle p-2 d-flex align-items-center justify-content-center shadow-sm"
                                style="width: 45px; height: 45px; color: #0F8B44;">
                                <i class="bi bi-megaphone-fill fs-5"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-0 text-white">Pengumuman</h6>
                                <small class="text-white-50">Informasi Penting</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="row g-3">
                            @foreach ($pengumumans->take(2) as $p)
                                <div class="col-md-6">
                                    <div
                                        class="bg-white bg-opacity-10 p-3 rounded-3 h-100 border border-white border-opacity-10">
                                        <small class="text-white-50 d-block mb-1"><i class="bi bi-calendar3 me-1"></i>
                                            {{ \Carbon\Carbon::parse($p->tanggal ?? now())->format('d M Y') }}</small>
                                        <h6 class="fw-bold text-white mb-1">{{ $p->judul ?? $p->nama_pengumuman }}</h6>
                                        <p class="small text-white-50 mb-0">{{ Str::limit($p->isi ?? $p->keterangan, 60) }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    <section class="container py-5">
        <div class="text-center mb-5" data-aos="fade-down">
            <span class="fw-bold small text-uppercase" style="color: #0F8B44;">Keunggulan Kami</span>
            <h2 class="fw-bold text-body">Program Unggulan Sekolah</h2>
        </div>
        <div class="row g-4">
            @forelse($programs ?? [] as $program)
                <div class="col-md-4" data-aos="fade-up">
                    <div class="card card-modern p-4 h-100 border text-center">
                        <div class="rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center shadow-sm"
                            style="width: 70px; height: 70px; background-color: rgba(15, 139, 68, 0.1); color: #0F8B44;">
                            <i class="{{ $program->icon ?? 'bi bi-star-fill' }} fs-3"></i>
                        </div>
                        <h5 class="fw-bold text-body mb-2">{{ $program->nama_program ?? $program->judul }}</h5>
                        <p class="text-secondary small mb-0">
                            {{ Str::limit($program->deskripsi ?? $program->keterangan, 90) }}</p>
                    </div>
                </div>
            @empty
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="card card-modern p-4 h-100 border text-center">
                        <div class="rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center shadow-sm"
                            style="width: 70px; height: 70px; background-color: rgba(15, 139, 68, 0.1); color: #0F8B44;">
                            <i class="bi bi-book-half fs-3"></i>
                        </div>
                        <h5 class="fw-bold text-body mb-2">Tahfidz Al-Qur'an</h5>
                        <p class="text-secondary small mb-0">Program pembiasaan hafalan Al-Qur'an dengan metode tartil dan
                            tahsin yang interaktif setiap hari.</p>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="card card-modern p-4 h-100 border text-center">
                        <div class="rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center shadow-sm"
                            style="width: 70px; height: 70px; background-color: rgba(15, 139, 68, 0.1); color: #0F8B44;">
                            <i class="bi bi-lightbulb-fill fs-3"></i>
                        </div>
                        <h5 class="fw-bold text-body mb-2">Sains & Eksperimen</h5>
                        <p class="text-secondary small mb-0">Pengembangan kemampuan logika berpikir ilmiah melalui praktik
                            sains dasar dan laboratorium mini.</p>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="card card-modern p-4 h-100 border text-center">
                        <div class="rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center shadow-sm"
                            style="width: 70px; height: 70px; background-color: rgba(15, 139, 68, 0.1); color: #0F8B44;">
                            <i class="bi bi-laptop fs-3"></i>
                        </div>
                        <h5 class="fw-bold text-body mb-2">Literasi Digital & TIK</h5>
                        <p class="text-secondary small mb-0">Pengenalan perangkat teknologi komputer sejak dini guna
                            mempersiapkan siswa di era modern digital.</p>
                    </div>
                </div>
            @endforelse
        </div>
    </section>

    <section class="container py-4">
        <div class="row g-4">
            <div class="col-lg-6" data-aos="fade-right">
                <div class="card card-modern p-4 h-100 border">
                    <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
                        <div>
                            <span class="fw-bold small text-uppercase" style="color: #0F8B44;">Kebanggaan Sekolah</span>
                            <h3 class="fw-bold text-body mb-0">Prestasi Terbaru</h3>
                        </div>
                        <div class="rounded-circle p-3" style="background-color: rgba(15, 139, 68, 0.1); color: #0F8B44;">
                            <i class="bi bi-trophy-fill fs-4"></i>
                        </div>
                    </div>
                    <div class="d-flex flex-column gap-3">
                        @forelse($prestasis as $prestasi)
                            <div class="d-flex align-items-start gap-3 p-3 rounded-3 bg-body-tertiary border">
                                <div class="text-white rounded-circle p-2 d-flex align-items-center justify-content-center flex-shrink-0 shadow-sm"
                                    style="width: 38px; height: 38px; background-color: #0F8B44;">
                                    <i class="bi bi-award-fill"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold text-body mb-1">{{ $prestasi->nama_prestasi ?? $prestasi->judul }}
                                    </h6>
                                    <span class="badge rounded-pill px-3 py-1 mb-1"
                                        style="background-color: rgba(15, 139, 68, 0.1); color: #0F8B44;">{{ $prestasi->tingkat ?? 'Nasional' }}</span>
                                    <p class="small text-secondary mb-0">
                                        {{ Str::limit($prestasi->keterangan ?? $prestasi->deskripsi, 60) }}</p>
                                </div>
                            </div>
                        @empty
                            <p class="text-secondary text-center py-3">Belum ada data prestasi.</p>
                        @endforelse
                    </div>
                </div>
            </div>

            <div class="col-lg-6" data-aos="fade-left">
                <div class="card card-modern p-4 h-100 border">
                    <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
                        <div>
                            <span class="fw-bold small text-uppercase" style="color: #0F8B44;">Pengembangan Bakat</span>
                            <h3 class="fw-bold text-body mb-0">Ekstrakurikuler Pilihan</h3>
                        </div>
                        <div class="rounded-circle p-3" style="background-color: rgba(15, 139, 68, 0.1); color: #0F8B44;">
                            <i class="bi bi-activity fs-4"></i>
                        </div>
                    </div>
                    <div class="row g-3">
                        @forelse($ekskuls as $ekskul)
                            <div class="col-sm-6">
                                <div class="p-3 rounded-3 bg-body-tertiary border h-100 text-center shadow-sm">
                                    <div class="fs-3 mb-1" style="color: #0F8B44;"><i
                                            class="bi bi-check-circle-fill"></i></div>
                                    <h6 class="fw-bold text-body mb-1">{{ $ekskul->nama_ekskul ?? $ekskul->nama }}</h6>
                                    <p class="small text-secondary mb-0">{{ Str::limit($ekskul->deskripsi, 45) }}</p>
                                </div>
                            </div>
                        @empty
                            <div class="col-12 text-center text-secondary py-3">Belum ada data ekstrakurikuler.</div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="container py-5">
        <div class="d-flex justify-content-between align-items-end mb-4 pb-2 border-bottom" data-aos="fade-down">
            <div>
                <span class="fw-bold small text-uppercase" style="color: #0F8B44;">Tenaga Pengajar</span>
                <h2 class="fw-bold text-body mb-0">Guru & Staf Profesional</h2>
            </div>
            <a href="{{ url('/info-guru') }}" class="btn rounded-pill px-4 fw-semibold shadow-sm"
                style="border: 1px solid #0F8B44; color: #0F8B44;">Semua Guru <i class="bi bi-arrow-right ms-1"></i></a>
        </div>
        <div class="row g-4">
            @foreach ($gurus as $guru)
                <div class="col-lg-3 col-md-6" data-aos="zoom-in">
                    <div class="card card-modern text-center p-4 h-100 border shadow-sm">
                        <div class="mb-3 mx-auto shadow-sm"
                            style="width: 100px; height: 100px; border-radius: 50%; overflow: hidden; border: 4px solid #0F8B44;">
                            @if (isset($guru->foto) && $guru->foto)
                                <img src="{{ asset('uploads/guru/' . $guru->foto) }}"
                                    class="w-100 h-100 object-fit-cover" alt="{{ $guru->nama_guru }}">
                            @else
                                <div class="w-100 h-100 d-flex align-items-center justify-content-center fs-2"
                                    style="background-color: rgba(15, 139, 68, 0.1); color: #0F8B44;">
                                    <i class="bi bi-person-fill"></i>
                                </div>
                            @endif
                        </div>
                        <h5 class="fw-bold mb-1 text-body">{{ $guru->nama_guru }}</h5>
                        <span class="badge rounded-pill px-3 py-1 mb-3"
                            style="background-color: rgba(15, 139, 68, 0.1); color: #0F8B44;">{{ $guru->mata_pelajaran ?? 'Pengajar' }}</span>
                        <a href="{{ url('/info-guru/' . ($guru->slug ?? $guru->slug)) }}"
                            class="btn btn-sm rounded-pill mt-auto w-100 fw-semibold text-white"
                            style="background-color: #0F8B44;">Lihat Profil</a>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <section class="container py-5">
        <div class="d-flex justify-content-between align-items-end mb-4 pb-2 border-bottom" data-aos="fade-down">
            <div>
                <span class="fw-bold small text-uppercase" style="color: #0F8B44;">Warta Sekolah</span>
                <h2 class="fw-bold text-body mb-0">Berita & Artikel Pilihan</h2>
            </div>
            <a href="{{ url('/info-berita') }}" class="btn rounded-pill px-4 fw-semibold shadow-sm"
                style="border: 1px solid #0F8B44; color: #0F8B44;">Semua Berita <i class="bi bi-arrow-right ms-1"></i></a>
        </div>
        <div class="row g-4">
            @forelse($beritas as $berita)
                <div class="col-lg-4 col-md-6" data-aos="fade-up">
                    <div class="card card-modern h-100 border shadow-sm overflow-hidden">
                        <div class="position-relative">
                            @if ($berita->gambar && file_exists(public_path('uploads/berita/' . $berita->gambar)))
                                <img src="{{ $berita->gambar ? asset('uploads/berita/' . $berita->gambar) : 'https://via.placeholder.com/400x200' }}"
                                    class="card-img-top object-fit-cover" style="height: 220px;" alt="Berita">
                            @endif
                        </div>
                        <div class="card-body p-4 d-flex flex-column">
                            <small class="text-secondary mb-2"><i class="bi bi-calendar3 me-1"></i>
                                {{ \Carbon\Carbon::parse($berita->tanggal)->format('d M Y') }}</small>
                            <h5 class="fw-bold mb-3 text-body">{{ $berita->judul }}</h5>
                            <p class="text-secondary small flex-grow-1">{{ Str::limit($berita->isi, 85) }}</p>
                            <a href="{{ url('/info-berita/' . $berita->slug ?? $berita->id) }}"
                                class="btn btn-sm rounded-pill w-100 mt-auto fw-semibold text-white"
                                style="background-color: #0F8B44;">Baca Selengkapnya</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-4 text-secondary">
                    <p>Belum ada berita yang tersedia.</p>
                </div>
            @endforelse
        </div>
    </section>

    @if (isset($galeris) && $galeris->count() > 0)
        <section class="container py-5 mb-5">
            <div class="text-center mb-5" data-aos="fade-down">
                <span class="fw-bold small text-uppercase" style="color: #0F8B44;">Dokumentasi Visual</span>
                <h2 class="fw-bold text-body">Galeri Kegiatan Sekolah</h2>
            </div>
            <div class="row g-4">
                @foreach ($galeris as $galeri)
                    @php
                        $fileGaleri = $galeri->file ?? ($galeri->gambar ?? null);
                    @endphp
                    <div class="col-lg-4 col-md-6" data-aos="zoom-in">
                        <a href="{{ url('/info-galeri', $galeri->slug) }}" class="text-decoration-none">
                            <div class="card card-modern overflow-hidden h-100 border shadow-sm position-relative">
                                @if ($fileGaleri && file_exists(public_path('uploads/galeri/' . $fileGaleri)))
                                    
                                    {{-- Cek Jika Video --}}
                                    @if (isset($galeri->kategori) && $galeri->kategori == 'Video')
                                        <div class="position-relative w-100 h-100 bg-dark">
                                            <video class="gallery-img w-100" style="object-fit: cover; height: 240px; opacity: 0.8;" muted>
                                                <source src="{{ asset('uploads/galeri/' . $fileGaleri) }}" type="video/mp4">
                                            </video>
                                            <div class="position-absolute top-50 start-50 translate-middle text-white" style="z-index: 2;">
                                                <i class="bi bi-play-circle-fill display-2 drop-shadow"></i>
                                            </div>
                                        </div>
                                    @else
                                        <img src="{{ asset('uploads/galeri/' . $fileGaleri) }}"
                                            alt="{{ $galeri->judul ?? 'Galeri' }}" class="gallery-img w-100" style="object-fit: cover; height: 240px;">
                                    @endif

                                @else
                                    <div class="text-center p-5 bg-body-tertiary opacity-50"
                                        style="height: 240px; display: flex; align-items: center; justify-content: center; color: #0F8B44;">
                                        <i class="bi bi-image display-3"></i>
                                    </div>
                                @endif
                                
                                @if (isset($galeri->judul) || isset($galeri->keterangan))
                                    <div
                                        class="position-absolute bottom-0 start-0 w-100 p-3 text-white bg-dark bg-opacity-75 backdrop-blur" style="z-index: 3;">
                                        <h6 class="fw-bold mb-0 text-center">{{ $galeri->judul ?? $galeri->keterangan }}</h6>
                                    </div>
                                @endif
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </section>
    @endif
@endsection