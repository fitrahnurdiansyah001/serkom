@extends('layouts.app')

@section('title', 'Detail Guru: ' . $guru->nama_guru . ' - SDIT Al-Hikmah')

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
        html[data-bs-theme="dark"] .info-box .text-body {
            color: #f8f9fa !important;
        }
    </style>

    <!-- TOMBOL KEMBALI -->
    <div class="mb-4">
        <a href="{{ route('guru.index') }}" class="btn rounded-pill px-4 fw-semibold shadow-sm" style="border: 1px solid #0F8B44; color: #0F8B44;">
            <i class="bi bi-arrow-left me-2"></i> Kembali ke Daftar Guru
        </a>
    </div>

    <!-- KARTU DETAIL GURU -->
    <div class="row justify-content-center mb-5">
        <div class="col-lg-8">
            <div class="card-modern p-4 p-md-5 text-center">
                
                <!-- Foto Profil Besar Portrait -->
                <div class="mb-4 d-flex justify-content-center">
                    @if(!empty($guru->foto) && file_exists(public_path('uploads/guru/' . $guru->foto)))
                        <img src="{{ asset('uploads/guru/' . $guru->foto) }}" alt="{{ $guru->nama_guru }}" class="profile-img-large">
                    @else
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($guru->nama_guru ?? 'Guru') }}&background=0F8B44&color=fff&size=256" alt="{{ $guru->nama_guru }}" class="profile-img-large">
                    @endif
                </div>

                <!-- Nama & Jabatan -->
                <h2 class="fw-bold text-body mb-2">{{ $guru->nama_guru }}</h2>
                <div class="mb-3">
                    <span class="badge text-white px-3 py-2 rounded-pill fw-semibold" style="background-color: #0F8B44; font-size: 0.9rem;">
                        <i class="bi bi-briefcase me-1"></i> {{ $guru->jabatan ?? 'Tenaga Pengajar Sekolah' }}
                    </span>
                </div>

                <hr class="my-4 opacity-10">

                <!-- Informasi Rinci Atribut Data -->
                <div class="row text-start g-3 px-md-3">
                    
                    <!-- NIP / NUPTK -->
                    <div class="col-md-6">
                        <div class="info-box p-3.5 h-100 p-3">
                            <small class="text-secondary d-block mb-1 font-monospace" style="font-size: 0.8rem;">
                                <i class="bi bi-card-text me-1" style="color: #0F8B44;"></i> NOMOR INDUK (NIP / NUPTK)
                            </small>
                            <span class="fw-bold text-body fs-6">{{ $guru->nip ?? 'Tidak ada data NIP' }}</span>
                        </div>
                    </div>

                    <!-- Mata Pelajaran -->
                    <div class="col-md-6">
                        <div class="info-box p-3.5 h-100 p-3">
                            <small class="text-secondary d-block mb-1 font-monospace" style="font-size: 0.8rem;">
                                <i class="bi bi-book me-1" style="color: #0F8B44;"></i> BIDANG MATA PELAJARAN
                            </small>
                            <span class="fw-bold text-body fs-6">{{ $guru->mata_pelajaran ?? 'Umum' }}</span>
                        </div>
                    </div>

                    <!-- Riwayat Tanggal -->
                    <div class="col-12">
                        <div class="info-box p-3">
                            <small class="text-secondary d-block mb-1 font-monospace" style="font-size: 0.8rem;">
                                <i class="bi bi-clock-history me-1" style="color: #0F8B44;"></i> INFORMASI WAKTU SISTEM
                            </small>
                            <span class="fw-semibold text-body small">
                                Ditambahkan pada: {{ $guru->created_at ? $guru->created_at->format('d M Y, H:i') : '-' }} 
                                @if($guru->updated_at && $guru->updated_at != $guru->created_at)
                                    <span class="d-inline-block ms-md-2 text-secondary">| Terakhir diubah: {{ $guru->updated_at->format('d M Y, H:i') }}</span>
                                @endif
                            </span>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection