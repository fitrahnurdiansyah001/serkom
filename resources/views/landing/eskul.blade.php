@extends('landing.layouts.layouts')

@section('title', 'Ekstrakurikuler - ' . ($profil->nama_sekolah ?? 'SDIT Al-Hikmah'))

@section('content')
<section class="container py-5 mt-2 text-center" data-aos="fade-down">
    <span class="badge rounded-pill px-3 py-2 mb-3 fw-semibold shadow-sm text-white" style="background-color: #0F8B44;">
        <i class="bi bi-activity me-1"></i> Pengembangan Bakat & Minat
    </span>
    <h1 class="display-4 fw-bold mb-3" style="color: #0F8B44 !important;">Ekstrakurikuler Sekolah</h1>
    <p class="text-secondary fs-5 mx-auto" style="max-width: 650px; line-height: 1.7;">
        Salurkan potensi, bakat, dan minatmu melalui berbagai pilihan kegiatan ekstrakurikuler yang aktif dan inspiratif.
    </p>
</section>

<!-- DAFTAR EKSKUL -->
<section class="container pb-5 mb-5">
    <div class="row g-4">
        @forelse($ekskuls as $ekskul)
        <div class="col-lg-4 col-md-6" data-aos="fade-up">
            <div class="card card-modern p-4 h-100 border shadow-sm bg-white d-flex flex-column">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div class="rounded-circle p-3 d-flex align-items-center justify-content-center shadow-sm" style="width: 50px; height: 50px; background-color: rgba(15, 139, 68, 0.1); color: #0F8B44;">
                        <i class="bi bi-award-fill fs-4"></i>
                    </div>
                    <span class="badge rounded-pill px-3 py-2 fw-semibold" style="background-color: rgba(15, 139, 68, 0.1); color: #0F8B44;">
                        Aktif
                    </span>
                </div>      
                
                <h4 class="fw-bold text-body mb-2">{{ $ekskul->nama_ekskul ?? $ekskul->nama }}</h4>
                
                <p class="text-secondary small flex-grow-1" style="line-height: 1.7;">
                    {{ Str::limit($ekskul->deskripsi ?? 'Kegiatan pembinaan siswa di luar jam pelajaran sekolah untuk mengembangkan potensi secara optimal.', 85) }}
                </p>

                <!-- Tombol Detail Ekskul -->
                <div class="mt-4 pt-3 border-top">
                    <a href="{{ url('/info-ekskul/' . ($ekskul->slug ?? $ekskul->id_ekskul)) }}" class="btn btn-sm rounded-pill w-100 fw-semibold" style="border: 1px solid #0F8B44; color: #0F8B44;">
                        <i class="bi bi-eye me-1"></i> Lihat Detail & Jadwal
                    </a>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <div class="p-5 bg-white rounded-4 border shadow-sm">
                <i class="bi bi-journal-x display-3 text-secondary opacity-50 mb-3" style="color: #0F8B44;"></i>
                <h4 class="fw-bold text-body">Belum Ada Data Ekstrakurikuler</h4>
                <p class="text-secondary mb-0">Informasi kegiatan ekstrakurikuler akan segera diperbarui.</p>
            </div>
        </div>
        @endforelse
    </div>
</section>
@endsection