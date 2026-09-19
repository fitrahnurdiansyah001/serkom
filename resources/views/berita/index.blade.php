@extends('layouts.app')

@section('title', 'Berita Sekolah - Web Schools')

@section('content')
    <div class="page-header mb-4 d-flex justify-content-between align-items-center">
      <div>
        <h1 class="page-title fw-bold">Berita & Pengumuman Sekolah</h1>
        <p class="page-subtitle text-muted">Informasi kegiatan terbaru dan artikel seputar sekolah.</p>
      </div>
      
      <!-- Tombol Tambah (Admin/Operator) -->
      @auth
        <div>
          <button type="button" class="btn btn-primary rounded-pill px-4 shadow-sm" data-bs-toggle="modal" data-bs-target="#modalTambahBerita">
            <i class="bi bi-plus-circle me-2"></i> Buat Berita Baru
          </button>
        </div>
      @endauth
    </div>

    @if(session('success'))
      <div class="alert alert-success alert-dismissible fade show rounded-4" role="alert">
        <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    <!-- Daftar Berita -->
    <div class="row g-4 mb-5">
      @forelse($beritas as $item)
        <div class="col-md-6">
          <div class="card border shadow-sm rounded-4 h-100 overflow-hidden flex-md-row">
            @if($item->gambar && file_exists(public_path('uploads/berita/' . $item->gambar)))
              <img src="{{ asset('uploads/berita/' . $item->gambar) }}" class="object-fit-cover" style="width: 100%; height: 200px; max-width: 220px;" alt="{{ $item->judul }}">
            @else
              <div class="bg-light text-center d-flex align-items-center justify-content-center text-muted" style="min-width: 200px; height: 200px;">
                <i class="bi bi-newspaper display-4 opacity-50"></i>
              </div>
            @endif

            <div class="card-body d-flex flex-column justify-content-between p-4">
              <div>
                <div class="d-flex justify-content-between align-items-center mb-2">
                  <span class="badge {{ $item->status == 'Publish' ? 'bg-success' : 'bg-warning text-dark' }} px-2 py-1 rounded-pill small">
                    {{ $item->status }}
                  </span>
                  <span class="text-muted small"><i class="bi bi-calendar-event me-1"></i> {{ date('d M Y', strtotime($item->tanggal)) }}</span>
                </div>
                <h5 class="fw-bold text-dark mb-2">{{ $item->judul }}</h5>
                <p class="text-muted small mb-3 text-truncate" style="-webkit-line-clamp: 2; display: -webkit-box; -webkit-box-orient: vertical; overflow: hidden;">
                  {{ $item->isi }}
                </p>
              </div>

              <!-- Tombol Aksi (Edit & Hapus) -->
              @auth
                <div class="d-flex gap-2 pt-3 border-top">
                  <button type="button" class="btn btn-sm btn-outline-warning w-50 rounded-pill" data-bs-toggle="modal" data-bs-target="#modalEditBerita{{ $item->id_berita }}">
                    <i class="bi bi-pencil me-1"></i> Edit
                  </button>
                  <form action="{{ route('berita.destroy', $item->id_berita) }}" method="POST" class="w-50" onsubmit="return confirm('Yakin ingin menghapus berita ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-outline-danger w-100 rounded-pill">
                      <i class="bi bi-trash me-1"></i> Hapus
                    </button>
                  </form>
                </div>
              @endauth
            </div>
          </div>
        </div>

        <!-- MODAL EDIT BERITA -->
        @auth
          <div class="modal fade" id="modalEditBerita{{ $item->id_berita }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content rounded-4 border-0 shadow">
                <div class="modal-header border-bottom-0 pt-4 px-4">
                  <h5 class="modal-title fw-bold">Edit Berita</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-4 pb-4">
                  <form action="{{ route('berita.update', $item->id_berita) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                      <label class="form-label fw-semibold">Judul Berita</label>
                      <input type="text" name="judul" class="form-control rounded-3" maxlength="50" value="{{ $item->judul }}" required>
                    </div>
                    <div class="row">
                      <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Tanggal</label>
                        <input type="date" name="tanggal" class="form-control rounded-3" value="{{ $item->tanggal }}" required>
                      </div>
                      <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Status</label>
                        <select name="status" class="form-select rounded-3" required>
                          <option value="Publish" {{ $item->status == 'Publish' ? 'selected' : '' }}>Publish</option>
                          <option value="Draft" {{ $item->status == 'Draft' ? 'selected' : '' }}>Draft</option>
                        </select>
                      </div>
                    </div>
                    <div class="mb-3">
                      <label class="form-label fw-semibold">Isi Berita</label>
                      <textarea name="isi" class="form-control rounded-3" rows="5" required>{{ $item->isi }}</textarea>
                    </div>
                    <div class="mb-3">
                      <label class="form-label fw-semibold">Ganti Gambar (Opsional)</label>
                      <input type="file" name="gambar" class="form-control rounded-3" accept="image/*">
                    </div>
                    <button type="submit" class="btn btn-primary w-100 rounded-pill py-2 shadow-sm">Simpan Perubahan</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        @endauth

      @empty
        <div class="col-12">
          <div class="alert alert-info text-center rounded-4 py-4">
            <i class="bi bi-journal-text fs-3 d-block mb-2"></i> Belum ada berita atau pengumuman yang diterbitkan.
          </div>
        </div>
      @endforelse
    </div>

    <!-- MODAL TAMBAH BERITA -->
    @auth
      <div class="modal fade" id="modalTambahBerita" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content rounded-4 border-0 shadow">
            <div class="modal-header border-bottom-0 pt-4 px-4">
              <h5 class="modal-title fw-bold">Buat Berita / Pengumuman Baru</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-4 pb-4">
              <form action="{{ route('berita.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                  <label class="form-label fw-semibold">Judul Berita</label>
                  <input type="text" name="judul" class="form-control rounded-3" maxlength="50" placeholder="Maksimal 50 karakter..." required>
                </div>
                <div class="row">
                  <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Tanggal</label>
                    <input type="date" name="tanggal" class="form-control rounded-3" value="{{ date('Y-m-d') }}" required>
                  </div>
                  <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Status</label>
                    <select name="status" class="form-select rounded-3" required>
                      <option value="Publish">Publish</option>
                      <option value="Draft">Draft</option>
                    </select>
                  </div>
                </div>
                <div class="mb-3">
                  <label class="form-label fw-semibold">Isi Berita</label>
                  <textarea name="isi" class="form-control rounded-3" rows="5" placeholder="Tuliskan isi berita atau pengumuman di sini..." required></textarea>
                </div>
                <div class="mb-3">
                  <label class="form-label fw-semibold">Gambar Utama</label>
                  <input type="file" name="gambar" class="form-control rounded-3" accept="image/*">
                </div>
                <button type="submit" class="btn btn-primary w-100 rounded-pill py-2 shadow-sm">Terbitkan Berita</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    @endauth
@endsection