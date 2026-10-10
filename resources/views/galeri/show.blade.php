@extends('layouts.app')

@section('title', $galeri->judul . ' - Galeri SDIT Al-Hikmah')

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
        .detail-media-container {
            width: 100%;
            max-height: 500px;
            background-color: #0f172a;
            border-radius: 1rem;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .detail-media {
            width: 100%;
            max-height: 500px;
            object-fit: contain;
        }
        .info-box {
            background-color: #f8f9fa;
            border: 1px solid rgba(0, 0, 0, 0.05);
            border-radius: 1rem;
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
        <a href="{{ route('galeri.index') }}" class="btn rounded-pill px-4 fw-semibold shadow-sm" style="border: 1px solid #0F8B44; color: #0F8B44;">
            <i class="bi bi-arrow-left me-2"></i> Kembali ke Daftar Galeri
        </a>
    </div>

    <!-- KARTU DETAIL GALERI -->
    <div class="row justify-content-center mb-5">
        <div class="col-lg-9">
            <div class="card-modern p-4 p-md-5">
                
                <!-- Badge Kategori & Tanggal -->
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="badge text-white px-3 py-2 rounded-pill fw-semibold" style="background-color: #0F8B44;">
                        <i class="bi bi-tag-fill me-1"></i> {{ $galeri->kategori }}
                    </span>
                    <span class="text-secondary small">
                        <i class="bi bi-calendar3 me-1"></i> {{ \Carbon\Carbon::parse($galeri->tanggal)->format('d F Y') }}
                    </span>
                </div>

                <!-- Judul Utama -->
                <h2 class="fw-bold text-body mb-4">{{ $galeri->judul }}</h2>

                <!-- Tampilan Media Utama (Foto / Video) -->
                <div class="detail-media-container mb-4 shadow-sm">
                    @if($galeri->file && file_exists(public_path('uploads/galeri/' . $galeri->file)))
                        @if($galeri->kategori == 'Video')
                            <video controls class="detail-media">
                                <source src="{{ asset('uploads/galeri/' . $galeri->file) }}" type="video/mp4">
                                Browser Anda tidak mendukung pemutaran video.
                            </video>
                        @else
                            <img src="{{ asset('uploads/galeri/' . $galeri->file) }}" alt="{{ $galeri->judul }}" class="detail-media">
                        @endif
                    @else
                        <div class="text-center py-5 text-white opacity-50">
                            <i class="bi bi-image display-1 d-block mb-2"></i>
                            <p class="small">File media tidak ditemukan atau belum diunggah.</p>
                        </div>
                    @endif
                </div>

                <!-- Keterangan / Deskripsi Lengkap -->
                <div class="info-box p-4 mb-4">
                    <h6 class="fw-bold text-body mb-2"><i class="bi bi-info-circle me-2" style="color: #0F8B44;"></i> Keterangan Kegiatan</h6>
                    <p class="text-secondary mb-0" style="line-height: 1.7; white-space: pre-line;">{{ $galeri->keterangan ?? 'Tidak ada keterangan tambahan.' }}</p>
                </div>

                <!-- Informasi Sistem -->
                <div class="text-secondary small border-top pt-3">
                    <i class="bi bi-clock-history me-1"></i> Ditambahkan pada: {{ $galeri->created_at ? $galeri->created_at->format('d M Y, H:i') : '-' }}
                </div>

            </div>
        </div>
    </div>
@endsection