@extends('layouts.app')

@section('title', 'Detail Ekskul: ' . $ekstrakurikuler->nama_ekskul . ' - SDIT Al-Hikmah')

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
        .ekskul-img-large {
            width: 100%;
            max-height: 400px;
            object-fit: cover;
            border-radius: 1rem;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }
        /* Penyesuaian Kotak Informasi agar Kontras Sempurna di Dark Mode */
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
        html[data-bs-theme="dark"] .info-box .text-dark {
            color: #f8f9fa !important;
        }
        html[data-bs-theme="dark"] .info-box .text-muted {
            color: #94a3b8 !important;
        }
    </style>

    <!-- TOMBOL KEMBALI -->
    <div class="mb-4">
        <a href="{{ route('ekskul.index') }}" class="btn rounded-pill px-4 fw-semibold shadow-sm" style="border: 1px solid #0F8B44; color: #0F8B44;">
            <i class="bi bi-arrow-left me-2"></i> Kembali ke Daftar Ekstrakurikuler
        </a>
    </div>

    <!-- KARTU DETAIL EKSTRAKURIKULER -->
    <div class="row justify-content-center mb-5">
        <div class="col-lg-8">
            <div class="card-modern p-4 p-md-5">
                
                <!-- Foto / Dokumentasi Kegiatan -->
                <div class="mb-4 text-center">
                    @if(!empty($ekstrakurikuler->foto) && file_exists(public_path('uploads/ekstrakurikuler/' . $ekstrakurikuler->foto)))
                        <img src="{{ asset('uploads/ekstrakurikuler/' . $ekstrakurikuler->foto) }}" alt="{{ $ekstrakurikuler->nama_ekskul }}" class="ekskul-img-large">
                    @else
                        <div class="rounded-4 d-flex align-items-center justify-content-center py-5 shadow-sm border" style="min-height: 250px; background-color: rgba(15, 139, 68, 0.05); color: #0F8B44;">
                            <div>
                                <i class="bi bi-joystick display-1 mb-2"></i>
                                <p class="mb-0 fw-semibold">Tidak ada foto dokumentasi</p>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Nama Ekstrakurikuler -->
                <h2 class="fw-bold text-body mb-3">{{ $ekstrakurikuler->nama_ekskul }}</h2>

                <!-- Informasi Rinci Atribut Data -->
                <div class="row text-start g-3">
                    
                    <!-- Pembina -->
                    <div class="col-md-6">
                        <div class="info-box p-3 h-100">
                            <small class="text-secondary d-block mb-1 font-monospace" style="font-size: 0.8rem;">
                                <i class="bi bi-person-badge me-1" style="color: #0F8B44;"></i> GURU PEMBINA
                            </small>
                            <span class="fw-bold text-body fs-6">{{ $ekstrakurikuler->pembina ?? 'Belum ditentukan' }}</span>
                        </div>
                    </div>

                    <!-- Jadwal -->
                    <div class="col-md-6">
                        <div class="info-box p-3 h-100">
                            <small class="text-secondary d-block mb-1 font-monospace" style="font-size: 0.8rem;">
                                <i class="bi bi-calendar-event me-1" style="color: #0F8B44;"></i> JADWAL KEGIATAN
                            </small>
                            <span class="fw-bold text-body fs-6">{{ $ekstrakurikuler->jadwal ?? 'Fleksibel' }}</span>
                        </div>
                    </div>

                    <!-- Deskripsi / Keterangan Lengkap -->
                    <div class="col-12">
                        <div class="info-box p-3">
                            <small class="text-secondary d-block mb-2 font-monospace" style="font-size: 0.8rem;">
                                <i class="bi bi-card-text me-1" style="color: #0F8B44;"></i> DESKRIPSI & PROGRAM KEGIATAN
                            </small>
                            <p class="text-body mb-0 lh-base" style="font-size: 0.95rem; white-space: pre-line;">
                                {{ $ekstrakurikuler->deskripsi ?? 'Tidak ada deskripsi tambahan.' }}
                            </p>
                        </div>
                    </div>

                    <!-- Riwayat Waktu Sistem -->
                    <div class="col-12">
                        <div class="info-box p-3">
                            <small class="text-secondary d-block mb-1 font-monospace" style="font-size: 0.8rem;">
                                <i class="bi bi-clock-history me-1" style="color: #0F8B44;"></i> INFORMASI WAKTU SISTEM
                            </small>
                            <span class="fw-semibold text-body small">
                                Dicatat pada: {{ $ekstrakurikuler->created_at ? $ekstrakurikuler->created_at->format('d M Y, H:i') : '-' }} 
                                @if($ekstrakurikuler->updated_at && $ekstrakurikuler->updated_at != $ekstrakurikuler->created_at)
                                    <span class="d-inline-block ms-md-2 text-secondary">| Terakhir diubah: {{ $ekstrakurikuler->updated_at->format('d M Y, H:i') }}</span>
                                @endif
                            </span>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection