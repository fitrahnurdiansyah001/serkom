@extends('layouts.app')

@section('title', 'Data Siswa - Web Schools')

@section('content')
    <div class="page-header mb-4 d-flex justify-content-between align-items-center">
      <div>
        <h1 class="page-title fw-bold">Data Siswa / Murid</h1>
        <p class="page-subtitle text-muted">Daftar seluruh siswa aktif yang terdaftar di SMAN 1 Web Schools.</p>
      </div>
      
      <!-- Tombol Tambah (Admin/Operator) -->
      @auth
        <div>
          <button type="button" class="btn btn-primary rounded-pill px-4 shadow-sm" data-bs-toggle="modal" data-bs-target="#modalTambahSiswa">
            <i class="bi bi-person-plus me-2"></i> Tambah Data Siswa
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

    <!-- Tabel Data Siswa -->
    <div class="card border shadow-sm rounded-4 overflow-hidden mb-5">
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
              <tr>
                <th class="py-3 px-4">No</th>
                <th class="py-3">NISN</th>
                <th class="py-3">Nama Siswa</th>
                <th class="py-3">Jenis Kelamin</th>
                <th class="py-3">Tahun Masuk</th>
                @auth
                  <th class="py-3 text-center" style="width: 150px;">Aksi</th>
                @endauth
              </tr>
            </thead>
            <tbody>
              @forelse($siswas as $index => $siswa)
                <tr>
                  <td class="px-4 text-muted">{{ $index + 1 }}</td>
                  <td><span class="fw-semibold text-secondary">{{ $siswa->nisn }}</span></td>
                  <td>
                    <div class="fw-bold text-dark">{{ $siswa->nama_siswa }}</div>
                  </td>
                  <td>
                    <span class="badge {{ $siswa->jenis_kelamin == 'Laki-Laki' ? 'bg-info bg-opacity-10 text-info' : 'bg-danger bg-opacity-10 text-danger' }} px-3 py-1 rounded-pill">
                      {{ $siswa->jenis_kelamin }}
                    </span>
                  </td>
                  <td>{{ $siswa->tahun_masuk }}</td>
                  
                  @auth
                    <td class="text-center">
                      <div class="d-flex justify-content-center gap-2">
                        <!-- Tombol Edit Modal -->
                        <button type="button" class="btn btn-sm btn-outline-warning rounded-circle" data-bs-toggle="modal" data-bs-target="#modalEditSiswa{{ $siswa->id_siswa }}" title="Edit">
                          <i class="bi bi-pencil"></i>
                        </button>
                        <!-- Tombol Hapus -->
                        <form action="{{ route('siswa.destroy', $siswa->id_siswa) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data siswa ini?')">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-sm btn-outline-danger rounded-circle" title="Hapus">
                            <i class="bi bi-trash"></i>
                          </button>
                        </form>
                      </div>
                    </td>
                  @endauth
                </tr>

                <!-- MODAL EDIT SISWA -->
                @auth
                  <div class="modal fade" id="modalEditSiswa{{ $siswa->id_siswa }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content rounded-4 border-0 shadow">
                        <div class="modal-header border-bottom-0 pt-4 px-4">
                          <h5 class="modal-title fw-bold">Edit Data Siswa</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body px-4 pb-4">
                          <form action="{{ route('siswa.update', $siswa->id_siswa) }}" method="POST">
                            @csrf
                            <div class="mb-3">
                              <label class="form-label fw-semibold">NISN</label>
                              <input type="text" name="nisn" class="form-control rounded-3" maxlength="10" value="{{ $siswa->nisn }}" required>
                            </div>
                            <div class="mb-3">
                              <label class="form-label fw-semibold">Nama Lengkap Siswa</label>
                              <input type="text" name="nama_siswa" class="form-control rounded-3" maxlength="40" value="{{ $siswa->nama_siswa }}" required>
                            </div>
                            <div class="mb-3">
                              <label class="form-label fw-semibold">Jenis Kelamin</label>
                              <select name="jenis_kelamin" class="form-select rounded-3" required>
                                <option value="Laki-Laki" {{ $siswa->jenis_kelamin == 'Laki-Laki' ? 'selected' : '' }}>Laki-Laki</option>
                                <option value="Perempuan" {{ $siswa->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                              </select>
                            </div>
                            <div class="mb-3">
                              <label class="form-label fw-semibold">Tahun Masuk</label>
                              <input type="number" name="tahun_masuk" class="form-control rounded-3" value="{{ $siswa->tahun_masuk }}" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100 rounded-pill py-2 shadow-sm">Simpan Perubahan</button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                @endauth

              @empty
                <tr>
                  <td colspan="6" class="text-center py-5 text-muted">
                    <i class="bi bi-people display-4 opacity-50 d-block mb-2"></i> Belum ada data siswa yang terdaftar.
                  </td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- MODAL TAMBAH SISWA -->
    @auth
      <div class="modal fade" id="modalTambahSiswa" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content rounded-4 border-0 shadow">
            <div class="modal-header border-bottom-0 pt-4 px-4">
              <h5 class="modal-title fw-bold">Tambah Data Siswa Baru</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-4 pb-4">
              <form action="{{ route('siswa.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                  <label class="form-label fw-semibold">NISN</label>
                  <input type="text" name="nisn" class="form-control rounded-3" maxlength="10" placeholder="Maksimal 10 digit" required>
                </div>
                <div class="mb-3">
                  <label class="form-label fw-semibold">Nama Lengkap Siswa</label>
                  <input type="text" name="nama_siswa" class="form-control rounded-3" maxlength="40" placeholder="Nama lengkap siswa..." required>
                </div>
                <div class="mb-3">
                  <label class="form-label fw-semibold">Jenis Kelamin</label>
                  <select name="jenis_kelamin" class="form-select rounded-3" required>
                    <option value="Laki-Laki">Laki-Laki</option>
                    <option value="Perempuan">Perempuan</option>
                  </select>
                </div>
                <div class="mb-3">
                  <label class="form-label fw-semibold">Tahun Masuk</label>
                  <input type="number" name="tahun_masuk" class="form-control rounded-3" value="{{ date('Y') }}" required>
                </div>
                <button type="submit" class="btn btn-primary w-100 rounded-pill py-2 shadow-sm">Simpan Data Siswa</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    @endauth
@endsection