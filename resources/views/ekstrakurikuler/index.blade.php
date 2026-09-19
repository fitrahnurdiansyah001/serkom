@extends('layouts.app')

@section('title', 'Ekstrakurikuler - Web Schools')

@section('content')
    <div class="page-header mb-4 d-flex justify-content-between align-items-center">
      <div>
        <h1 class="page-title fw-bold">Kegiatan Ekstrakurikuler</h1>
        <p class="page-subtitle text-muted">Daftar klub dan kegiatan pengembangan bakat minat siswa.</p>
      </div>
      
      <!-- Tombol Tambah Khusus Admin -->
      @auth
        @if(Auth::user()->role === 'admin')
          <div>
            <button type="button" class="btn btn-primary rounded-pill px-4 shadow-sm" data-bs-toggle="modal" data-bs-target="#modalTambahEkskul">
              <i class="bi bi-plus-circle me-2"></i> Tambah Ekstrakurikuler
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

    <!-- Daftar Ekstrakurikuler -->
    <div class="row g-4 mb-5">
      @forelse($eskuls as $eskul)
        <div class="col-md-4">
          <div class="card border shadow-sm rounded-4 h-100 overflow-hidden">
            @if($eskul->foto && file_exists(public_path('uploads/eskul/' . $eskul->foto)))
              <img src="{{ asset('uploads/eskul/' . $eskul->foto) }}" class="card-img-top object-fit-cover" style="height: 180px;" alt="{{ $eskul->nama_ekskul }}">
            @else
              <div class="bg-light text-center py-5 text-muted border-bottom">
                <i class="bi bi-image display-4 opacity-50"></i>
              </div>
            @endif

            <div class="card-body d-flex flex-column justify-content-between">
              <div>
                <div class="d-flex justify-content-between align-items-center mb-2">
                  <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-1 rounded-pill small">
                    <i class="bi bi-calendar-event me-1"></i> {{ $eskul->jadwal }}
                  </span>
                </div>
                <h5 class="fw-bold text-dark mb-1">{{ $eskul->nama_ekskul }}</h5>
                <p class="text-muted small mb-2"><i class="bi bi-person-badge text-success me-1"></i> Pembina: <strong>{{ $eskul->pembina }}</strong></p>
                <p class="text-muted small mb-3">{{ $eskul->deskripsi ?? 'Tidak ada deskripsi tambahan.' }}</p>
              </div>

              <!-- Tombol Aksi Admin -->
              @auth
                @if(Auth::user()->role === 'admin')
                  <div class="d-flex gap-2 pt-3 border-top">
                    <button type="button" class="btn btn-sm btn-outline-warning w-50 rounded-pill" data-bs-toggle="modal" data-bs-target="#modalEditEkskul{{ $eskul->id }}">
                      <i class="bi bi-pencil me-1"></i> Edit
                    </button>
                    <form action="{{ route('ekskul.destroy', $eskul->id) }}" method="POST" class="w-50" onsubmit="return confirm('Yakin ingin menghapus ekstrakurikuler ini?')">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-sm btn-outline-danger w-50 w-100 rounded-pill">
                        <i class="bi bi-trash me-1"></i> Hapus
                      </button>
                    </form>
                  </div>
                @endif
              @endauth
            </div>
          </div>
        </div>

        <!-- MODAL EDIT EKSKUL -->
        @auth
          @if(Auth::user()->role === 'admin')
            <div class="modal fade" id="modalEditEkskul{{ $eskul->id }}" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content rounded-4 border-0 shadow">
                  <div class="modal-header border-bottom-0 pt-4 px-4">
                    <h5 class="modal-title fw-bold">Edit Ekstrakurikuler</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-content border-0 p-4 pt-0">
                    <form action="{{ route('ekskul.update', $eskul->id) }}" method="POST" enctype="multipart/form-data">
                      @csrf
                      <div class="mb-3">
                        <label class="form-label fw-semibold">Nama Ekstrakurikuler</label>
                        <input type="text" name="nama_ekskul" class="form-control rounded-3" value="{{ $eskul->nama_ekskul }}" required>
                      </div>
                      <div class="mb-3">
                        <label class="form-label fw-semibold">Nama Pembina</label>
                        <input type="text" name="pembina" class="form-control rounded-3" value="{{ $eskul->pembina }}" required>
                      </div>
                      <div class="mb-3">
                        <label class="form-label fw-semibold">Jadwal Kegiatan</label>
                        <input type="text" name="jadwal" class="form-control rounded-3" value="{{ $eskul->jadwal }}" placeholder="Contoh: Jumat, 15:00 WIB" required>
                      </div>
                      <div class="mb-3">
                        <label class="form-label fw-semibold">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control rounded-3" rows="3">{{ $eskul->deskripsi }}</textarea>
                      </div>
                      <div class="mb-3">
                        <label class="form-label fw-semibold">Ganti Foto (Opsional)</label>
                        <input type="file" name="foto" class="form-control rounded-3" accept="image/*">
                      </div>
                      <button type="submit" class="btn btn-primary w-100 rounded-pill py-2 shadow-sm">Simpan Perubahan</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          @endif
        @endauth

      @empty
        <div class="col-12">
          <div class="alert alert-info text-center rounded-4 py-4">
            <i class="bi bi-info-circle fs-3 d-block mb-2"></i> Belum ada data ekstrakurikuler yang ditambahkan.
          </div>
        </div>
      @endforelse
    </div>

    <!-- MODAL TAMBAH EKSKUL -->
    @auth
      @if(Auth::user()->role === 'admin')
        <div class="modal fade" id="modalTambahEkskul" tabindex="-1" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content rounded-4 border-0 shadow">
              <div class="modal-header border-bottom-0 pt-4 px-4">
                <h5 class="modal-title fw-bold">Tambah Ekstrakurikuler Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body px-4 pb-4">
                <form action="{{ route('ekskul.store') }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="mb-3">
                    <label class="form-label fw-semibold">Nama Ekstrakurikuler</label>
                    <input type="text" name="nama_ekskul" class="form-control rounded-3" placeholder="Contoh: Pramuka" required>
                  </div>
                  <div class="mb-3">
                    <label class="form-label fw-semibold">Nama Pembina</label>
                    <input type="text" name="pembina" class="form-control rounded-3" placeholder="Contoh: Bpk. Rudi, S.Pd." required>
                  </div>
                  <div class="mb-3">
                    <label class="form-label fw-semibold">Jadwal Kegiatan</label>
                    <input type="text" name="jadwal" class="form-control rounded-3" placeholder="Contoh: Jumat, 15:00 WIB" required>
                  </div>
                  <div class="mb-3">
                    <label class="form-label fw-semibold">Deskripsi</label>
                    <textarea name="deskripsi" class="form-control rounded-3" rows="3" placeholder="Deskripsi singkat kegiatan..."></textarea>
                  </div>
                  <div class="mb-3">
                    <label class="form-label fw-semibold">Foto Kegiatan</label>
                    <input type="file" name="foto" class="form-control rounded-3" accept="image/*">
                  </div>
                  <button type="submit" class="btn btn-primary w-100 rounded-pill py-2 shadow-sm">Simpan Ekstrakurikuler</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      @endif
    @endauth
@endsection