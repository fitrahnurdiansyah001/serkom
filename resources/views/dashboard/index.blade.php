@extends('layouts.app')

@section('title', 'Dashboard - SDIT Al-Hikmah')

@section('content')
    <style>
        .card-modern {
            background-color: var(--bs-body-bg);
            border: 1px solid var(--bs-border-color, rgba(0, 0, 0, 0.08));
            border-radius: 1rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.03), 0 2px 4px -1px rgba(0, 0, 0, 0.02);
            transition: all 0.2s ease-in-out;
        }
        .card-modern:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(15, 139, 68, 0.08);
            border-color: rgba(15, 139, 68, 0.3);
        }
        .icon-box-green {
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #0F8B44;
            color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(15, 139, 68, 0.3);
        }
        /* Perbaikan kontras Visi Misi pada Dark Mode */
        html[data-bs-theme="dark"] .visi-box {
            background-color: rgba(255, 255, 255, 0.03) !important;
            color: #cbd5e1 !important;
            border-color: #0F8B44 !important;
        }
    </style>

    <!-- BANNER UTAMA -->
    <div class="card border-0 text-white mb-4 shadow-sm" style="background: linear-gradient(135deg, #0F8B44 0%, #0c7338 100%); border-radius: 1rem;">
      <div class="card-body p-4 p-md-5 d-flex flex-column flex-md-row justify-content-between align-items-md-center">
        <div>
          <h3 class="fw-bold mb-1 text-white">Dashboard Akademik</h3>
          <p class="mb-0 text-white-50 fs-6">Selamat datang kembali, {{ Auth::user()->name ?? 'Administrator' }}.</p>
        </div>
        <div class="mt-3 mt-md-0">
          <span class="bg-white px-4 py-2 fw-semibold shadow-sm d-inline-flex align-items-center" style="color: #0F8B44; border-radius: 2rem; font-size: 0.9rem;">
            <i class="bi bi-calendar-event me-2"></i> Tahun Ajaran {{ date('Y') }}/{{ date('Y') + 1 }}
          </span>
        </div>
      </div>
    </div>

    <!-- KARTU STATISTIK GRID -->
    <div class="row g-4 mb-3">
      @php
        $stats = [
            ['title' => 'Guru', 'count' => $totalGuru ?? 0, 'icon' => 'bi-person-badge', 'route' => 'guru.index'],
            ['title' => 'Siswa', 'count' => $totalSiswa ?? 0, 'icon' => 'bi-people', 'route' => 'siswa.index'],
            ['title' => 'Ekstrakurikuler', 'count' => $totalEkskul ?? 0, 'icon' => 'bi-dribbble', 'route' => 'ekskul.index'],
            ['title' => 'Prestasi', 'count' => $totalPrestasi ?? 0, 'icon' => 'bi-trophy', 'route' => 'prestasi.index'],
            ['title' => 'Galeri', 'count' => $totalGaleri ?? 0, 'icon' => 'bi-images', 'route' => 'galeri.index'],
            ['title' => 'Berita', 'count' => $totalBerita ?? 0, 'icon' => 'bi-newspaper', 'route' => 'berita.index'],
            ['title' => 'Pengumuman', 'count' => $totalPengumuman ?? 0, 'icon' => 'bi-megaphone', 'route' => 'pengumuman.index'],
            ['title' => 'Program Sekolah', 'count' => $totalProgram ?? 0, 'icon' => 'bi-star', 'route' => 'program.index'],
            ['title' => 'Data Pengguna', 'count' => $totalUser ?? 0, 'icon' => 'bi-shield-lock', 'route' => 'users.index'],
        ];
      @endphp

      @foreach($stats as $stat)
      <div class="col-12 col-md-6 col-lg-4">
        <a href="{{ Route::has($stat['route']) ? route($stat['route']) : '#' }}" class="text-decoration-none">
          <div class="card-modern h-100 p-3 p-xl-4 d-flex align-items-center">
            <div class="icon-box-green me-3 flex-shrink-0">
              <i class="bi {{ $stat['icon'] }} fs-5"></i>
            </div>
            <div>
              <h4 class="fw-bold mb-0 lh-1" style="color: #0F8B44;">{{ $stat['count'] }}</h4>
              <span class="text-secondary small fw-medium">{{ $stat['title'] }}</span>
            </div>
          </div>
        </a>
      </div>
      @endforeach
    </div>

    <!-- KONTEN: Profil, Berita, & Pengumuman -->
    <div class="row g-4 mb-4">  
      <div class="col-lg-4">  
        <div class="card-modern h-100 d-flex flex-column overflow-hidden">
          <div class="p-4 text-white d-flex justify-content-between align-items-center" style="background-color: #0F8B44;">
            <h6 class="fw-bold mb-0"><i class="bi bi-building me-2"></i> Identitas Sekolah</h6>
            <a href="{{ route('profil') }}" class="text-white text-decoration-none small fw-semibold">Edit <i class="bi bi-pencil-square"></i></a>
          </div>
          <div class="p-4 flex-grow-1">
            <div class="mb-3 d-flex justify-content-between align-items-center border-bottom pb-2">
              <small class="text-secondary">Nama Sekolah</small>
              <span class="fw-semibold text-end">{{ optional($profil)->nama_sekolah ?? (optional($profil)->nama ?? '-') }}</span>
            </div>
            <div class="mb-3 d-flex justify-content-between align-items-center border-bottom pb-2">
              <small class="text-secondary">Kepala Sekolah</small>
              <span class="fw-semibold text-end">{{ optional($profil)->kepala_sekolah ?? '-' }}</span>
            </div>
            <div class="mb-3 d-flex justify-content-between align-items-center border-bottom pb-2">
              <small class="text-secondary">NPSN</small>
              <span class="fw-semibold text-end">{{ optional($profil)->npsn ?? '-' }}</span>
            </div>
            <div class="pt-2">
              <small class="text-secondary d-block mb-1 fw-bold">Visi & Misi:</small>
              @php
                $visiMisi = optional($profil)->visi_misi ?? optional($profil)->visi ?? optional($profil)->misi ?? null;
              @endphp

              @if($visiMisi)
                <p class="visi-box mb-0 fst-italic small bg-body-tertiary p-3 rounded-3 border-start border-3" style="border-color: #0F8B44 !important;">"{!! $visiMisi !!}"</p>
              @else
                <span class="text-secondary small fst-italic">Belum ada data visi misi yang diinput.</span>
              @endif
            </div>
          </div>
        </div>
      </div>

      <!-- KOLOM TENGAH: Berita Terbaru -->
      <div class="col-lg-4">
        <div class="card-modern h-100 d-flex flex-column overflow-hidden">
          <div class="p-4 text-white d-flex justify-content-between align-items-center" style="background-color: #0F8B44;">
            <h6 class="fw-bold mb-0"><i class="bi bi-newspaper me-2"></i> Berita</h6>
            <a href="{{ route('berita.index') }}" class="text-white text-decoration-none small fw-semibold">Semua →</a>
          </div>
          <div class="p-0 flex-grow-1">
            <div class="list-group list-group-flush border-0 bg-transparent">
              @forelse($beritas ?? [] as $berita)
                <a href="{{ route('berita.index') }}" class="list-group-item list-group-item-action p-4 border-bottom d-flex gap-3 align-items-start bg-transparent">
                  @if($berita->gambar && file_exists(public_path('uploads/berita/' . $berita->gambar)))
                    <img src="{{ asset('uploads/berita/' . $berita->gambar) }}" class="rounded object-fit-cover flex-shrink-0 shadow-sm" style="width: 60px; height: 60px;" alt="img">
                  @else
                    <div class="rounded d-flex align-items-center justify-content-center flex-shrink-0" style="width: 60px; height: 60px; background-color: rgba(15, 139, 68, 0.1); color: #0F8B44;">
                      <i class="bi bi-image fs-5"></i>
                    </div>
                  @endif
                  <div class="overflow-hidden">
                    <h6 class="fw-semibold mb-1 text-truncate">{{ $berita->judul }}</h6>
                    <small class="text-secondary d-block mb-1"><i class="bi bi-clock me-1"></i> {{ date('d M Y', strtotime($berita->tanggal)) }}</small>
                  </div>
                </a>
              @empty
                <div class="text-center py-5 text-secondary">Belum ada berita.</div>
              @endforelse
            </div>
          </div>
        </div>
      </div>

      <!-- KOLOM KANAN: Pengumuman Terbaru -->
      <div class="col-lg-4">
        <div class="card-modern h-100 d-flex flex-column overflow-hidden">
          <div class="p-4 text-white d-flex justify-content-between align-items-center" style="background-color: #0F8B44;">
            <h6 class="fw-bold mb-0"><i class="bi bi-megaphone me-2"></i> Pengumuman</h6>
            <a href="{{ route('pengumuman.index') }}" class="text-white text-decoration-none small fw-semibold">Semua →</a>
          </div>
          <div class="p-0 flex-grow-1">
            <div class="list-group list-group-flush border-0 bg-transparent">
              @forelse($pengumumans ?? [] as $pengumuman)
                <a href="{{ route('pengumuman.index') }}" class="list-group-item list-group-item-action p-4 border-bottom bg-transparent">
                  <div class="d-flex justify-content-between mb-1 align-items-center">
                    <span class="rounded-pill fw-medium px-2 py-1" style="font-size: 0.7rem; background-color: rgba(15, 139, 68, 0.1); color: #0F8B44;">
                      {{ date('d M Y', strtotime($pengumuman->tanggal)) }}
                    </span>
                  </div>
                  <h6 class="fw-semibold mb-1 text-truncate">{{ $pengumuman->judul }}</h6>
                  <p class="text-secondary small mb-0 text-truncate-2">{{ $pengumuman->isi }}</p>
                </a>
              @empty
                <div class="text-center py-5 text-secondary">
                    <i class="bi bi-bell-slash fs-2 d-block mb-2 opacity-25"></i>
                    <small>Belum ada pengumuman.</small>
                </div>
              @endforelse
            </div>
          </div>
        </div>
      </div>

    </div>

    <!-- TABEL DAFTAR PROGRAM UNGGULAN SEKOLAH -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card-modern overflow-hidden">
                <div class="p-4 text-white d-flex justify-content-between align-items-center" style="background-color: #0F8B44;">
                    <h6 class="fw-bold mb-0"><i class="bi bi-star-fill me-2"></i> Daftar Program Unggulan Sekolah</h6>
                    <a href="{{ route('program.index') }}" class="text-white text-decoration-none small fw-semibold">Kelola Program →</a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-body-tertiary">
                                <tr>
                                    <th class="py-3 px-4 text-body-secondary fw-semibold" width="5%">NO</th>
                                    <th class="py-3 text-body-secondary fw-semibold" width="30%">NAMA PROGRAM</th>
                                    <th class="py-3 text-body-secondary fw-semibold">DESKRIPSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($programs ?? [] as $key => $prog)
                                <tr>
                                    <td class="px-4 text-body-secondary">{{ $key + 1 }}</td>
                                    <td class="fw-bold text-body">{{ $prog->nama_program }}</td>
                                    <td class="text-secondary small">{{ $prog->deskripsi }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="text-center py-4 text-secondary">Belum ada data program sekolah yang diinput.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- PINTASAN MODUL UTAMA -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card-modern overflow-hidden">
                <div class="p-4 text-white d-flex justify-content-between align-items-center" style="background-color: #0F8B44;">
                    <h6 class="fw-bold mb-0"><i class="bi bi-grid-fill me-2"></i> Pintasan Modul Utama</h6>
                    <small class="text-white-50">Akses cepat manajemen sekolah</small>
                </div>
                <div class="p-4">
                    <div class="row g-3">
                        <div class="col-md-3 col-6">
                            <a href="{{ route('guru.index') }}" class="text-decoration-none">
                                <div class="p-3 border rounded-3 bg-body-tertiary h-100 hover-lift d-flex align-items-center gap-3">
                                    <div class="text-white rounded-3 p-2 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background-color: #0F8B44;">
                                        <i class="bi bi-person-badge"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0 fw-semibold text-body" style="font-size: 0.9rem;">Kelola Guru</h6>
                                        <small class="text-secondary" style="font-size: 0.75rem;">Data & Pengajar</small>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-3 col-6">
                            <a href="{{ route('siswa.index') }}" class="text-decoration-none">
                                <div class="p-3 border rounded-3 bg-body-tertiary h-100 hover-lift d-flex align-items-center gap-3">
                                    <div class="text-white rounded-3 p-2 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background-color: #0F8B44;">
                                        <i class="bi bi-people"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0 fw-semibold text-body" style="font-size: 0.9rem;">Kelola Siswa</h6>
                                        <small class="text-secondary" style="font-size: 0.75rem;">Data Akademik</small>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-3 col-6">
                            <a href="{{ route('galeri.index') }}" class="text-decoration-none">
                                <div class="p-3 border rounded-3 bg-body-tertiary h-100 hover-lift d-flex align-items-center gap-3">
                                    <div class="text-white rounded-3 p-2 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background-color: #0F8B44;">
                                        <i class="bi bi-images"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0 fw-semibold text-body" style="font-size: 0.9rem;">Galeri Foto</h6>
                                        <small class="text-secondary" style="font-size: 0.75rem;">Dokumentasi</small>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-3 col-6">
                            <a href="{{ route('prestasi.index') }}" class="text-decoration-none">
                                <div class="p-3 border rounded-3 bg-body-tertiary h-100 hover-lift d-flex align-items-center gap-3">
                                    <div class="text-white rounded-3 p-2 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background-color: #0F8B44;">
                                        <i class="bi bi-trophy"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0 fw-bold text-body" style="font-size: 0.9rem;">Prestasi</h6>
                                        <small class="text-secondary" style="font-size: 0.75rem;">Pencapaian</small>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection