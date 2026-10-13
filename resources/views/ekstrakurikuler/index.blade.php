@extends('layouts.app')

@section('title', 'Ekstrakurikuler - SDIT Al-Hikmah')

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
                <h3 class="fw-bold mb-1 text-white">Kegiatan Ekstrakurikuler</h3>
                <p class="mb-0 text-white-50 fs-6">Daftar wadah pengembangan bakat, minat, dan potensi siswa.</p>
            </div>
            @auth
                <div class="mt-3 mt-md-0">
                    <button type="button" class="btn btn-light px-4 py-2 fw-semibold shadow-sm rounded-pill d-flex align-items-center" style="color: #0F8B44;"
                        data-bs-toggle="modal" data-bs-target="#modalTambahEkskul">
                        <i class="bi bi-dribbble me-2"></i> Tambah Ekstrakurikuler
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
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Terjadi Kesalahan!</strong> Silakan periksa kembali isian Anda:
            <ul class="mb-0 mt-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- TABEL EKSTRAKURIKULER -->
    <div class="card card-modern mb-5 overflow-hidden">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-body-tertiary">
                        <tr>
                            <th class="py-3 px-4 text-body-secondary fw-semibold" width="5%">NO</th>
                            <th class="py-3 text-body-secondary fw-semibold" width="25%">NAMA EKSTRAKURIKULER</th>
                            <th class="py-3 text-body-secondary fw-semibold" width="20%">PEMBINA</th>
                            <th class="py-3 text-body-secondary fw-semibold" width="20%">JADWAL</th>
                            <th class="text-center py-3 text-body-secondary fw-semibold" width="30%">AKSI</th>
                        </tr>
                    </thead>
                    <tbody class="border-top-0">
                        @forelse($ekstrakurikulers ?? [] as $key => $item)
                            @php
                                $idItem = $item->getKey();
                            @endphp
                            <tr>
                                <td class="px-4 text-body-secondary">{{ $key + 1 }}</td>
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        @if ($item->foto && file_exists(public_path('uploads/ekstrakurikuler/' . $item->foto)))
                                            <img src="{{ asset('uploads/ekstrakurikuler/' . $item->foto) }}" class="rounded-3 object-fit-cover shadow-sm border flex-shrink-0" width="45" height="45" alt="Foto">
                                        @else
                                            <div class="rounded-3 bg-body-tertiary d-flex align-items-center justify-content-center text-secondary border flex-shrink-0" style="width: 45px; height: 45px;">
                                                <i class="bi bi-joystick"></i>
                                            </div>
                                        @endif
                                        <div class="overflow-hidden">
                                            <span class="fw-bold text-body d-block text-truncate">{{ $item->nama_ekskul }}</span>
                                            @if($item->deskripsi)
                                                <small class="text-secondary d-block text-truncate">{{ Str::limit($item->deskripsi, 50) }}</small>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="text-body fw-medium">
                                        <i class="bi bi-person-badge me-1 text-secondary"></i> {{ $item->pembina ?? 'Belum diatur' }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge bg-body-tertiary text-body border px-2 py-1 rounded-pill fw-normal">
                                        <i class="bi bi-calendar-event me-1 text-secondary"></i> {{ $item->jadwal ?? 'Fleksibel' }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('ekskul.show', $item->slug) }}" class="btn btn-sm rounded-pill px-3 fw-medium" style="border: 1px solid #0F8B44; color: #0F8B44;">
                                            <i class="bi bi-eye me-1"></i> Detail
                                        </a>

                                        @auth
                                            <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 fw-medium" data-bs-toggle="modal" data-bs-target="#modalEditEkskul{{ $idItem }}">
                                                <i class="bi bi-pencil me-1"></i> Edit
                                            </button>
                                            <form action="{{ route('ekskul.destroy', $idItem) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus ekstrakurikuler ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3 fw-medium">
                                                    <i class="bi bi-trash me-1"></i> Hapus
                                                </button>
                                            </form>
                                        @endauth
                                    </div>
                                </td>
                            </tr>

                            <!-- MODAL EDIT EKSTRAKURIKULER -->
                            @auth
                                <div class="modal fade" id="modalEditEkskul{{ $idItem }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-centered">
                                        <div class="modal-content rounded-4 border-0 shadow bg-body">
                                            <div class="modal-header text-white pt-4 px-4" style="background-color: #0F8B44;">
                                                <h5 class="modal-title fw-bold">Edit Data Ekstrakurikuler</h5>
                                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body p-4 text-start">
                                                <form action="{{ route('ekskul.update', $idItem) }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="row g-3">
                                                        <div class="col-12">
                                                            <label class="form-label fw-semibold small">Nama Ekstrakurikuler</label>
                                                            <input type="text" name="nama_ekskul" class="form-control rounded-3" value="{{ $item->nama_ekskul }}" required>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label fw-semibold small">Pembina</label>
                                                            <input type="text" name="pembina" class="form-control rounded-3" value="{{ $item->pembina }}">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label fw-semibold small">Jadwal Kegiatan</label>
                                                            <input type="text" name="jadwal" class="form-control rounded-3" value="{{ $item->jadwal }}" placeholder="Contoh: Setiap Jumat, 15:00 WIB">
                                                        </div>
                                                        <div class="col-12">
                                                            <label class="form-label fw-semibold small">Deskripsi / Keterangan</label>
                                                            <textarea name="deskripsi" class="form-control rounded-3" rows="3">{{ $item->deskripsi }}</textarea>
                                                        </div>
                                                        <div class="col-12">
                                                            <label class="form-label fw-semibold small">Ganti Foto / Dokumentasi (Opsional)</label>
                                                            <input type="file" name="foto" class="form-control rounded-3" accept="image/*">
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
                                <td colspan="5" class="text-center py-5">
                                    <div class="d-flex flex-column align-items-center">
                                        <i class="bi bi-dribbble display-4 text-secondary opacity-50 mb-3"></i>
                                        <h5 class="fw-bold text-body">Belum Ada Data Ekstrakurikuler</h5>
                                        <p class="text-secondary small mb-0">Silakan tambahkan data ekstrakurikuler baru melalui tombol di atas.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- MODAL TAMBAH EKSTRAKURIKULER -->
    @auth
        <div class="modal fade" id="modalTambahEkskul" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content rounded-4 border-0 shadow bg-body">
                    <div class="modal-header text-white pt-4 px-4" style="background-color: #0F8B44;">
                        <h5 class="modal-title fw-bold">Tambah Ekstrakurikuler Baru</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4 text-start">
                        <form action="{{ route('ekskul.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="form-label fw-semibold small">Nama Ekstrakurikuler</label>
                                    <input type="text" name="nama_ekskul" class="form-control rounded-3" placeholder="Contoh: Pramuka / Paskibra / Futsal" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold small">Pembina</label>
                                    <input type="text" name="pembina" class="form-control rounded-3" placeholder="Nama Guru Pembina">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold small">Jadwal Kegiatan</label>
                                    <input type="text" name="jadwal" class="form-control rounded-3" placeholder="Contoh: Rabu, 15:30 WIB">
                                </div>
                                <div class="col-12">
                                    <label class="form-label fw-semibold small">Deskripsi / Keterangan (Opsional)</label>
                                    <textarea name="deskripsi" class="form-control rounded-3" rows="3" placeholder="Penjelasan kegiatan ekstrakurikuler..."></textarea>
                                </div>
                                <div class="col-12">
                                    <label class="form-label fw-semibold small">Foto / Dokumentasi (Opsional)</label>
                                    <input type="file" name="foto" class="form-control rounded-3" accept="image/*">
                                </div>
                                <div class="col-12 mt-4">
                                    <button type="submit" class="btn text-white w-100 py-2 rounded-pill fw-semibold shadow-sm" style="background-color: #0F8B44;">Simpan Ekstrakurikuler</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endauth
@endsection