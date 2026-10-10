@extends('layouts.app')

@section('title', 'Prestasi Sekolah - SDIT Al-Hikmah')

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
                <h3 class="fw-bold mb-1 text-white">Prestasi Sekolah</h3>
                <p class="mb-0 text-white-50 fs-6">Daftar penghargaan, kejuaraan, dan pencapaian akademik maupun
                    non-akademik.</p>
            </div>
            @auth
                <div class="mt-3 mt-md-0">
                    <button type="button"
                        class="btn btn-light px-4 py-2 fw-semibold shadow-sm rounded-pill d-flex align-items-center"
                        style="color: #0F8B44;" data-bs-toggle="modal" data-bs-target="#modalTambahPrestasi">
                        <i class="bi bi-trophy-fill me-2"></i> Tambah Prestasi Baru
                    </button>
                </div>
            @endauth
        </div>
    </div>

    <!-- FILTER KATEGORI / TINGKAT -->
    <div class="card card-modern mb-4 p-3">
        <form action="{{ route('prestasi.index') }}" method="GET" class="row g-3 align-items-center">
            <div class="col-md-4">
                <label class="form-label fw-semibold small mb-1">Filter Tingkat:</label>
                <select name="tingkat" class="form-select rounded-pill" onchange="this.form.submit()">
                    <option value="">Semua Tingkat</option>
                    <option value="Sekolah" {{ request('tingkat') == 'Sekolah' ? 'selected' : '' }}>Sekolah</option>
                    <option value="Kecamatan" {{ request('tingkat') == 'Kecamatan' ? 'selected' : '' }}>Kecamatan</option>
                    <option value="Kabupaten" {{ request('tingkat') == 'Kabupaten' ? 'selected' : '' }}>Kabupaten</option>
                    <option value="Provinsi" {{ request('tingkat') == 'Provinsi' ? 'selected' : '' }}>Provinsi</option>
                    <option value="Nasional" {{ request('tingkat') == 'Nasional' ? 'selected' : '' }}>Nasional</option>
                    <option value="Internasional" {{ request('tingkat') == 'Internasional' ? 'selected' : '' }}>
                        Internasional</option>
                </select>
            </div>
            @if (request('tingkat'))
                <div class="col-md-3 d-flex align-items-end mt-4 mt-md-0">
                    <a href="{{ route('prestasi.index') }}" class="btn btn-outline-secondary rounded-pill px-4 btn-sm">
                        <i class="bi bi-arrow-counterclockwise me-1"></i> Reset Filter
                    </a>
                </div>
            @endif
        </form>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-4 shadow-sm mb-4" role="alert">
            <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show rounded-4 shadow-sm mb-4" role="alert">
            <i class="bi bi-exclamation-triangle me-2"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- TABEL PRESTASI -->
    <div class="card card-modern mb-5 overflow-hidden">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-body-tertiary">
                        <tr>
                            <th class="py-3 px-4 text-body-secondary fw-semibold" width="5%">NO</th>
                            <th class="py-3 text-body-secondary fw-semibold" width="25%">NAMA PRESTASI</th>
                            <th class="py-3 text-body-secondary fw-semibold" width="15%">TINGKAT</th>
                            <th class="py-3 text-body-secondary fw-semibold" width="15%">PENCAPAIAN</th>
                            <th class="py-3 text-body-secondary fw-semibold" width="10%">TAHUN</th>
                            <th class="text-center py-3 text-body-secondary fw-semibold" width="30%">AKSI</th>
                        </tr>
                    </thead>
                    <tbody class="border-top-0">
                        @forelse($prestasis ?? [] as $key => $item)
                            @php
                                $idItem = $item->id_prestasi ?? $item->id;
                            @endphp
                            <tr>
                                <td class="px-4 text-body-secondary">{{ $key + 1 }}</td>
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        @if ($item->foto && file_exists(public_path('uploads/prestasi/' . $item->foto)))
                                            <img src="{{ asset('uploads/prestasi/' . $item->foto) }}"
                                                class="rounded-3 object-fit-cover shadow-sm border flex-shrink-0"
                                                width="45" height="45" alt="Foto">
                                        @else
                                            <div class="rounded-3 bg-body-tertiary d-flex align-items-center justify-content-center text-secondary border flex-shrink-0"
                                                style="width: 45px; height: 45px;">
                                                <i class="bi bi-trophy"></i>
                                            </div>
                                        @endif
                                        <div class="overflow-hidden">
                                            <span
                                                class="fw-bold text-body d-block text-truncate">{{ $item->nama_prestasi }}</span>
                                            @if ($item->deskripsi)
                                                <small
                                                    class="text-secondary d-block text-truncate">{{ Str::limit($item->deskripsi, 50) }}</small>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-body-tertiary text-body border px-2 py-1 rounded-pill fw-normal">
                                        {{ $item->tingkat }}
                                    </span>
                                </td>
                                <td>
                                    <span
                                        class="badge bg-success bg-opacity-10 text-success px-2 py-1 rounded-pill fw-semibold">
                                        {{ $item->juara }}
                                    </span>
                                </td>
                                <td class="text-body-secondary">{{ $item->tahun }}</td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('prestasi.show', $item->slug) }}"
                                            class="btn btn-sm rounded-pill px-3 fw-medium"
                                            style="border: 1px solid #0F8B44; color: #0F8B44;">
                                            <i class="bi bi-eye me-1"></i> Detail
                                        </a>

                                        @auth
                                            <button type="button"
                                                class="btn btn-sm btn-outline-secondary rounded-pill px-3 fw-medium"
                                                data-bs-toggle="modal" data-bs-target="#modalEditPrestasi{{ $idItem }}">
                                                <i class="bi bi-pencil me-1"></i> Edit
                                            </button>
                                            <form action="{{ route('prestasi.destroy', $idItem) }}" method="POST"
                                                class="d-inline"
                                                onsubmit="return confirm('Yakin ingin menghapus prestasi ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="btn btn-sm btn-outline-danger rounded-pill px-3 fw-medium">
                                                    <i class="bi bi-trash me-1"></i> Hapus
                                                </button>
                                            </form>
                                        @endauth
                                    </div>
                                </td>
                            </tr>

                            <!-- MODAL EDIT PRESTASI -->
                            @auth
                                <div class="modal fade" id="modalEditPrestasi{{ $item->id_prestasi }}" tabindex="-1"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-centered">
                                        <div class="modal-content rounded-4 border-0 shadow bg-body">
                                            <div class="modal-header text-white pt-4 px-4" style="background-color: #0F8B44;">
                                                <h5 class="modal-title fw-bold">Edit Data Prestasi</h5>
                                                <button type="button" class="btn-close btn-close-white"
                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body p-4 text-start">
                                                <form action="{{ route('prestasi.update', $item->id_prestasi) }}" method="POST"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="row g-3">
                                                        <div class="col-12">
                                                            <label class="form-label fw-semibold small">Nama / Judul
                                                                Prestasi</label>
                                                            <input type="text" name="nama_prestasi"
                                                                class="form-control rounded-3"
                                                                value="{{ $item->nama_prestasi }}" required>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label fw-semibold small">Tingkat</label>
                                                            <select name="tingkat" class="form-select rounded-3" required>
                                                                @foreach (['Sekolah', 'Kecamatan', 'Kabupaten', 'Provinsi', 'Nasional', 'Internasional'] as $tkt)
                                                                    <option value="{{ $tkt }}"
                                                                        {{ $item->tingkat == $tkt ? 'selected' : '' }}>
                                                                        {{ $tkt }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label fw-semibold small">Pencapaian (Juara /
                                                                Medali)</label>
                                                            <select name="juara" class="form-select rounded-3" required>
                                                                @foreach (['Juara 1', 'Juara 2', 'Juara 3', 'Harapan 1', 'Harapan 2', 'Juara Favorit', 'Medali Emas', 'Medali Perak', 'Medali Perunggu'] as $jua)
                                                                    <option value="{{ $jua }}"
                                                                        {{ $item->juara == $jua ? 'selected' : '' }}>
                                                                        {{ $jua }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <label class="form-label fw-semibold small">Tahun</label>
                                                            <input type="number" name="tahun"
                                                                class="form-control rounded-3" value="{{ $item->tahun }}"
                                                                required>
                                                        </div>
                                                        <div class="col-12">
                                                            <label class="form-label fw-semibold small">Deskripsi /
                                                                Keterangan</label>
                                                            <textarea name="deskripsi" class="form-control rounded-3" rows="3">{{ $item->deskripsi }}</textarea>
                                                        </div>
                                                        <div class="col-12">
                                                            <label class="form-label fw-semibold small">Ganti Foto /
                                                                Dokumentasi (Opsional)</label>
                                                            <input type="file" name="foto"
                                                                class="form-control rounded-3" accept="image/*">
                                                        </div>
                                                        <div class="col-12 mt-4">
                                                            <button type="submit"
                                                                class="btn text-white w-100 py-2 rounded-pill fw-semibold shadow-sm"
                                                                style="background-color: #0F8B44;">Simpan Perubahan</button>
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
                                <td colspan="6" class="text-center py-5">
                                    <div class="d-flex flex-column align-items-center">
                                        <i class="bi bi-trophy display-4 text-secondary opacity-50 mb-3"></i>
                                        <h5 class="fw-bold text-body">Belum Ada Data Prestasi</h5>
                                        <p class="text-secondary small mb-0">Silakan tambahkan data prestasi baru melalui
                                            tombol di atas.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- MODAL TAMBAH PRESTASI -->
    @auth
        <div class="modal fade" id="modalTambahPrestasi" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content rounded-4 border-0 shadow bg-body">
                    <div class="modal-header text-white pt-4 px-4" style="background-color: #0F8B44;">
                        <h5 class="modal-title fw-bold">Tambah Prestasi Baru</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4 text-start">
                        <form action="{{ route('prestasi.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="form-label fw-semibold small">Nama / Judul Prestasi</label>
                                    <input type="text" name="nama_prestasi" class="form-control rounded-3"
                                        placeholder="Contoh: Olimpiade Sains Nasional (OSN)" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold small">Tingkat</label>
                                    <select name="tingkat" class="form-select rounded-3" required>
                                        <option value="">-- Pilih Tingkat --</option>
                                        <option value="Sekolah">Sekolah</option>
                                        <option value="Kecamatan">Kecamatan</option>
                                        <option value="Kabupaten">Kabupaten</option>
                                        <option value="Provinsi">Provinsi</option>
                                        <option value="Nasional">Nasional</option>
                                        <option value="Internasional">Internasional</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold small">Pencapaian (Juara / Medali)</label>
                                    <select name="juara" class="form-select rounded-3" required>
                                        <option value="">-- Pilih Pencapaian --</option>
                                        <option value="Juara 1">Juara 1</option>
                                        <option value="Juara 2">Juara 2</option>
                                        <option value="Juara 3">Juara 3</option>
                                        <option value="Harapan 1">Harapan 1</option>
                                        <option value="Harapan 2">Harapan 2</option>
                                        <option value="Juara Favorit">Juara Favorit</option>
                                        <option value="Medali Emas">Medali Emas</option>
                                        <option value="Medali Perak">Medali Perak</option>
                                        <option value="Medali Perunggu">Medali Perunggu</option>
                                    </select>
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label fw-semibold small">Tahun</label>
                                    <input type="number" name="tahun" class="form-control rounded-3"
                                        value="{{ date('Y') }}" required>
                                </div>
                                <div class="col-12">
                                    <label class="form-label fw-semibold small">Deskripsi / Keterangan (Opsional)</label>
                                    <textarea name="deskripsi" class="form-control rounded-3" rows="3"
                                        placeholder="Detail tambahan mengenai lomba atau peraih..."></textarea>
                                </div>
                                <div class="col-12">
                                    <label class="form-label fw-semibold small">Foto / Dokumentasi (Opsional)</label>
                                    <input type="file" name="foto" class="form-control rounded-3" accept="image/*">
                                </div>
                                <div class="col-12 mt-4">
                                    <button type="submit"
                                        class="btn text-white w-100 py-2 rounded-pill fw-semibold shadow-sm"
                                        style="background-color: #0F8B44;">Simpan Prestasi</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endauth
@endsection
