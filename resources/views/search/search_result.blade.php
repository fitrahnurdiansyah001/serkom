@extends('layouts.app')

@section('title', 'Pencarian: ' . $keyword . ' - SDIT Al-Hikmah')

@section('content')
    <style>
        :root {
            --primary-green: #0F8B44;
            --accent-green: #0c7338;
            --light-green: #4ade80;
        }

        /* Warna Teks & Background Utama */
        .text-theme {
            color: var(--primary-green) !important;
        }
        .bg-theme {
            background-color: var(--primary-green) !important;
            color: #ffffff !important;
        }

        /* Styling Kartu Area Kosong */
        .card-empty {
            background-color: var(--bs-card-bg, #ffffff);
            border: 1px dashed var(--bs-border-color, rgba(0,0,0,0.1));
            transition: all 0.3s ease;
        }

        /* Styling List Item Interaktif */
        .list-group-custom .list-group-item {
            background-color: var(--bs-card-bg);
            border-color: var(--bs-border-color, rgba(0,0,0,0.08));
            color: var(--bs-body-color);
            transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
        }
        
        .list-group-custom .list-group-item:hover {
            background-color: rgba(15, 139, 68, 0.05);
            border-color: var(--primary-green);
            transform: translateX(6px); /* Efek geser lembut saat di-hover */
            z-index: 2;
        }

        html[data-bs-theme="dark"] .text-theme {
            color: var(--light-green) !important;
        }
        
        html[data-bs-theme="dark"] .card-empty {
            background-color: #1e293b;
            border-color: #334155;
        }

        html[data-bs-theme="dark"] .list-group-custom .list-group-item {
            background-color: #1e293b;
            border-color: #334155;
        }

        html[data-bs-theme="dark"] .list-group-custom .list-group-item:hover {
            background-color: rgba(74, 222, 128, 0.1);
            border-color: var(--light-green);
        }

        /* Teks abu-abu lebih terang di dark mode */
        html[data-bs-theme="dark"] .text-muted-custom {
            color: #94a3b8 !important;
        }
    </style>

    <div class="mb-4">
        <!-- Menggunakan text-body agar otomatis menyesuaikan (hitam/putih) -->
        <h3 class="fw-bold text-body">Hasil Pencarian untuk: <span class="text-theme">"{{ $keyword }}"</span></h3>
        <p class="text-muted text-muted-custom">Menampilkan hasil pencarian dari seluruh modul sekolah.</p>
    </div>

    @php
        $totalHasil = $hasilSiswa->count() + $hasilGuru->count() + $hasilBerita->count() + $hasilEkskul->count() + $hasilGaleri->count() + $hasilPengumuman->count() + $hasilPrestasi->count();
    @endphp

    @if($totalHasil == 0)
        <!-- Tampilan Jika Hasil Kosong -->
        <div class="card card-empty shadow-sm rounded-4 text-center py-5">
            <div class="card-body">
                <i class="bi bi-search fs-1 text-muted text-muted-custom opacity-50 d-block mb-3"></i>
                <h5 class="fw-bold text-body">Tidak ditemukan hasil</h5>
                <p class="text-muted text-muted-custom small mb-0">Tidak ada data yang cocok dengan kata kunci "{{ $keyword }}".</p>
            </div>
        </div>
    @else
        <!-- SISWA -->
        @if($hasilSiswa->count() > 0)
            <div class="mb-4">
                <h5 class="fw-bold text-theme mb-3"><i class="bi bi-people-fill me-2"></i> Siswa ({{ $hasilSiswa->count() }})</h5>
                <div class="list-group list-group-custom shadow-sm rounded-4 overflow-hidden">
                    @foreach($hasilSiswa as $siswa)
                        <a href="{{ route('siswa.show', $siswa->slug) }}" class="list-group-item list-group-item-action p-3 d-flex justify-content-between align-items-center text-decoration-none">
                            <div>
                                <h6 class="fw-bold mb-1 text-body">{{ $siswa->nama_siswa }}</h6>
                                <small class="text-muted text-muted-custom">NISN: {{ $siswa->nisn }} | Kelas: {{ $siswa->kelas ?? '-' }} | Kelamin: {{ $siswa->jenis_kelamin }}</small>
                            </div>
                            <span class="badge bg-theme rounded-pill shadow-sm"><i class="bi bi-chevron-right"></i></span>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- GURU -->
        @if($hasilGuru->count() > 0)
            <div class="mb-4">
                <h5 class="fw-bold text-theme mb-3"><i class="bi bi-person-badge-fill me-2"></i> Guru ({{ $hasilGuru->count() }})</h5>
                <div class="list-group list-group-custom shadow-sm rounded-4 overflow-hidden">
                    @foreach($hasilGuru as $guru)
                        <a href="{{ route('guru.show', $guru->slug ?? $guru->slug) }}" class="list-group-item list-group-item-action p-3 d-flex justify-content-between align-items-center text-decoration-none">
                            <div>
                                <h6 class="fw-bold mb-1 text-body">{{ $guru->nama_guru }}</h6>
                                <small class="text-muted text-muted-custom">NIP: {{ $guru->nip ?? '-' }} | Mapel: {{ $guru->mata_pelajaran ?? '-' }}</small>
                            </div>
                            <span class="badge bg-theme rounded-pill shadow-sm"><i class="bi bi-chevron-right"></i></span>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- BERITA -->
        @if($hasilBerita->count() > 0)
            <div class="mb-4">
                <h5 class="fw-bold text-theme mb-3"><i class="bi bi-newspaper me-2"></i> Berita ({{ $hasilBerita->count() }})</h5>
                <div class="list-group list-group-custom shadow-sm rounded-4 overflow-hidden">
                    @foreach($hasilBerita as $berita)
                        <a href="{{ route('berita.show', $berita->slug ?? $berita->slug) }}" class="list-group-item list-group-item-action p-3 d-flex justify-content-between align-items-center text-decoration-none">
                            <div>
                                <h6 class="fw-bold mb-1 text-body">{{ $berita->judul }}</h6>
                                <small class="text-muted text-muted-custom">{{ Str::limit(strip_tags($berita->isi), 100) }}</small>
                            </div>
                            <span class="badge bg-theme rounded-pill shadow-sm"><i class="bi bi-chevron-right"></i></span>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- EKSTRAKURIKULER -->
        @if($hasilEkskul->count() > 0)
            <div class="mb-4">
                <h5 class="fw-bold text-theme mb-3"><i class="bi bi-dribbble me-2"></i> Ekstrakurikuler ({{ $hasilEkskul->count() }})</h5>
                <div class="list-group list-group-custom shadow-sm rounded-4 overflow-hidden">
                    @foreach($hasilEkskul as $ekskul)
                        <a href="{{ route('ekskul.show', $ekskul->slug ?? $ekskul->slug) }}" class="list-group-item list-group-item-action p-3 d-flex justify-content-between align-items-center text-decoration-none">
                            <div>
                                <h6 class="fw-bold mb-1 text-body">{{ $ekskul->nama_ekskul }}</h6>
                                <small class="text-muted text-muted-custom">Pembina: {{ $ekskul->pembina ?? '-' }} | Jadwal: {{ $ekskul->jadwal ?? '-' }}</small>
                            </div>
                            <span class="badge bg-theme rounded-pill shadow-sm"><i class="bi bi-chevron-right"></i></span>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- GALERI -->
        @if($hasilGaleri->count() > 0)
            <div class="mb-4">
                <h5 class="fw-bold text-theme mb-3"><i class="bi bi-images me-2"></i> Galeri ({{ $hasilGaleri->count() }})</h5>
                <div class="list-group list-group-custom shadow-sm rounded-4 overflow-hidden">
                    @foreach($hasilGaleri as $galeri)
                        <a href="{{ route('galeri.show', $galeri->slug ?? $galeri->slug) }}" class="list-group-item list-group-item-action p-3 d-flex justify-content-between align-items-center text-decoration-none">
                            <div>
                                <h6 class="fw-bold mb-1 text-body">{{ $galeri->judul }}</h6>
                                <small class="text-muted text-muted-custom">Kategori: {{ $galeri->kategori }} | Tanggal: {{ $galeri->tanggal }}</small>
                            </div>
                            <span class="badge bg-theme rounded-pill shadow-sm"><i class="bi bi-chevron-right"></i></span>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- PENGUMUMAN -->
        @if($hasilPengumuman->count() > 0)
            <div class="mb-4">
                <h5 class="fw-bold text-theme mb-3"><i class="bi bi-megaphone-fill me-2"></i> Pengumuman ({{ $hasilPengumuman->count() }})</h5>
                <div class="list-group list-group-custom shadow-sm rounded-4 overflow-hidden">
                    @foreach($hasilPengumuman as $pengumuman)
                        <a href="{{ route('pengumuman.show', $pengumuman->slug ?? $pengumuman->slug) }}" class="list-group-item list-group-item-action p-3 d-flex justify-content-between align-items-center text-decoration-none">
                            <div>
                                <h6 class="fw-bold mb-1 text-body">{{ $pengumuman->judul }}</h6>
                                <small class="text-muted text-muted-custom">{{ Str::limit(strip_tags($pengumuman->isi), 100) }}</small>
                            </div>
                            <span class="badge bg-theme rounded-pill shadow-sm"><i class="bi bi-chevron-right"></i></span>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- PRESTASI -->
        @if($hasilPrestasi->count() > 0)
            <div class="mb-4">
                <h5 class="fw-bold text-theme mb-3"><i class="bi bi-trophy-fill me-2"></i> Prestasi ({{ $hasilPrestasi->count() }})</h5>
                <div class="list-group list-group-custom shadow-sm rounded-4 overflow-hidden">
                    @foreach($hasilPrestasi as $prestasi)
                        <a href="{{ route('prestasi.show', $prestasi->slug ?? $prestasi->slug) }}" class="list-group-item list-group-item-action p-3 d-flex justify-content-between align-items-center text-decoration-none">
                            <div>
                                <h6 class="fw-bold mb-1 text-body">{{ $prestasi->nama_prestasi }}</h6>
                                <small class="text-muted text-muted-custom">Juara: {{ $prestasi->juara }} | Tingkat: {{ $prestasi->tingkat }} ({{ $prestasi->tahun }})</small>
                            </div>
                            <span class="badge bg-theme rounded-pill shadow-sm"><i class="bi bi-chevron-right"></i></span>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    @endif
@endsection