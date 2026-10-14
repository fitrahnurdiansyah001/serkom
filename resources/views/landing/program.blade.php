@extends('landing.layouts.layouts')

@section('title', 'Program Unggulan - ' . ($profil->nama_sekolah ?? 'SDIT Al-Hikmah'))

@section('content')
<!-- HEADER HALAMAN -->
<section class="container py-5 mt-2 text-center" data-aos="fade-down">
    <span class="badge rounded-pill px-3 py-2 mb-3 fw-semibold shadow-sm text-white" style="background-color: #0F8B44;">
        <i class="bi bi-star-fill me-1"></i> Keunggulan Akademik & Karakter
    </span>
    <h1 class="display-4 fw-bold mb-3" style="color: #0F8B44 !important;">Program Unggulan Sekolah</h1>
    <p class="text-secondary fs-5 mx-auto" style="max-width: 650px; line-height: 1.7;">
        Berbagai program pilihan terbaik yang dirancang khusus untuk mengoptimalkan potensi, kecerdasan, serta pembentukan karakter mulia peserta didik.
    </p>
</section>

<section class="container pb-5 mb-5">
    <div class="row g-4">
        @forelse($programs ?? [] as $program)
        <div class="col-lg-4 col-md-6" data-aos="fade-up">
            <div class="card card-modern p-4 h-100 border shadow-sm bg-white d-flex flex-column text-center">
                <div class="rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center shadow-sm" style="width: 70px; height: 70px; background-color: rgba(15, 139, 68, 0.1); color: #0F8B44;">
                    <i class="{{ $program->icon ?? 'bi bi-book-half' }} fs-3"></i>
                </div>
                
                <h4 class="fw-bold text-body mb-2">{{ $program->nama_program ?? $program->judul }}</h4>
                
                <p class="text-secondary small flex-grow-1" style="line-height: 1.7;">
                    {{ $program->deskripsi ?? $program->keterangan, 95}}
                </p>

                <div class="mt-4 pt-3 border-top">
                    <span class="badge rounded-pill px-3 py-2 fw-semibold" style="background-color: rgba(15, 139, 68, 0.1); color: #0F8B44;">
                        <i class="bi bi-check-circle-fill me-1"></i> Program Aktif
                    </span>
                </div>
            </div>
        </div>
        @empty
        <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
            <div class="card card-modern p-4 h-100 border shadow-sm bg-white text-center">
                <div class="rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center shadow-sm" style="width: 70px; height: 70px; background-color: rgba(15, 139, 68, 0.1); color: #0F8B44;">
                    <i class="bi bi-book-half fs-3"></i>
                </div>
                <h4 class="fw-bold text-body mb-2">Tahfidz Al-Qur'an</h4>
                <p class="text-secondary small mb-0" style="line-height: 1.7;">Program pembiasaan hafalan Al-Qur'an dengan metode tartil dan tahsin yang interaktif setiap hari bagi seluruh siswa.</p>
            </div>
        </div>
        <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
            <div class="card card-modern p-4 h-100 border shadow-sm bg-white text-center">
                <div class="rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center shadow-sm" style="width: 70px; height: 70px; background-color: rgba(15, 139, 68, 0.1); color: #0F8B44;">
                    <i class="bi bi-lightbulb-fill fs-3"></i>
                </div>
                <h4 class="fw-bold text-body mb-2">Sains & Eksperimen</h4>
                <p class="text-secondary small mb-0" style="line-height: 1.7;">Pengembangan kemampuan logika berpikir ilmiah melalui praktik sains dasar dan laboratorium mini yang menyenangkan.</p>
            </div>
        </div>
        <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
            <div class="card card-modern p-4 h-100 border shadow-sm bg-white text-center">
                <div class="rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center shadow-sm" style="width: 70px; height: 70px; background-color: rgba(15, 139, 68, 0.1); color: #0F8B44;">
                    <i class="bi bi-laptop fs-3"></i>
                </div>
                <h4 class="fw-bold text-body mb-2">Literasi Digital & TIK</h4>
                <p class="text-secondary small mb-0" style="line-height: 1.7;">Pengenalan perangkat teknologi komputer sejak dini guna mempersiapkan siswa menghadapi era modern digital secara bijak.</p>
            </div>
        </div>
        @endforelse
    </div>
</section>
@endsection