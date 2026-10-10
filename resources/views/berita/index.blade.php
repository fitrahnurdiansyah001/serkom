@extends('layouts.app')

@section('title', 'Berita Sekolah - SDIT Al-Hikmah')

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
                <h3 class="fw-bold mb-1 text-white">Berita & Informasi Sekolah</h3>
                <p class="mb-0 text-white-50 fs-6">Kumpulan artikel, kegiatan, dan pengumuman terbaru dari sekolah.</p>
            </div>
            @auth
                <div class="mt-3 mt-md-0">
                    <button type="button"
                        class="btn btn-light px-4 py-2 fw-semibold shadow-sm rounded-pill d-flex align-items-center"
                        style="color: #0F8B44;" data-bs-toggle="modal" data-bs-target="#modalTambahBerita">
                        <i class="bi bi-newspaper me-2"></i> Tambah Berita Baru
                    </button>
                </div>
            @endauth
        </div>
    </div>

    <!-- FILTER STATUS -->
    <div class="card card-modern mb-4 p-3">
        <form action="{{ route('berita.index') }}" method="GET" class="row g-3 align-items-center">
            <div class="col-md-4">
                <label class="form-label fw-semibold small mb-1">Filter Status:</label>
                <select name="status" class="form-select rounded-pill" onchange="this.form.submit()">
                    <option value="">Semua Status</option>
                    <option value="Publish" {{ request('status') == 'Publish' ? 'selected' : '' }}>Publish</option>
                    <option value="Draft" {{ request('status') == 'Draft' ? 'selected' : '' }}>Draft</option>
                </select>
            </div>
            @if (request('status'))
                <div class="col-md-3 d-flex align-items-end mt-4 mt-md-0">
                    <a href="{{ route('berita.index') }}" class="btn btn-outline-secondary rounded-pill px-4 btn-sm">
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

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show rounded-4 shadow-sm mb-4" role="alert">
            <i class="bi bi-exclamation-triangle me-2"></i> <strong>Gagal menyimpan data!</strong>
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif


    <!-- TABEL BERITA -->
    <div class="card card-modern mb-5 overflow-hidden">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-body-tertiary">
                        <tr>
                            <th class="py-3 px-4 text-body-secondary fw-semibold" width="5%">NO</th>
                            <th class="py-3 text-body-secondary fw-semibold" width="30%">JUDUL BERITA</th>
                            <th class="py-3 text-body-secondary fw-semibold" width="15%">STATUS</th>
                            <th class="py-3 text-body-secondary fw-semibold" width="20%">TANGGAL</th>
                            <th class="text-center py-3 text-body-secondary fw-semibold" width="30%">AKSI</th>
                        </tr>
                    </thead>
                    <tbody class="border-top-0">
                        @forelse($beritas ?? [] as $key => $item)
                            @php
                                $idItem = $item->id_berita ?? $item->id;
                            @endphp
                            <tr>
                                <td class="px-4 text-body-secondary">{{ $key + 1 }}</td>
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        @if ($item->gambar && file_exists(public_path('uploads/berita/' . $item->gambar)))
                                            <img src="{{ asset('uploads/berita/' . $item->gambar) }}"
                                                class="rounded-3 object-fit-cover shadow-sm border flex-shrink-0"
                                                width="45" height="45" alt="Gambar">
                                        @else
                                            <div class="rounded-3 bg-body-tertiary d-flex align-items-center justify-content-center text-secondary border flex-shrink-0"
                                                style="width: 45px; height: 45px;">
                                                <i class="bi bi-newspaper"></i>
                                            </div>
                                        @endif
                                        <div class="overflow-hidden">
                                            <span class="fw-bold text-body d-block text-truncate">{{ $item->judul }}</span>
                                            @if ($item->isi)
                                                <small
                                                    class="text-secondary d-block text-truncate">{{ Str::limit(strip_tags($item->isi), 45) }}</small>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span
                                        class="badge {{ $item->status == 'Publish' ? 'bg-success' : 'bg-warning text-dark' }} px-2 py-1 rounded-pill fw-semibold"
                                        style="font-size: 0.75rem;">
                                        {{ $item->status }}
                                    </span>
                                </td>
                                <td class="text-secondary">
                                    <i class="bi bi-calendar-event me-1"></i>
                                    {{ date('d M Y', strtotime($item->tanggal ?? $item->created_at)) }}
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('berita.show', $item->slug) }}"
                                            class="btn btn-sm rounded-pill px-3 fw-medium"
                                            style="border: 1px solid #0F8B44; color: #0F8B44;">
                                            <i class="bi bi-eye me-1"></i> Detail
                                        </a>

                                        @auth
                                            <button type="button"
                                                class="btn btn-sm btn-outline-secondary rounded-pill px-3 fw-medium"
                                                data-bs-toggle="modal" data-bs-target="#modalEditBerita{{ $idItem }}">
                                                <i class="bi bi-pencil me-1"></i> Edit
                                            </button>
                                            <form action="{{ route('berita.destroy', $idItem) }}" method="POST"
                                                class="d-inline" onsubmit="return confirm('Yakin ingin menghapus berita ini?')">
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

                            <!-- MODAL EDIT BERITA -->
                            @auth
                                <div class="modal fade" id="modalEditBerita{{ $idItem }}" tabindex="-1"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-centered">
                                        <div class="modal-content rounded-4 border-0 shadow bg-body">
                                            <div class="modal-header text-white pt-4 px-4" style="background-color: #0F8B44;">
                                                <h5 class="modal-title fw-bold">Edit Berita</h5>
                                                <button type="button" class="btn-close btn-close-white"
                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body p-4 text-start">
                                                <form action="{{ route('berita.update', $idItem) }}" method="POST"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="row g-3">
                                                        <div class="col-12">
                                                            <label class="form-label fw-semibold small">Judul Berita</label>
                                                            <input type="text" name="judul"
                                                                class="form-control rounded-3" value="{{ $item->judul }}"
                                                                required>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label fw-semibold small">Tanggal</label>
                                                            <input type="date" name="tanggal"
                                                                class="form-control rounded-3"
                                                                value="{{ $item->tanggal ? date('Y-m-d', strtotime($item->tanggal)) : '' }}"
                                                                required>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label fw-semibold small">Status
                                                                Publikasi</label>
                                                            <select name="status" class="form-select rounded-3" required>
                                                                <option value="Publish"
                                                                    {{ $item->status == 'Publish' ? 'selected' : '' }}>Publish
                                                                </option>
                                                                <option value="Draft"
                                                                    {{ $item->status == 'Draft' ? 'selected' : '' }}>Draft
                                                                </option>
                                                            </select>
                                                        </div>
                                                        <div class="col-12">
                                                            <label class="form-label fw-semibold small">Isi Berita</label>
                                                            <textarea name="isi" class="form-control rounded-3" rows="6" required>{{ $item->isi }}</textarea>
                                                        </div>
                                                        <div class="col-12">
                                                            <label class="form-label fw-semibold small">Ganti Gambar
                                                                (Opsional)
                                                            </label>
                                                            <input type="file" name="gambar"
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
                                <td colspan="5" class="text-center py-5">
                                    <div class="d-flex flex-column align-items-center">
                                        <i class="bi bi-newspaper display-4 text-secondary opacity-50 mb-3"></i>
                                        <h5 class="fw-bold text-body">Belum Ada Data Berita</h5>
                                        <p class="text-secondary small mb-0">Silakan tambahkan berita sekolah melalui
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

    <!-- MODAL TAMBAH BERITA -->
    @auth
        <div class="modal fade" id="modalTambahBerita" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content rounded-4 border-0 shadow bg-body">
                    <div class="modal-header text-white pt-4 px-4" style="background-color: #0F8B44;">
                        <h5 class="modal-title fw-bold">Tambah Berita Baru</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4 text-start">
                        <form action="{{ route('berita.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="form-label fw-semibold small">Judul Berita</label>
                                    <input type="text" name="judul" class="form-control rounded-3"
                                        placeholder="Contoh: Peresmian Gedung Laboratorium Baru" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold small">Tanggal</label>
                                    <input type="date" name="tanggal" class="form-control rounded-3"
                                        value="{{ date('Y-m-d') }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold small">Status Publikasi</label>
                                    <select name="status" class="form-select rounded-3" required>
                                        <option value="Publish">Publish</option>
                                        <option value="Draft">Draft</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label class="form-label fw-semibold small">Isi Berita</label>
                                    <textarea name="isi" class="form-control rounded-3" rows="6"
                                        placeholder="Tulis isi berita lengkap di sini..." required></textarea>
                                </div>
                                <div class="col-12">
                                    <label class="form-label fw-semibold small">Gambar Berita</label>
                                    <input type="file" name="gambar" class="form-control rounded-3" accept="image/*">
                                </div>
                                <div class="col-12 mt-4">
                                    <button type="submit"
                                        class="btn text-white w-100 py-2 rounded-pill fw-semibold shadow-sm"
                                        style="background-color: #0F8B44;">Simpan Berita</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endauth
@endsection
