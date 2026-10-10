@extends('layouts.app')

@section('title', 'Detail Siswa: ' . $siswa->nama_siswa . ' - SDIT Al-Hikmah')

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
        .profile-img-large {
            width: 170px;
            height: 170px;
            object-fit: cover;
            aspect-ratio: 1 / 1;
            border-radius: 50%;
            border: 5px solid #0F8B44;
            box-shadow: 0 10px 25px rgba(15, 139, 68, 0.25);
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
        <a href="{{ route('siswa.index') }}" class="btn rounded-pill px-4 fw-semibold shadow-sm" style="border: 1px solid #0F8B44; color: #0F8B44;">
            <i class="bi bi-arrow-left me-2"></i> Kembali ke Daftar Siswa
        </a>
    </div>

    <!-- KARTU DETAIL SISWA -->
    <div class="row justify-content-center mb-5">
        <div class="col-lg-8">
            <div class="card-modern p-4 p-md-5 text-center">
                
                <!-- Avatar Inisial Besar -->
                <div class="mb-4 d-flex justify-content-center">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($siswa->nama_siswa ?? 'Siswa') }}&background=0F8B44&color=fff&size=256" alt="{{ $siswa->nama_siswa }}" class="profile-img-large">
                </div>

                <!-- Nama & Tahun Masuk -->
                <h2 class="fw-bold text-body mb-2">{{ $siswa->nama_siswa }}</h2>
                <div class="mb-3">
                    <span class="badge text-white px-3 py-2 rounded-pill fw-semibold" style="background-color: #0F8B44; font-size: 0.9rem;">
                        <i class="bi bi-calendar-check me-1"></i> Tahun Masuk {{ $siswa->tahun_masuk ?? '-' }}
                    </span>
                </div>

                <hr class="my-4 opacity-10">

                <!-- Informasi Rinci Atribut Data -->
                <div class="row text-start g-3 px-md-3">
                    
                    <!-- NISN -->
                    <div class="col-md-6">
                        <div class="info-box p-3 h-100">
                            <small class="text-secondary d-block mb-1 font-monospace" style="font-size: 0.8rem;">
                                <i class="bi bi-card-text me-1" style="color: #0F8B44;"></i> NOMOR INDUK SISWA NASIONAL (NISN)
                            </small>
                            <span class="fw-bold text-body fs-6">{{ $siswa->nisn ?? '-' }}</span>
                        </div>
                    </div>

                    <!-- Jenis Kelamin -->
                    <div class="col-md-6">
                        <div class="info-box p-3 h-100">
                            <small class="text-secondary d-block mb-1 font-monospace" style="font-size: 0.8rem;">
                                <i class="bi bi-gender-ambiguous me-1" style="color: #0F8B44;"></i> JENIS KELAMIN
                            </small>
                            <span class="fw-bold text-body fs-6">{{ $siswa->jenis_kelamin ?? '-' }}</span>
                        </div>
                    </div>

                    <!-- Riwayat Waktu Sistem -->
                    <div class="col-12">
                        <div class="info-box p-3">
                            <small class="text-secondary d-block mb-1 font-monospace" style="font-size: 0.8rem;">
                                <i class="bi bi-clock-history me-1" style="color: #0F8B44;"></i> INFORMASI WAKTU SISTEM
                            </small>
                            <span class="fw-semibold text-body small">
                                Ditambahkan pada: {{ $siswa->created_at ? $siswa->created_at->format('d M Y, H:i') : '-' }} 
                                @if($siswa->updated_at && $siswa->updated_at != $siswa->created_at)
                                    <span class="d-inline-block ms-md-2 text-secondary">| Terakhir diubah: {{ $siswa->updated_at->format('d M Y, H:i') }}</span>
                                @endif
                            </span>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection