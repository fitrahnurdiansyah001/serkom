@extends('layouts.app')

@section('title', $berita->judul . ' - SDIT Al-Hikmah')

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
        .berita-img-large {
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
        <a href="{{ route('berita.index') }}" class="btn rounded-pill px-4 fw-semibold shadow-sm" style="border: 1px solid #0F8B44; color: #0F8B44;">
            <i class="bi bi-arrow-left me-2"></i> Kembali ke Daftar Berita
        </a>
    </div>

    <!-- KARTU DETAIL BERITA -->
    <div class="row justify-content-center mb-5">
        <div class="col-lg-9">
            <div class="card-modern p-4 p-md-5">
                
                <!-- Gambar Utama Berita -->
                <div class="mb-4 text-center">
                    @if(!empty($berita->gambar) && file_exists(public_path('uploads/berita/' . $berita->gambar)))
                        <img src="{{ asset('uploads/berita/' . $berita->gambar) }}" alt="{{ $berita->judul }}" class="berita-img-large">
                    @else
                        <div class="rounded-4 d-flex align-items-center justify-content-center py-5 shadow-sm border" style="min-height: 250px; background-color: rgba(15, 139, 68, 0.05); color: #0F8B44;">
                            <div>
                                <i class="bi bi-newspaper display-1 mb-2"></i>
                                <p class="mb-0 fw-semibold">Tidak ada gambar berita</p>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Status & Tanggal -->
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="badge {{ $berita->status == 'Publish' ? 'bg-success' : 'bg-warning text-dark' }} px-3 py-2 rounded-pill fw-semibold" style="font-size: 0.85rem;">
                        {{ $berita->status }}
                    </span>
                    <span class="text-secondary fw-medium">
                        <i class="bi bi-calendar-event me-1"></i> {{ date('d F Y', strtotime($berita->tanggal ?? $berita->created_at)) }}
                    </span>
                </div>

                <!-- Judul Utama -->
                <h1 class="fw-bold text-body mb-2" style="line-height: 1.3;">{{ $berita->judul }}</h1>

                <!-- Penulis -->
                <div class="d-flex align-items-center text-secondary mb-4 pb-3 border-bottom">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-person-circle fs-5 me-2" style="color: #0F8B44;"></i>
                        <span>Ditulis oleh <strong class="text-body">{{ $berita->penulis ?? 'Admin Sekolah' }}</strong></span>
                    </div>
                </div>

                <!-- Isi Berita -->
                <div class="mb-4">
                    <div class="text-body lh-lg" style="font-size: 1.05rem; white-space: pre-line;">
                        {!! $berita->isi !!}
                    </div>
                </div>

                <hr class="my-4 opacity-10">

                <!-- Informasi Sistem -->
                <div class="info-box p-3">
                    <small class="text-secondary d-block mb-1 font-monospace" style="font-size: 0.8rem;">
                        <i class="bi bi-clock-history me-1" style="color: #0F8B44;"></i> INFORMASI WAKTU SISTEM
                    </small>
                    <span class="fw-semibold text-body small">
                        Dibuat pada: {{ $berita->created_at ? $berita->created_at->format('d M Y, H:i') : '-' }} 
                        @if($berita->updated_at && $berita->updated_at != $berita->created_at)
                            <span class="d-inline-block ms-md-2 text-secondary">| Terakhir diubah: {{ $berita->updated_at->format('d M Y, H:i') }}</span>
                        @endif
                    </span>
                </div>

            </div>
        </div>
    </div>
@endsection