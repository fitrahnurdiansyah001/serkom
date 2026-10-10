@extends('layouts.app')

@section('title', 'Galeri Sekolah - SDIT Al-Hikmah')

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
                <h3 class="fw-bold mb-1 text-white">Galeri Dokumentasi Sekolah</h3>
                <p class="mb-0 text-white-50 fs-6">Koleksi foto kegiatan, fasilitas, dan video dokumentasi resmi sekolah.</p>
            </div>
            @auth
                <div class="mt-3 mt-md-0">
                    <button type="button" class="btn btn-light px-4 py-2 fw-semibold shadow-sm rounded-pill d-flex align-items-center" style="color: #0F8B44;"
                        data-bs-toggle="modal" data-bs-target="#modalTambahGaleri">
                        <i class="bi bi-plus-circle-fill me-2"></i> Tambah Galeri Baru
                    </button>
                </div>
            @endauth
        </div>
    </div>

    <!-- FILTER KATEGORI -->
    <div class="card card-modern mb-4 p-3">
        <form action="{{ route('galeri.index') }}" method="GET" class="row g-3 align-items-center">
            <div class="col-md-4">
                <label class="form-label fw-semibold small mb-1">Filter Kategori:</label>
                <select name="kategori" class="form-select rounded-pill" onchange="this.form.submit()">
                    <option value="">Semua Kategori</option>
                    <option value="Foto" {{ request('kategori') == 'Foto' ? 'selected' : '' }}>Foto</option>
                    <option value="Video" {{ request('kategori') == 'Video' ? 'selected' : '' }}>Video</option>
                </select>
            </div>
            @if (request('kategori'))
                <div class="col-md-3 d-flex align-items-end mt-4 mt-md-0">
                    <a href="{{ route('galeri.index') }}" class="btn btn-outline-secondary rounded-pill px-4 btn-sm">
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

    <!-- TABEL GALERI -->
    <div class="card card-modern mb-5 overflow-hidden">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-body-tertiary">
                        <tr>
                            <th class="py-3 px-4 text-body-secondary fw-semibold" width="5%">NO</th>
                            <th class="py-3 text-body-secondary fw-semibold" width="30%">JUDUL & MEDIA</th>
                            <th class="py-3 text-body-secondary fw-semibold" width="15%">KATEGORI</th>
                            <th class="py-3 text-body-secondary fw-semibold" width="20%">TANGGAL</th>
                            <th class="text-center py-3 text-body-secondary fw-semibold" width="30%">AKSI</th>
                        </tr>
                    </thead>
                    <tbody class="border-top-0">
                        @forelse($galeris ?? [] as $key => $galeri)
                            @php
                                $idGaleri = $galeri->id_galeri ?? $galeri->id;
                            @endphp
                            <tr>
                                <td class="px-4 text-body-secondary">{{ $key + 1 }}</td>
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        @if ($galeri->file && file_exists(public_path('uploads/galeri/' . $galeri->file)))
                                            
                                            {{-- Cek Jika Video --}}
                                            @if ($galeri->kategori == 'Video')
                                                <div class="position-relative rounded-3 overflow-hidden shadow-sm border flex-shrink-0 bg-dark" style="width: 45px; height: 45px;">
                                                    <video class="w-100 h-100 object-fit-cover opacity-75" muted>
                                                        <source src="{{ asset('uploads/galeri/' . $galeri->file) }}" type="video/mp4">
                                                    </video>
                                                    <div class="position-absolute top-50 start-50 translate-middle text-white">
                                                        <i class="bi bi-play-fill fs-5"></i>
                                                    </div>
                                                </div>
                                            @else
                                                {{-- Cek Jika Foto --}}
                                                <img src="{{ asset('uploads/galeri/' . $galeri->file) }}" class="rounded-3 object-fit-cover shadow-sm border flex-shrink-0" width="45" height="45" alt="Media">
                                            @endif

                                        @else
                                            <div class="rounded-3 bg-body-tertiary d-flex align-items-center justify-content-center text-secondary border flex-shrink-0" style="width: 45px; height: 45px;">
                                                <i class="bi {{ $galeri->kategori == 'Video' ? 'bi-play-circle' : 'bi-image' }}"></i>
                                            </div>
                                        @endif

                                        <div class="overflow-hidden">
                                            <span class="fw-bold text-body d-block text-truncate">{{ $galeri->judul }}</span>
                                            @if($galeri->keterangan)
                                                <small class="text-secondary d-block text-truncate">{{ Str::limit($galeri->keterangan, 45) }}</small>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge text-white px-2 py-1 rounded-pill fw-normal" style="background-color: {{ $galeri->kategori == 'Video' ? '#dc3545' : '#0F8B44' }};">
                                        <i class="bi {{ $galeri->kategori == 'Video' ? 'bi-camera-video' : 'bi-camera' }} me-1"></i>
                                        {{ $galeri->kategori }}
                                    </span>
                                </td>
                                <td class="text-secondary">
                                    <i class="bi bi-calendar3 me-1"></i> {{ \Carbon\Carbon::parse($galeri->tanggal)->format('d M Y') }}
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('galeri.show', $galeri->slug) }}" class="btn btn-sm rounded-pill px-3 fw-medium" style="border: 1px solid #0F8B44; color: #0F8B44;">
                                            <i class="bi bi-eye me-1"></i> Detail
                                        </a>

                                        @auth
                                            <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 fw-medium" data-bs-toggle="modal" data-bs-target="#modalEditGaleri{{ $idGaleri }}">
                                                <i class="bi bi-pencil me-1"></i> Edit
                                            </button>
                                            <form action="{{ route('galeri.destroy', $idGaleri) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus item galeri ini?')">
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

                            <!-- MODAL EDIT GALERI -->
                            @auth
                                <div class="modal fade" id="modalEditGaleri{{ $idGaleri }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content rounded-4 border-0 shadow bg-body">
                                            <div class="modal-header text-white pt-4 px-4" style="background-color: #0F8B44;">
                                                <h5 class="modal-title fw-bold">Edit Galeri</h5>
                                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body p-4 text-start">
                                                <form action="{{ route('galeri.update', $idGaleri) }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="row g-3">
                                                        <div class="col-12">
                                                            <label class="form-label fw-semibold small">Judul Galeri</label>
                                                            <input type="text" name="judul" class="form-control rounded-3" value="{{ $galeri->judul }}" required>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label fw-semibold small">Kategori</label>
                                                            <select name="kategori" class="form-select rounded-3" required>
                                                                <option value="Foto" {{ $galeri->kategori == 'Foto' ? 'selected' : '' }}>Foto</option>
                                                                <option value="Video" {{ $galeri->kategori == 'Video' ? 'selected' : '' }}>Video</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label fw-semibold small">Tanggal</label>
                                                            <input type="date" name="tanggal" class="form-control rounded-3" value="{{ $galeri->tanggal }}" required>
                                                        </div>
                                                        <div class="col-12">
                                                            <label class="form-label fw-semibold small">Ganti File Media (Opsional)</label>
                                                            <input type="file" name="file" class="form-control rounded-3" accept="image/*,video/*">
                                                        </div>
                                                        <div class="col-12">
                                                            <label class="form-label fw-semibold small">Keterangan</label>
                                                            <textarea name="keterangan" class="form-control rounded-3" rows="3">{{ $galeri->keterangan }}</textarea>
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
                                        <i class="bi bi-images display-4 text-secondary opacity-50 mb-3"></i>
                                        <h5 class="fw-bold text-body">Belum Ada Data Galeri</h5>
                                        <p class="text-secondary small mb-0">Silakan tambahkan dokumentasi baru melalui tombol di atas.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- MODAL TAMBAH GALERI -->
    @auth
        <div class="modal fade" id="modalTambahGaleri" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content rounded-4 border-0 shadow bg-body">
                    <div class="modal-header text-white pt-4 px-4" style="background-color: #0F8B44;">
                        <h5 class="modal-title fw-bold">Tambah Galeri Baru</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4 text-start">
                        <form action="{{ route('galeri.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="form-label fw-semibold small">Judul Galeri</label>
                                    <input type="text" name="judul" class="form-control rounded-3" placeholder="Contoh: Kegiatan Porseni Sekolah" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold small">Kategori</label>
                                    <select name="kategori" class="form-select rounded-3" required>
                                        <option value="Foto">Foto</option>
                                        <option value="Video">Video</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold small">Tanggal</label>
                                    <input type="date" name="tanggal" class="form-control rounded-3" value="{{ date('Y-m-d') }}" required>
                                </div>
                                <div class="col-12">
                                    <label class="form-label fw-semibold small">Upload File Media</label>
                                    <input type="file" name="file" class="form-control rounded-3" accept="image/*,video/*" required>
                                </div>
                                <div class="col-12">
                                    <label class="form-label fw-semibold small">Keterangan</label>
                                    <textarea name="keterangan" class="form-control rounded-3" rows="3" placeholder="Tuliskan keterangan lengkap kegiatan..."></textarea>
                                </div>
                                <div class="col-12 mt-4">
                                    <button type="submit" class="btn text-white w-100 py-2 rounded-pill fw-semibold shadow-sm" style="background-color: #0F8B44;">Simpan Galeri</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endauth
@endsection