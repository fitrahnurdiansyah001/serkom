@extends('layouts.app')

@section('title', 'Data Siswa - SDIT Al-Hikmah')

@section('content')
    <style>
        .card-modern {
            background-color: var(--bs-body-bg);
            border: 1px solid var(--bs-border-color, rgba(0, 0, 0, 0.08));
            border-radius: 1.25rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.03), 0 2px 4px -1px rgba(0, 0, 0, 0.02);
            overflow: hidden;
            transition: all 0.25s ease-in-out;
        }

        .table-responsive {
            border-radius: 1rem;
        }

        .table {
            color: var(--bs-body-color);
            background-color: var(--bs-body-bg);
            vertical-align: middle;
        }

        .form-control,
        .form-select {
            background-color: var(--bs-body-bg);
            color: var(--bs-body-color);
        }

        html[data-bs-theme="dark"] .modal-content {
            background-color: #1e293b !important;
            color: #f8f9fa !important;
            border: 1px solid rgba(255, 255, 255, 0.08) !important;
        }

        html[data-bs-theme="dark"] .form-control,
        html[data-bs-theme="dark"] .form-select {
            background-color: #0f172a !important;
            border-color: #334155 !important;
            color: #f8f9fa !important;
        }
    </style>

    <!-- BANNER UTAMA -->
    <div class="card border-0 text-white mb-4 shadow-sm"
        style="background: linear-gradient(135deg, #0F8B44 0%, #0c7338 100%); border-radius: 1rem;">
        <div class="card-body p-4 p-md-5 d-flex flex-column flex-md-row justify-content-between align-items-md-center">
            <div>
                <h3 class="fw-bold mb-1 text-white">Manajemen Data Siswa</h3>
                <p class="mb-0 text-white-50 fs-6">Kelola data profil siswa, NISN, tahun masuk, serta jenis kelamin dalam format tabel.</p>
            </div>
            <div class="mt-3 mt-md-0">
                <button type="button"
                    class="btn btn-light px-4 py-2 fw-semibold shadow-sm rounded-pill d-flex align-items-center"
                    style="color: #0F8B44;" data-bs-toggle="modal" data-bs-target="#modalTambahSiswa">
                    <i class="bi bi-person-plus-fill me-2"></i> Tambah Siswa Baru
                </button>
            </div>
        </div>
    </div>

    <!-- FILTER & PENCARIAN -->
    <div class="card card-modern mb-4 p-3">
        <form action="{{ route('siswa.index') }}" method="GET" class="row g-3 align-items-center">
            <div class="col-md-4">
                <label class="form-label fw-semibold small mb-1">Filter Jenis Kelamin:</label>
                <select name="jenis_kelamin" class="form-select rounded-pill" onchange="this.form.submit()">
                    <option value="">Semua Jenis Kelamin</option>
                    <option value="Laki-laki" {{ request('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="Perempuan" {{ request('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>
            @if (request('jenis_kelamin'))
                <div class="col-md-3 d-flex align-items-end mt-4 mt-md-0">
                    <a href="{{ route('siswa.index') }}" class="btn btn-outline-secondary rounded-pill px-4 btn-sm">
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

    <!-- TABEL DATA SISWA -->
    <div class="card card-modern mb-5">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0 align-middle">
                    <thead class="bg-body-tertiary text-uppercase fs-7">
                        <tr>
                            <th class="py-3 px-4 text-body-secondary fw-semibold" style="width: 5%;">No</th>
                            <th class="py-3 px-3 text-body-secondary fw-semibold">Nama Lengkap</th>
                            <th class="py-3 px-3 text-body-secondary fw-semibold">NISN</th>
                            <th class="py-3 px-3 text-body-secondary fw-semibold">Kelas</th>
                            <th class="py-3 px-3 text-body-secondary fw-semibold">Tahun Masuk</th>
                            <th class="py-3 px-3 text-body-secondary fw-semibold">Jenis Kelamin</th>
                            <th class="py-3 px-4 text-center text-body-secondary fw-semibold" style="width: 25%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="border-top-0">
                        @forelse($siswas ?? [] as $index => $siswa)
                            @php
                                $idSiswa = $siswa->id_siswa ?? $siswa->id;
                            @endphp
                            <tr>
                                <td class="px-4 fw-semibold text-body-secondary">{{ $index + 1 }}</td>
                                <td class="px-3">
                                    <div class="d-flex align-items-center">
                                        <div class="rounded-circle d-flex align-items-center justify-content-center fw-bold me-2"
                                            style="width: 35px; height: 35px; font-size: 0.85rem; background-color: rgba(15, 139, 68, 0.1); color: #0F8B44;">
                                            {{ strtoupper(substr($siswa->nama_siswa, 0, 1)) }}
                                        </div>
                                        <span class="fw-bold text-body">{{ $siswa->nama_siswa }}</span>
                                    </div>
                                </td>
                                <td class="px-3 font-monospace small text-secondary">{{ $siswa->nisn ?? '-' }}</td>
                                
                                <!-- MENAMPILKAN KODE KELAS DARI RELASI -->
                                <td class="px-3 font-monospace small text-secondary">
                                    {{ $siswa->kelas ? $siswa->kelas->kode_kelas : 'Belum ada kelas' }}
                                </td>
                                
                                <td class="px-3">
                                    <span class="badge bg-secondary bg-opacity-10 text-secondary border border-secondary border-opacity-10 rounded-pill px-3 py-1">
                                        {{ $siswa->tahun_masuk ?? '-' }}
                                    </span>
                                </td>
                                <td class="px-3">
                                    <span class="badge rounded-pill px-3 py-1"
                                        style="background-color: rgba(15, 139, 68, 0.1); color: #0F8B44;">
                                        {{ $siswa->jenis_kelamin ?? '-' }}
                                    </span>
                                </td>
                                <td class="px-4 text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('siswa.show', $siswa->slug ?? $idSiswa) }}"
                                            class="btn btn-sm rounded-pill px-3 fw-semibold shadow-sm text-white"
                                            style="background-color: #0F8B44;">
                                            <i class="bi bi-eye me-1"></i> Detail
                                        </a>

                                        <button type="button" class="btn btn-sm rounded-pill px-3 fw-medium"
                                            style="border: 1px solid #0F8B44; color: #0F8B44;" data-bs-toggle="modal"
                                            data-bs-target="#modalEditSiswa{{ $idSiswa }}">
                                            <i class="bi bi-pencil me-1"></i> Edit
                                        </button>

                                        <form action="{{ route('siswa.destroy', $idSiswa) }}" method="POST"
                                            class="d-inline"
                                            onsubmit="return confirm('Yakin ingin menghapus data siswa ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="btn btn-sm btn-outline-danger rounded-pill px-3 fw-medium">
                                                <i class="bi bi-trash me-1"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>

                            <!-- MODAL EDIT SISWA -->
                            <div class="modal fade" id="modalEditSiswa{{ $idSiswa }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content rounded-4 border-0 shadow bg-body">
                                        <div class="modal-header text-white pt-4 px-4" style="background-color: #0F8B44;">
                                            <h5 class="modal-title fw-bold">Edit Data Siswa</h5>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body p-4 text-start">
                                            <form action="{{ route('siswa.update', $idSiswa) }}" method="POST">
                                                @csrf
                                                <div class="row g-3">
                                                    <div class="col-12">
                                                        <label class="form-label fw-semibold small">Nama Lengkap Siswa</label>
                                                        <input type="text" name="nama_siswa"
                                                            class="form-control rounded-3"
                                                            value="{{ $siswa->nama_siswa }}" required>
                                                    </div>
                                                    <div class="col-12">
                                                        <label class="form-label fw-semibold small">NISN</label>
                                                        <input type="text" name="nisn"
                                                            class="form-control rounded-3" value="{{ $siswa->nisn }}" required>
                                                    </div>
                                                    <div class="col-12">
                                                        <label class="form-label fw-semibold small">Kelas</label>
                                                        <select name="kelas_id" class="form-select rounded-3" required>
                                                            <option value="">-- Pilih Kelas --</option>
                                                            @foreach ($semuaKelas ?? [] as $kls)
                                                                <option value="{{ $kls->id }}" {{ $siswa->kelas_id == $kls->id ? 'selected' : '' }}>
                                                                    {{ $kls->kode_kelas }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label class="form-label fw-semibold small">Tahun Masuk</label>
                                                        @php
                                                            $profilSekolah = \App\Models\ProfilSekolah::first();
                                                            $minTahun = $profilSekolah && $profilSekolah->tahun_berdiri ? (int) $profilSekolah->tahun_berdiri : 2000;
                                                        @endphp
                                                        <input type="number" name="tahun_masuk"
                                                            class="form-control rounded-3 @error('tahun_masuk') is-invalid @enderror"
                                                            value="{{ old('tahun_masuk', $siswa->tahun_masuk) }}"
                                                            min="{{ $minTahun }}" max="{{ date('Y') }}" required>
                                                        <div class="form-text" style="font-size: 0.75rem;">Minimal tahun {{ $minTahun }}.</div>
                                                        @error('tahun_masuk')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    
                                                    <div class="col-md-6">
                                                        <label class="form-label fw-semibold small">Jenis Kelamin</label>
                                                        <select name="jenis_kelamin" class="form-select rounded-3" required>
                                                            <option value="Laki-laki" {{ $siswa->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                                            <option value="Perempuan" {{ $siswa->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                                        </select>
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
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-5 text-secondary">
                                    <div class="d-flex flex-column align-items-center">
                                        <i class="bi bi-people display-4 opacity-50 mb-2"></i>
                                        <h6 class="fw-bold text-body">Belum ada data siswa.</h6>
                                        <p class="small mb-0">Silakan tambahkan data siswa baru melalui tombol di atas.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- MODAL TAMBAH SISWA -->
    <div class="modal fade" id="modalTambahSiswa" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4 border-0 shadow bg-body">
                <div class="modal-header text-white pt-4 px-4" style="background-color: #0F8B44;">
                    <h5 class="modal-title fw-bold">Tambah Siswa Baru</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4 text-start">
                    <form action="{{ route('siswa.store') }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label fw-semibold small">Nama Lengkap Siswa</label>
                                <input type="text" name="nama_siswa" class="form-control rounded-3" placeholder="Contoh: Siti Aminah" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-semibold small">NISN</label>
                                <input type="text" name="nisn" class="form-control rounded-3" placeholder="Nomor Induk Siswa Nasional" required>
                            </div>
                            
                            <!-- INPUT KELAS DI MODAL TAMBAH (SUDAH DIPERBAIKI) -->
                            <div class="col-12">
                                <label class="form-label fw-semibold small">Kelas</label>
                                <select name="kelas_id" class="form-select rounded-3" required>
                                    <option value="">-- Pilih Kelas --</option>
                                    @foreach ($semuaKelas ?? [] as $kls)
                                        <option value="{{ $kls->id }}">{{ $kls->kode_kelas }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold small">Tahun Masuk</label>
                                @php
                                    $profilSekolah = \App\Models\ProfilSekolah::first();
                                    $minTahun = $profilSekolah && $profilSekolah->tahun_berdiri ? (int) $profilSekolah->tahun_berdiri : 2000;
                                @endphp
                                <input type="number" name="tahun_masuk"
                                    class="form-control rounded-3 @error('tahun_masuk') is-invalid @enderror"
                                    value="{{ old('tahun_masuk') }}" min="{{ $minTahun }}"
                                    max="{{ date('Y') }}" placeholder="Contoh: {{ date('Y') }}" required>
                                <div class="form-text" style="font-size: 0.75rem;">Minimal tahun {{ $minTahun }}.</div>
                                @error('tahun_masuk')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6">
                                <label class="form-label fw-semibold small">Jenis Kelamin</label>
                                <select name="jenis_kelamin" class="form-select rounded-3" required>
                                    <option value="">Pilih</option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                            <div class="col-12 mt-4">
                                <button type="submit"
                                    class="btn text-white w-100 py-2 rounded-pill fw-semibold shadow-sm"
                                    style="background-color: #0F8B44;">Simpan Data Siswa</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection