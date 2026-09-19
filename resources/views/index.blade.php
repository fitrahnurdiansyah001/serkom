@extends('layouts.app')

@section('title', 'Dashboard - Web Schools')

@section('content')
      <!-- BANNER UTAMA -->
      <div class="card border-0 text-white mb-4 shadow-sm rounded-4 overflow-hidden" style="background: linear-gradient(135deg, #0d6efd, #0dcaf0);">
        <div class="card-body p-4 p-lg-5 d-flex flex-column flex-md-row justify-content-between align-items-md-center">
          <div>
            <h2 class="fw-bold mb-2">Selamat Datang di Dashboard Sekolah</h2>
            <p class="mb-0 opacity-75 fs-5">Pusat Informasi Kegiatan, Profil Sekolah, dan Statistik Akademik.</p>
          </div>
          <div class="mt-3 mt-md-0">
            <span class="bg-white text-primary rounded-pill px-4 py-2 fw-bold shadow-sm d-inline-block">
              <i class="bi bi-calendar4-event me-2"></i> TA. {{ date('Y') }}/{{ date('Y') + 1 }}
            </span>
          </div>
        </div>
      </div>

      <!-- KARTU STATISTIK (Dinamis dari Database) -->
      <div class="row g-4 mb-4">
        <div class="col-md-4">
          <div class="card border-0 text-white shadow-sm card-stat-solid h-100 rounded-4" style="background: linear-gradient(45deg, #4f46e5, #6366f1);">
            <div class="card-body p-4 d-flex align-items-center justify-content-between">
              <div>
                <h6 class="text-white-50 mb-1">Total Guru & Pengajar</h6>
                <h2 class="fw-bold mb-0">{{ $totalGuru ?? 0 }} Personel</h2>
              </div>
              <div class="display-4 opacity-50"><i class="bi bi-person-badge"></i></div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card border-0 text-white shadow-sm card-stat-solid h-100 rounded-4" style="background: linear-gradient(45deg, #198754, #20c997);">
            <div class="card-body p-4 d-flex align-items-center justify-content-between">
              <div>
                <h6 class="text-white-50 mb-1">Total Siswa Terdaftar</h6>
                <h2 class="fw-bold mb-0">{{ $totalSiswa ?? 0 }} Siswa</h2>
              </div>
              <div class="display-4 opacity-50"><i class="bi bi-people-fill"></i></div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card border-0 text-dark shadow-sm card-stat-solid h-100 rounded-4" style="background: linear-gradient(45deg, #ffc107, #ffca2c);">
            <div class="card-body p-4 d-flex align-items-center justify-content-between">
              <div>
                <h6 class="text-dark-50 mb-1 opacity-75">Klub Ekstrakurikuler</h6>
                <h2 class="fw-bold mb-0">{{ $totalEkskul ?? 0 }} Klub Aktif</h2>
              </div>
              <div class="display-4 opacity-50"><i class="bi bi-trophy"></i></div>
            </div>
          </div>
        </div>
      </div>

      <!-- KONTEN: Profil & Berita (50:50) -->
      <div class="row g-4 mb-4">
        
        <!-- Identitas Sekolah (Dinamis dari Database ProfilSekolah) -->
        <div class="col-lg-6">
          <div class="card border-0 shadow-sm h-100 rounded-4 border">
            <div class="card-header bg-white border-bottom-0 pt-4 pb-0 d-flex justify-content-between align-items-center rounded-top-4">
              <h5 class="fw-bold text-dark mb-0"><i class="bi bi-building text-primary me-2"></i> Identitas Sekolah</h5>
              <a href="{{ route('profil') }}" class="btn btn-sm btn-outline-secondary rounded-pill">Detail Lengkap</a>
            </div>
            <div class="card-body">
              <ul class="list-group list-group-flush">
                <li class="list-group-item px-0 d-flex justify-content-between">
                  <span class="text-muted">Nama</span>
                  <span class="fw-semibold text-end">{{ $profil->nama_sekolah ?? 'SMAN 1 Web Schools' }}</span>
                </li>
                <li class="list-group-item px-0 d-flex justify-content-between">
                  <span class="text-muted">Kepala Sekolah</span>
                  <span class="fw-semibold text-end">{{ $profil->kepala_sekolah ?? '-' }}</span>
                </li>
                <li class="list-group-item px-0 d-flex justify-content-between">
                  <span class="text-muted">NPSN</span>
                  <span class="fw-semibold text-end">{{ $profil->npsn ?? '-' }}</span>
                </li>
                <li class="list-group-item px-0">
                  <span class="text-muted d-block mb-1">Visi Utama</span>
                  <em class="small">"{!! $profil->visi_misi ?? 'Belum diisi' !!}"</em>
                </li>
                <li class="list-group-item px-0">
                  <span class="text-muted d-block mb-1">Alamat</span>
                  <span class="fw-semibold small">{{ $profil->alamat ?? '-' }}</span>
                </li>
              </ul>
            </div>
          </div>
        </div>

        <!-- Berita Terbaru (Dinamis dari Database Berita) -->
        <div class="col-lg-6">
          <div class="card border-0 shadow-sm h-100 rounded-4 p-3 bg-white border">
            <div class="d-flex justify-content-between align-items-center mb-3 px-2">
              <h5 class="fw-bold mb-0"><i class="bi bi-newspaper text-danger me-2"></i> Berita Terbaru</h5>
              <a href="{{ route('berita.index') }}" class="text-decoration-none text-danger small fw-bold">Semua Berita <i class="bi bi-arrow-right"></i></a>
            </div>
            
            @forelse($beritas as $berita)
              <div class="card border bg-light rounded-4 mb-3 overflow-hidden">
                <div class="row g-0">
                  <div class="col-4">
                    @if($berita->gambar && file_exists(public_path('uploads/berita/' . $berita->gambar)))
                      <img src="{{ asset('uploads/berita/' . $berita->gambar) }}" class="img-fluid h-100 object-fit-cover" alt="{{ $berita->judul }}">
                    @else
                      <div class="bg-secondary bg-opacity-10 h-100 d-flex align-items-center justify-content-center text-muted py-4">
                        <i class="bi bi-image"></i>
                      </div>
                    @endif
                  </div>
                  <div class="col-8">
                    <div class="card-body py-3 px-3">
                      <span class="badge bg-primary bg-opacity-10 text-primary mb-1">{{ $berita->status }}</span>
                      <h6 class="fw-bold mb-1 text-dark">{{ $berita->judul }}</h6>
                      <p class="small text-muted mb-1 text-truncate">{{ $berita->isi }}</p>
                      <small class="text-muted"><i class="bi bi-clock me-1"></i> {{ date('d M Y', strtotime($berita->tanggal)) }}</small>
                    </div>
                  </div>
                </div>
              </div>
            @empty
              <div class="text-center py-5 text-muted">
                <i class="bi bi-journal-x fs-3 d-block mb-2"></i> Belum ada berita terbaru yang dipublikasikan.
              </div>
            @endforelse

          </div>
        </div>

      </div>
@endsection