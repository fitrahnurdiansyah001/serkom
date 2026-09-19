@extends('layouts.app')

@section('title', 'Data Guru - Web Schools')

@section('content')
    <div class="page-header mb-4 d-flex justify-content-between align-items-center">
      <div>
        <h1 class="page-title fw-bold">Data Dewan Guru</h1>
        <p class="page-subtitle text-muted">Daftar tenaga pengajar dan staf pendidik SMAN 1 Web Schools.</p>
      </div>
      
      <!-- Tombol Tambah Khusus Admin -->
      @auth
        @if(Auth::user()->role === 'admin')
          <div>
            <button type="button" class="btn btn-primary rounded-pill px-4 shadow-sm" data-bs-toggle="modal" data-bs-target="#modalTambahGuru">
              <i class="bi bi-person-plus me-2"></i> Tambah Data Guru
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

    <!-- Daftar Guru Grid -->
    <div class="row g-4 mb-5">
      @forelse($gurus as $guru)
        <div class="col-md-3 col-sm-6">
          <div class="card border shadow-sm rounded-4 h-100 text-center p-3">
            <div class="mx-auto mt-3">
              @if($guru->foto && file_exists(public_path('uploads/guru/' . $guru->foto)))
                <img src="{{ asset('uploads/guru/' . $guru->foto) }}" class="rounded-circle shadow-sm border object-fit-cover" width="100" height="100" alt="{{ $guru->nama_guru }}">
              @else
                <img src="{{ asset('assets/images/avatar.png') }}" class="rounded-circle shadow-sm border object-fit-cover" width="100" height="100" alt="Default Avatar">
              @endif
            </div>

            <div class="card-body px-0 d-flex flex-column justify-content-between">
              <div>
                <h6 class="fw-bold text-dark mb-1">{{ $guru->nama_guru }}</h6>
                <p class="text-muted small mb-1">NIP: {{ $guru->nip }}</p>
                <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-1 rounded-pill small mb-3">
                  {{ $guru->mapel }}
                </span>
              </div>

              <!-- Tombol Aksi Admin -->
              @auth
                @if(Auth::user()->role === 'admin')
                  <div class="d-flex gap-2 pt-3 border-top">
                    <button type="button" class="btn btn-sm btn-outline-warning w-50 rounded-pill" data-bs-toggle="modal" data-bs-target="#modalEditGuru{{ $guru->id_guru }}">
                      <i class="bi bi-pencil"></i>
                    </button>
                    <form action="{{ route('guru.destroy', $guru->id_guru) }}" method="POST" class="w-50" onsubmit="return confirm('Yakin ingin menghapus data guru ini?')">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-sm btn-outline-danger w-100 rounded-pill">
                        <i class="bi bi-trash"></i>
                      </button>
                    </form>
                  </div>
                @endif
              @endauth
            </div>
          </div>
        </div>

        <!-- MODAL EDIT GURU -->
        @auth
          @if(Auth::user()->role === 'admin')
            <div class="modal fade" id="modalEditGuru{{ $guru->id_guru }}" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content rounded-4 border-0 shadow">
                  <div class="modal-header border-bottom-0 pt-4 px-4">
                    <h5 class="modal-title fw-bold">Edit Data Guru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body px-4 pb-4">
                    <form action="{{ route('guru.update', $guru->id_guru) }}" method="POST" enctype="multipart/form-data">
                      @csrf
                      <div class="mb-3">
                        <label class="form-label fw-semibold">Nama Lengkap & Gelar</label>
                        <input type="text" name="nama_guru" class="form-control rounded-3" maxlength="40" value="{{ $guru->nama_guru }}" required>
                      </div>
                      <div class="mb-3">
                        <label class="form-label fw-semibold">NIP</label>
                        <input type="text" name="nip" class="form-control rounded-3" maxlength="15" value="{{ $guru->nip }}" required>
                      </div>
                      <div class="mb-3">
                        <label class="form-label fw-semibold">Mata Pelajaran</label>
                        <input type="text" name="mapel" class="form-control rounded-3" maxlength="40" value="{{ $guru->mapel }}" required>
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
            <i class="bi bi-person-badge fs-3 d-block mb-2"></i> Belum ada data guru yang terdaftar.
          </div>
        </div>
      @endforelse
    </div>

    <!-- MODAL TAMBAH GURU -->
    @auth
      @if(Auth::user()->role === 'admin')
        <div class="modal fade" id="modalTambahGuru" tabindex="-1" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content rounded-4 border-0 shadow">
              <div class="modal-header border-bottom-0 pt-4 px-4">
                <h5 class="modal-title fw-bold">Tambah Data Guru Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body px-4 pb-4">
                <form action="{{ route('guru.store') }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="mb-3">
                    <label class="form-label fw-semibold">Nama Lengkap & Gelar</label>
                    <input type="text" name="nama_guru" class="form-control rounded-3" maxlength="40" placeholder="Contoh: Drs. H. Budi Santoso" required>
                  </div>
                  <div class="mb-3">
                    <label class="form-label fw-semibold">NIP</label>
                    <input type="text" name="nip" class="form-control rounded-3" maxlength="15" placeholder="Nomor Induk Pegawai" required>
                  </div>
                  <div class="mb-3">
                    <label class="form-label fw-semibold">Mata Pelajaran</label>
                    <input type="text" name="mapel" class="form-control rounded-3" maxlength="40" placeholder="Contoh: Matematika" required>
                  </div>
                  <div class="mb-3">
                    <label class="form-label fw-semibold">Foto Guru</label>
                    <input type="file" name="foto" class="form-control rounded-3" accept="image/*">
                  </div>
                  <button type="submit" class="btn btn-primary w-100 rounded-pill py-2 shadow-sm">Simpan Data Guru</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      @endif
    @endauth
@endsection