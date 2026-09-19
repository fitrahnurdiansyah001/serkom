@extends('layouts.app')

@section('title', 'Galeri Sekolah - Web Schools')

@section('content')
    <div class="page-header mb-4 d-flex justify-content-between align-items-center">
      <div>
        <h1 class="page-title fw-bold">Galeri Dokumentasi</h1>
        <p class="page-subtitle text-muted">Koleksi foto kegiatan, fasilitas, dan momen penting sekolah.</p>
      </div>
      
      <!-- Tombol Tambah Khusus Admin -->
      @auth
        @if(Auth::user()->role === 'admin')
          <div>
            <button type="button" class="btn btn-primary rounded-pill px-4 shadow-sm" data-bs-toggle="modal" data-bs-target="#modalTambahGaleri">
              <i class="bi bi-upload me-2"></i> Unggah Dokumentasi
            </button>
          </div>
        @endif
      @endauth
    </div>

    @if(session('success'))
      <div class="alert alert-success alert-dismissible fade show rounded-4" role="alert">
        <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    <!-- Grid Galeri -->
    <div class="row g-4 mb-5">
      @forelse($galeris as $item)
        <div class="col-md-4">
          <div class="card border shadow-sm rounded-4 h-100 overflow-hidden">
            @if($item->file && file_exists(public_path('uploads/galeri/' . $item->file)))
              <a href="{{ asset('uploads/galeri/' . $item->file) }}" target="_blank" title="Klik untuk memperbesar">
                <img src="{{ asset('uploads/galeri/' . $item->file) }}" class="card-img-top object-fit-cover" style="height: 220px;" alt="{{ $item->judul }}">
              </a>
            @else
              <div class="bg-light text-center py-5 text-muted border-bottom">
                <i class="bi bi-image display-4 opacity-50"></i>
              </div>
            @endif

            <div class="card-body d-flex flex-column justify-content-between">
              <div>
                <div class="d-flex justify-content-between align-items-center mb-2">
                  <span class="badge bg-secondary bg-opacity-10 text-secondary px-3 py-1 rounded-pill small">
                    <i class="bi bi-tag me-1"></i> {{ $item->kategori }}
                  </span>
                  <span class="text-muted small"><i class="bi bi-calendar-date me-1"></i> {{ date('d M Y', strtotime($item->tanggal)) }}</span>
                </div>
                <h5 class="fw-bold text-dark mb-1">{{ $item->judul }}</h5>
                @if($item->keterangan)
                  <p class="text-muted small mb-3">{{ $item->keterangan }}</p>
                @endif
              </div>

              <!-- Tombol Hapus Khusus Admin -->
              @auth
                @if(Auth::user()->role === 'admin')
                  <div class="pt-3 border-top mt-2">
                    <form action="{{ route('galeri.destroy', $item->id_galeri) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus item galeri ini?')">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-sm btn-outline-danger w-100 rounded-pill">
                        <i class="bi bi-trash me-1"></i> Hapus Dokumentasi
                      </button>
                    </form>
                  </div>
                @endif
              @endauth
            </div>
          </div>
        </div>
      @empty
        <div class="col-12">
          <div class="alert alert-info text-center rounded-4 py-4">
            <i class="bi bi-images fs-3 d-block mb-2"></i> Belum ada dokumentasi foto atau video di dalam galeri.
          </div>
        </div>
      @endforelse
    </div>

    <!-- MODAL TAMBAH GALERI -->
    @auth
      @if(Auth::user()->role === 'admin')
        <div class="modal fade" id="modalTambahGaleri" tabindex="-1" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content rounded-4 border-0 shadow">
              <div class="modal-header border-bottom-0 pt-4 px-4">
                <h5 class="modal-title fw-bold">Unggah Dokumentasi Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body px-4 pb-4">
                <form action="{{ route('galeri.store') }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="mb-3">
                    <label class="form-label fw-semibold">Judul</label>
                    <input type="text" name="judul" class="form-control rounded-3" maxlength="50" placeholder="Contoh: Upacara Hari Senin" required>
                  </div>
                  <div class="mb-3">
                    <label class="form-label fw-semibold">Kategori</label>
                    <select name="kategori" class="form-select rounded-3" required>
                      <option value="Foto">Foto</option>
                      <option value="Video">Video</option>
                    </select>
                  </div>
                  <div class="mb-3">
                    <label class="form-label fw-semibold">Tanggal Kegiatan</label>
                    <input type="date" name="tanggal" class="form-control rounded-3" value="{{ date('Y-m-d') }}" required>
                  </div>
                  <div class="mb-3">
                    <label class="form-label fw-semibold">File Gambar/Media</label>
                    <input type="file" name="file" class="form-control rounded-3" accept="image/*" required>
                    <div class="form-text small">Maksimal ukuran 2MB</div>
                  </div>
                  <div class="mb-3">
                    <label class="form-label fw-semibold">Keterangan (Opsional)</label>
                    <textarea name="keterangan" class="form-control rounded-3" rows="3" placeholder="Keterangan lengkap kegiatan..."></textarea>
                  </div>
                  <button type="submit" class="btn btn-primary w-100 rounded-pill py-2 shadow-sm">Simpan Dokumentasi</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      @endif
    @endauth
@endsection