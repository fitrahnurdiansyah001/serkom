@extends('layouts.app')

@section('title', 'Data Guru - SDIT Al-Hikmah')

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
                <h3 class="fw-bold mb-1 text-white">Manajemen Data Guru</h3>
                <p class="mb-0 text-white-50 fs-6">Kelola data profil pengajar, jabatan, NIP, serta mata pelajaran sekolah.
                </p>
            </div>

            <div class="mt-3 mt-md-0">
                <button type="button"
                    class="btn btn-light px-4 py-2 fw-semibold shadow-sm rounded-pill d-flex align-items-center"
                    style="color: #0F8B44;" data-bs-toggle="modal" data-bs-target="#modalTambahGuru">
                    <i class="bi bi-person-plus-fill me-2"></i> Tambah Guru Baru
                </button>
            </div>
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

    <!-- TABEL GURU -->
    <div class="card card-modern mb-5 overflow-hidden">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-body-tertiary">
                        <tr>
                            <th class="py-3 px-4 text-body-secondary fw-semibold" width="5%">NO</th>
                            <th class="py-3 text-body-secondary fw-semibold" width="30%">NAMA GURU & GURU</th>
                            <th class="py-3 text-body-secondary fw-semibold" width="20%">JABATAN</th>
                            <th class="py-3 text-body-secondary fw-semibold" width="20%">MATA PELAJARAN</th>
                            <th class="text-center py-3 text-body-secondary fw-semibold" width="25%">AKSI</th>
                        </tr>
                    </thead>
                    <tbody class="border-top-0">
                        @forelse($gurus ?? [] as $key => $guru)
                            @php
                                $idGuru = $guru->id_guru ?? $guru->id;
                                $pilihanJabatan = [
                                    'Kepala Sekolah',
                                    'Wakil Kepala Sekolah',
                                    'Guru Mata Pelajaran',
                                    'Wali Kelas',
                                    'Guru BK',
                                    'Pembina Ekstrakurikuler',
                                ];
                                $pilihanMapel = [
                                    'Matematika',
                                    'Bahasa Indonesia',
                                    'Bahasa Inggris',
                                    'IPA / Biologi / Fisika',
                                    'IPS / Sejarah / Ekonomi',
                                    'Pendidikan Agama Islam',
                                    'PJOK',
                                    'Seni Budaya',
                                    'TIK / Informatika',
                                    'Lainnya',
                                ];
                            @endphp
                            <tr>
                                <td class="px-4 text-body-secondary">{{ $key + 1 }}</td>
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        @if (!empty($guru->foto) && file_exists(public_path('uploads/guru/' . $guru->foto)))
                                            <img src="{{ asset('uploads/guru/' . $guru->foto) }}"
                                                class="rounded-circle object-fit-cover shadow-sm border flex-shrink-0"
                                                width="45" height="45" alt="Foto">
                                        @else
                                            <div class="rounded-circle d-flex align-items-center justify-content-center fw-bold me-2"
                                                style="width: 35px; height: 35px; font-size: 0.85rem; background-color: rgba(15, 139, 68, 0.1); color: #0F8B44;">
                                                {{ strtoupper(substr($guru->nama_guru, 0, 1)) }}
                                            </div>
                                        @endif
                                        <div class="overflow-hidden">
                                            <span
                                                class="fw-bold text-body d-block text-truncate">{{ $guru->nama_guru }}</span>
                                            <small class="text-secondary d-block text-truncate">NIP:
                                                {{ $guru->nip ?? '-' }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span
                                        class="badge bg-secondary bg-opacity-10 text-secondary border border-secondary border-opacity-10 rounded-pill px-3 py-1"
                                        style="font-size: 0.75rem;">
                                        {{ $guru->jabatan ?? 'Guru Pengajar' }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge rounded-pill px-3 py-1"
                                        style="background-color: rgba(15, 139, 68, 0.1); color: #0F8B44; font-size: 0.75rem;">
                                        {{ $guru->mata_pelajaran ?? 'Umum' }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('guru.show', $guru->slug) }}"
                                            class="btn btn-sm rounded-pill px-3 fw-medium"
                                            style="border: 1px solid #0F8B44; color: #0F8B44;">
                                            <i class="bi bi-eye me-1"></i> Detail
                                        </a>

                                        @auth
                                            <button type="button"
                                                class="btn btn-sm btn-outline-secondary rounded-pill px-3 fw-medium"
                                                data-bs-toggle="modal" data-bs-target="#modalEditGuru{{ $idGuru }}">
                                                <i class="bi bi-pencil me-1"></i> Edit
                                            </button>
                                            <form action="{{ route('guru.destroy', $idGuru) }}" method="POST" class="d-inline"
                                                onsubmit="return confirm('Yakin ingin menghapus data guru ini?')">
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

                            <!-- MODAL EDIT GURU -->
                            @auth
                                <div class="modal fade" id="modalEditGuru{{ $idGuru }}" tabindex="-1"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content rounded-4 border-0 shadow bg-body">
                                            <div class="modal-header text-white pt-4 px-4" style="background-color: #0F8B44;">
                                                <h5 class="modal-title fw-bold">Edit Data Guru</h5>
                                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body p-4 text-start">
                                                <form action="{{ route('guru.update', $idGuru) }}" method="POST"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="row g-3">
                                                        <div class="col-12">
                                                            <label class="form-label fw-semibold small">Nama Lengkap &
                                                                Gelar</label>
                                                            <input type="text" name="nama_guru"
                                                                class="form-control rounded-3" value="{{ $guru->nama_guru }}"
                                                                required>
                                                        </div>
                                                        <div class="col-12">
                                                            <label class="form-label fw-semibold small">Jabatan di
                                                                Sekolah</label>
                                                            <select name="jabatan" class="form-select rounded-3">
                                                                <option value="">Pilih Jabatan</option>
                                                                @foreach ($pilihanJabatan as $jab)
                                                                    <option value="{{ $jab }}"
                                                                        {{ $guru->jabatan == $jab ? 'selected' : '' }}>
                                                                        {{ $jab }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-12">
                                                            <label class="form-label fw-semibold small">NIP / NUPTK</label>
                                                            <input type="text" name="nip"
                                                                class="form-control rounded-3" value="{{ $guru->nip }}">
                                                        </div>
                                                        <div class="col-12">
                                                            <label class="form-label fw-semibold small">Mata Pelajaran</label>
                                                            <select name="mata_pelajaran" class="form-select rounded-3">
                                                                <option value="">Pilih Mata Pelajaran</option>
                                                                @foreach ($pilihanMapel as $mapel)
                                                                    <option value="{{ $mapel }}"
                                                                        {{ $guru->mata_pelajaran == $mapel ? 'selected' : '' }}>
                                                                        {{ $mapel }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-12">
                                                            <label class="form-label fw-semibold small">Foto Profil Baru
                                                                (Opsional)
                                                            </label>
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
                                <td colspan="5" class="text-center py-5">
                                    <div class="d-flex flex-column align-items-center">
                                        <i class="bi bi-person-badge display-4 text-secondary opacity-50 mb-3"></i>
                                        <h5 class="fw-bold text-body">Belum Ada Data Guru</h5>
                                        <p class="text-secondary small mb-0">Silakan tambahkan data guru baru melalui
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


    @php
        $pilihanJabatanModal = [
            'Kepala Sekolah',
            'Wakil Kepala Sekolah',
            'Guru Mata Pelajaran',
            'Wali Kelas',
            'Guru BK',
            'Pembina Ekstrakurikuler',
        ];
        $pilihanMapelModal = [
            'Matematika',
            'Bahasa Indonesia',
            'Bahasa Inggris',
            'IPA / Biologi / Fisika',
            'IPS / Sejarah / Ekonomi',
            'Pendidikan Agama Islam',
            'PJOK',
            'Seni Budaya',
            'TIK / Informatika',
            'Lainnya',
        ];
    @endphp

    @auth
        <div class="modal fade" id="modalTambahGuru" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content rounded-4 border-0 shadow bg-body">
                    <div class="modal-header text-white pt-4 px-4" style="background-color: #0F8B44;">
                        <h5 class="modal-title fw-bold">Tambah Guru Baru</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4 text-start">
                        <form action="{{ route('guru.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="form-label fw-semibold small">Nama Lengkap & Gelar</label>
                                    <input type="text" name="nama_guru" class="form-control rounded-3"
                                        placeholder="Contoh: Drs. H. Ahmad, M.Pd." required>
                                </div>
                                <div class="col-12">
                                    <label class="form-label fw-semibold small">Jabatan di Sekolah</label>
                                    <select name="jabatan" class="form-select rounded-3">
                                        <option value="">Pilih Jabatan</option>
                                        @foreach ($pilihanJabatanModal as $jab)
                                            <option value="{{ $jab }}">{{ $jab }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label class="form-label fw-semibold small">NIP / NUPTK</label>
                                    <input type="text" name="nip" class="form-control rounded-3"
                                        placeholder="Nomor Induk Pegawai">
                                </div>
                                <div class="col-12">
                                    <label class="form-label fw-semibold small">Mata Pelajaran</label>
                                    <select name="mata_pelajaran" class="form-select rounded-3">
                                        <option value="">Pilih Mata Pelajaran</option>
                                        @foreach ($pilihanMapelModal as $mapel)
                                            <option value="{{ $mapel }}">{{ $mapel }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label class="form-label fw-semibold small">Foto Profil</label>
                                    <input type="file" name="foto" class="form-control rounded-3" accept="image/*">
                                </div>
                                <div class="col-12 mt-4">
                                    <button type="submit"
                                        class="btn text-white w-100 py-2 rounded-pill fw-semibold shadow-sm"
                                        style="background-color: #0F8B44;">Simpan Data Guru</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endauth
@endsection
