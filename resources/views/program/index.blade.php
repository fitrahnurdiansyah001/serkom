@extends('layouts.app')

@section('title', 'Manajemen Program - SDIT Al-Hikmah')

@section('content')
    <style>
        .card-modern {
            background-color: var(--bs-body-bg);
            border: 1px solid var(--bs-border-color, rgba(0, 0, 0, 0.08));
            border-radius: 1rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.03), 0 2px 4px -1px rgba(0, 0, 0, 0.02);
            overflow: hidden;
            transition: all 0.2s ease-in-out;
        }

        .form-control,
        .form-select {
            background-color: var(--bs-body-bg);
            color: var(--bs-body-color);
        }
    </style>

    <!-- BANNER UTAMA -->
    <div class="card border-0 text-white mb-4 shadow-sm"
        style="background: linear-gradient(135deg, #0F8B44 0%, #0c7338 100%); border-radius: 1rem;">
        <div class="card-body p-4 p-md-5 d-flex flex-column flex-md-row justify-content-between align-items-md-center">
            <div>
                <h3 class="fw-bold mb-1 text-white">Manajemen Data Program</h3>
                <p class="mb-0 text-white-50 fs-6">Kelola daftar program unggulan dan deskripsi sekolah.</p>
            </div>
            @auth
                <div class="mt-3 mt-md-0">
                    <button type="button" class="btn btn-light px-4 py-2 fw-semibold shadow-sm rounded-pill d-flex align-items-center" style="color: #0F8B44;"
                        data-bs-toggle="modal" data-bs-target="#modalTambahProgram">
                        <i class="bi bi-plus-circle-fill me-2"></i> Tambah Program Baru
                    </button>
                </div>
            @endauth
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-4 shadow-sm mb-4" role="alert">
            <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show rounded-4 shadow-sm mb-4" role="alert">
            <i class="bi bi-exclamation-triangle me-2"></i> Terdapat kesalahan input. Periksa kembali form Anda.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- TABEL PROGRAM -->
    <div class="card card-modern mb-5 overflow-hidden">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-body-tertiary">
                        <tr>
                            <th class="py-3 px-4 text-body-secondary fw-semibold" width="5%">NO</th>
                            <th class="py-3 text-body-secondary fw-semibold" width="30%">NAMA PROGRAM</th>
                            <th class="py-3 text-body-secondary fw-semibold">DESKRIPSI LENGKAP</th>
                            <th class="text-center py-3 text-body-secondary fw-semibold" width="25%">AKSI</th>
                        </tr>
                    </thead>
                    <tbody class="border-top-0">
                        @forelse($programs ?? [] as $key => $item)
                            <tr>
                                <td class="px-4 text-body-secondary">{{ $key + 1 }}</td>
                                <td>
                                    <span class="fw-bold text-body">{{ $item->nama_program }}</span>
                                </td>
                                <td class="text-secondary">
                                    <small>{{ $item->deskripsi }}</small>
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <button type="button" class="btn btn-sm rounded-pill px-3 fw-medium" style="border: 1px solid #0F8B44; color: #0F8B44;" data-bs-toggle="modal" data-bs-target="#modalEditProgram{{ $item->id_program }}">
                                            <i class="bi bi-pencil me-1"></i> Edit
                                        </button>
                                        <form action="{{ route('program.destroy', $item->id_program) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus program ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3 fw-medium">
                                                <i class="bi bi-trash me-1"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>

                            <!-- MODAL EDIT PROGRAM -->
                            @auth
                                <div class="modal fade" id="modalEditProgram{{ $item->id_program }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content rounded-4 border-0 shadow bg-body">
                                            <div class="modal-header text-white pt-4 px-4" style="background-color: #0F8B44;">
                                                <h5 class="modal-title fw-bold">Edit Program</h5>
                                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body p-4 text-start">
                                                <form action="{{ route('program.update', $item->id_program) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="row g-3">
                                                        <div class="col-12">
                                                            <label class="form-label fw-semibold small">Nama Program</label>
                                                            <input type="text" name="nama_program" class="form-control rounded-3" value="{{ $item->nama_program }}" required>
                                                        </div>
                                                        <div class="col-12">
                                                            <label class="form-label fw-semibold small">Deskripsi</label>
                                                            <textarea name="deskripsi" class="form-control rounded-3" rows="4" required>{{ $item->deskripsi }}</textarea>
                                                        </div>
                                                        <div class="col-12 mt-4">
                                                            <button type="submit" class="btn text-white w-100 py-2 rounded-pill fw-semibold shadow-sm" style="background-color: #0F8B44;">Simpan Perubahan</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endauth

                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-5">
                                    <div class="d-flex flex-column align-items-center">
                                        <i class="bi bi-folder-x display-4 text-secondary opacity-50 mb-3"></i>
                                        <h5 class="fw-bold text-body">Data Program Kosong</h5>
                                        <p class="text-secondary small mb-0">Belum ada program unggulan yang ditambahkan.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- MODAL TAMBAH PROGRAM -->
    @auth
        <div class="modal fade" id="modalTambahProgram" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content rounded-4 border-0 shadow bg-body">
                    <div class="modal-header text-white pt-4 px-4" style="background-color: #0F8B44;">
                        <h5 class="modal-title fw-bold">Tambah Program Baru</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4 text-start">
                        <form action="{{ route('program.store') }}" method="POST">
                            @csrf
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="form-label fw-semibold small">Nama Program</label>
                                    <input type="text" name="nama_program" class="form-control rounded-3" placeholder="Contoh: Tahfidz Al-Quran" required>
                                </div>
                                <div class="col-12">
                                    <label class="form-label fw-semibold small">Deskripsi</label>
                                    <textarea name="deskripsi" class="form-control rounded-3" rows="4" placeholder="Jelaskan detail program ini..." required></textarea>
                                </div>
                                <div class="col-12 mt-4">
                                    <button type="submit" class="btn text-white w-100 py-2 rounded-pill fw-semibold shadow-sm" style="background-color: #0F8B44;">Simpan Program</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endauth
@endsection