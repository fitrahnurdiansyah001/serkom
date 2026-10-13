@extends('landing.layouts.layouts')

@section('title', 'Profil Sekolah - ' . ($profil->nama_sekolah ?? 'SDIT Al-Hikmah'))

@section('content')
<!-- HEADER BANNER PROFIL -->
<section class="container py-5 mt-2">
    <div class="row align-items-center g-5">
        <div class="col-lg-6" data-aos="fade-right">
            <span class="badge rounded-pill px-3 py-2 mb-3 fw-semibold shadow-sm text-white" style="background-color: #0F8B44;">
                <i class="bi bi-building-fill me-1"></i> Tentang Institusi
            </span>
            <h1 class="display-4 fw-bold mb-3 lh-sm" style="color: #0F8B44 !important;">
                {{ $profil->nama_sekolah ?? 'Profil Sekolah' }}
            </h1>
            <p class="text-secondary fs-5 mb-4" style="line-height: 1.7;">
                {{ $profil->sejarah ?? 'Mengenal lebih dekat sejarah berdirinya sekolah, visi dan misi, serta komitmen kami dalam memajukan dunia pendidikan.' }}
            </p>
        </div>
        <div class="col-lg-6" data-aos="fade-left">
            <div class="position-relative">
                <img src="{{ isset($profil->foto) && file_exists(public_path('uploads/profil/' . $profil->foto)) ? asset('uploads/profil/' . $profil->foto) : 'https://images.unsplash.com/photo-1523050854058-8df90110c9f1?w=1000' }}"
                    alt="Foto Profil Sekolah" class="w-100 rounded-4 shadow-lg object-fit-cover border border-3 border-white"
                    style="height: 400px;">
            </div>
        </div>
    </div>
</section>

<!-- STATISTIK TOTAL (SISWA, GURU, EKSKUL, PRESTASI) -->
<section class="container py-4">
    <div class="row g-4 text-center">
        <!-- Total Siswa -->
        <div class="col-lg-3 col-6" data-aos="zoom-in">
            <div class="card card-modern p-4 border shadow-sm h-100 bg-white">
                <div class="display-5 mb-2" style="color: #0F8B44;"><i class="bi bi-people-fill"></i></div>
                <h2 class="fw-bold text-body mb-1">{{ $totalSiswa ?? 0 }}</h2>
                <p class="text-secondary small mb-0 fw-semibold text-uppercase">Total Siswa Aktif</p>
            </div>
        </div>
        <!-- Total Guru -->
        <div class="col-lg-3 col-6" data-aos="zoom-in" data-aos-delay="100">
            <div class="card card-modern p-4 border shadow-sm h-100 bg-white">
                <div class="display-5 mb-2" style="color: #0F8B44;"><i class="bi bi-person-badge-fill"></i></div>
                <h2 class="fw-bold text-body mb-1">{{ $totalGuru ?? 0 }}</h2>
                <p class="text-secondary small mb-0 fw-semibold text-uppercase">Guru & Staf</p>
            </div>
        </div>
        <!-- Total Ekstrakurikuler -->
        <div class="col-lg-3 col-6" data-aos="zoom-in" data-aos-delay="200">
            <div class="card card-modern p-4 border shadow-sm h-100 bg-white">
                <div class="display-5 mb-2" style="color: #0F8B44;"><i class="bi bi-activity"></i></div>
                <h2 class="fw-bold text-body mb-1">{{ $totalEkskul ?? 0 }}</h2>
                <p class="text-secondary small mb-0 fw-semibold text-uppercase">Ekstrakurikuler</p>
            </div>
        </div>
        <!-- Total Prestasi -->
        <div class="col-lg-3 col-6" data-aos="zoom-in" data-aos-delay="300">
            <div class="card card-modern p-4 border shadow-sm h-100 bg-white">
                <div class=" display-5 mb-2" style="color: #0F8B44;"><i class="bi bi-trophy-fill"></i></div>
                <h2 class="fw-bold text-body mb-1">{{ $totalPrestasi ?? 0 }}</h2>
                <p class="text-secondary small mb-0 fw-semibold text-uppercase">Prestasi Diraih</p>
            </div>
        </div>
    </div>
</section>

<!-- DETAIL VISI, MISI, & INFORMASI UMUM -->
<section class="container py-5">
    <div class="row g-5">
        <!-- Kiri: Visi & Misi -->
        <div class="col-lg-7" data-aos="fade-right">
            <div class="card card-modern p-4 p-md-5 border shadow-sm h-100 bg-white">
                <h3 class="fw-bold text-body mb-4 border-bottom pb-3"><i class="bi bi-eye-fill me-2" style="color: #0F8B44;"></i> Visi & Misi Sekolah</h3>
                
                <h5 class="fw-bold mb-2" style="color: #0F8B44;">Visi</h5>
                <p class="fs-5 text-secondary fst-italic mb-4 p-3 bg-light rounded-3 border-start border-4" style="border-color: #0F8B44 !important;">
                    "{{ $profil->visi ?? 'Belum ada data visi.' }}"
                </p>

                <h5 class="fw-bold mb-2" style="color: #0F8B44;">Misi</h5>
                <div class="text-secondary" style="line-height: 1.8;">
                    {!! nl2br(e($profil->misi ?? 'Belum ada data misi.')) !!}
                </div>
            </div>
        </div>

        <!-- Kanan: Informasi Kontak & Identitas -->
        <div class="col-lg-5" data-aos="fade-left">
            <div class="card card-modern p-4 p-md-5 border shadow-sm h-100 bg-white">
                <h3 class="fw-bold text-body mb-4 border-bottom pb-3"><i class="bi bi-info-circle-fill me-2" style="color: #0F8B44;"></i> Identitas Sekolah</h3>
                
                <ul class="list-unstyled d-flex flex-column gap-3 mb-0">
                    <li class="d-flex justify-content-between border-bottom pb-2">
                        <strong class="text-secondary">Nama Sekolah:</strong>
                        <span class="fw-bold text-body text-end">{{ $profil->nama_sekolah ?? '-' }}</span>
                    </li>
                    <li class="d-flex justify-content-between border-bottom pb-2">
                        <strong class="text-secondary">NPSN:</strong>
                        <span class="fw-bold text-body">{{ $profil->npsn ?? '-' }}</span>
                    </li>
                    <li class="d-flex justify-content-between border-bottom pb-2">
                        <strong class="text-secondary">Kepala Sekolah:</strong>
                        <span class="fw-bold text-body">{{ $profil->kepala_sekolah ?? '-' }}</span>
                    </li>
                    <li class="d-flex justify-content-between border-bottom pb-2">
                        <strong class="text-secondary">Nomor Telepon:</strong>
                        <span class="fw-bold text-body">{{ $profil->telepon ?? '-' }}</span>
                    </li>
                    <li class="d-flex justify-content-between border-bottom pb-2">
                        <strong class="text-secondary">Email Resmi:</strong>
                        <span class="fw-bold text-body">{{ $profil->email ?? '-' }}</span>
                    </li>
                    <li class="d-flex justify-content-between">
                        <strong class="text-secondary">Alamat:</strong>
                        <span class="fw-bold text-body text-end" style="max-width: 200px;">{{ $profil->alamat ?? '-' }}</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>
@endsection