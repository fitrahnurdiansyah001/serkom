@extends('layouts.app')

@section('title', 'Detail Pengumuman: ' . $pengumuman->judul . ' - SDIT Al-Hikmah')

@section('content')
    <style>
        .card-modern {
            background-color: var(--bs-body-bg);
            border: 1px solid var(--bs-border-color, rgba(0, 0, 0, 0.08));
            border-radius: 1.25rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.03), 0 2px 4px -1px rgba(0, 0, 0, 0.02);
            overflow: hidden;
            transition: all 0.3s ease;
        }
        .pengumuman-img-large {
            width: 100%;
            max-height: 450px;
            object-fit: cover;
            border-radius: 1rem;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }
        .info-box {
            background-color: #f8f9fa;
            border: 1px solid rgba(0, 0, 0, 0.05);
            border-radius: 1rem;
            transition: all 0.3s ease;
        }
        html[data-bs-theme="dark"] .info-box {
            background-color: #1e293b !important;
            border-color: rgba(255, 255, 255, 0.08) !important;
        }
        html[data-bs-theme="dark"] .info-box .text-body {
            color: #f8f9fa !important;
        }
    </style>

    <!-- TOMBOL KEMBALI -->
    <div class="mb-4">
        <a href="{{ route('pengumuman.index') }}" class="btn rounded-pill px-4 fw-semibold shadow-sm" style="border: 1px solid #0F8B44; color: #0F8B44;">
            <i class="bi bi-arrow-left me-2"></i> Kembali ke Daftar Pengumuman
        </a>
    </div>

    <!-- KARTU DETAIL PENGUMUMAN -->
    <div class="row justify-content-center mb-5">
        <div class="col-lg-9">
            <div class="card-modern p-4 p-md-5">
                
                @if(!empty($pengumuman->foto) && file_exists(public_path('uploads/pengumuman/' . $pengumuman->foto)))
                    <div class="mb-4 text-center">
                        <img src="{{ asset('uploads/pengumuman/' . $pengumuman->foto) }}" alt="{{ $pengumuman->judul }}" class="pengumuman-img-large">
                    </div>
                @endif

                <!-- Header Status & Tanggal -->
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="badge {{ $pengumuman->status == 'Publish' ? 'bg-success' : 'bg-warning text-dark' }} px-3 py-2 rounded-pill fw-semibold" style="font-size: 0.85rem;">
                        {{ $pengumuman->status }}
                    </span>
                    <span class="text-secondary fw-medium">
                        <i class="bi bi-calendar-event me-1"></i> {{ date('d F Y', strtotime($pengumuman->tanggal)) }}
                    </span>
                </div>

                <!-- Judul Pengumuman -->
                <h1 class="fw-bold text-body mb-2" style="line-height: 1.3;">{{ $pengumuman->judul }}</h1>

                <!-- Informasi Penulis Otomatis -->
                <div class="d-flex align-items-center text-secondary mb-4 pb-3 border-bottom">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-person-circle fs-5 me-2" style="color: #0F8B44;"></i>
                        <span>Diterbitkan oleh <strong class="text-body">{{ $pengumuman->user->name ?? 'Admin Sekolah' }}</strong></span>
                    </div>
                </div>

                <!-- Isi Pengumuman Lengkap -->
                <div class="mb-4">
                    <div class="text-body lh-lg" style="font-size: 1.05rem; white-space: pre-line;">
                        {!! $pengumuman->isi !!}
                    </div>
                </div>

                <hr class="my-4 opacity-10">

                <!-- Riwayat Waktu Sistem -->
                <div class="info-box p-3">
                    <small class="text-secondary d-block mb-1 font-monospace" style="font-size: 0.8rem;">
                        <i class="bi bi-clock-history me-1" style="color: #0F8B44;"></i> INFORMASI WAKTU SISTEM
                    </small>
                    <span class="fw-semibold text-body small">
                        Dibuat pada: {{ $pengumuman->created_at ? $pengumuman->created_at->format('d M Y, H:i') : '-' }} 
                        @if($pengumuman->updated_at && $pengumuman->updated_at != $pengumuman->created_at)
                            <span class="d-inline-block ms-md-2 text-secondary">| Terakhir diubah: {{ $pengumuman->updated_at->format('d M Y, H:i') }}</span>
                        @endif
                    </span>
                </div>

            </div>
        </div>
    </div>
@endsection