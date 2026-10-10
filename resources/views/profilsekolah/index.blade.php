@extends('layouts.app')

@section('title', 'Profil Sekolah - SDIT Al-Hikmah')

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
                <h3 class="fw-bold mb-1 text-white">Profil Sekolah</h3>
                <p class="mb-0 text-white-50 fs-6">Informasi lengkap, aset visual, visi misi, dan fasilitas sekolah.</p>
            </div>
            <div class="mt-3 mt-md-0">
                <button type="button" class="btn btn-light px-4 py-2 fw-semibold shadow-sm rounded-pill" style="color: #0F8B44;"
                    data-bs-toggle="modal" data-bs-target="#modalEditProfil">
                    <i class="bi bi-pencil-square me-2"></i> Edit Profil & Aset
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

    <div class="row g-4">

        <!-- KOLOM KIRI (Konten Utama: Aset Visual, Visi Misi, Sejarah) -->
        <div class="col-lg-8 d-flex flex-column gap-4">

            <!-- Aset Visual Sekolah -->
            <div class="card-modern">
                <div class="p-4 text-white d-flex align-items-center" style="background-color: #0F8B44;">
                    <h6 class="fw-bold mb-0"><i class="bi bi-images me-2"></i> Aset Visual Sekolah</h6>
                </div>
                <div class="p-4">
                    <div class="row g-4 align-items-center">
                        <div class="col-md-4 text-center border-end">
                            <span class="text-secondary small d-block mb-2 fw-semibold">Logo Sekolah</span>
                            @php $logo = optional($profil)->logo; @endphp
                            @if ($logo && file_exists(public_path('uploads/profil/' . $logo)))
                                <img src="{{ asset('uploads/profil/' . $logo) }}"
                                    class="img-fluid rounded-3 object-fit-contain shadow-sm border p-1"
                                    style="max-height: 100px;" alt="Logo">
                            @else
                                <div
                                    class="bg-body-tertiary rounded-4 d-flex flex-column align-items-center justify-content-center text-secondary py-4 border border-dashed">
                                    <i class="bi bi-shield-shaded fs-2 opacity-50 mb-1"></i>
                                    <small class="small">Belum ada logo</small>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-8 text-center">
                            <span class="text-secondary small d-block mb-2 fw-semibold">Foto Utama / Gedung</span>
                            @php $foto = optional($profil)->foto; @endphp
                            @if ($foto && file_exists(public_path('uploads/profil/' . $foto)))
                                <img src="{{ asset('uploads/profil/' . $foto) }}"
                                    class="img-fluid rounded-3 object-fit-cover w-100 shadow-sm border"
                                    style="height: 110px;" alt="Gedung">
                            @else
                                <div class="bg-body-tertiary rounded-4 d-flex flex-column align-items-center justify-content-center text-secondary py-4 border border-dashed"
                                    style="height: 110px;">
                                    <i class="bi bi-building fs-2 opacity-50 mb-1"></i>
                                    <small class="small">Belum ada foto utama</small>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Visi & Misi -->
            <div class="card-modern">
                <div class="p-4 text-white d-flex align-items-center" style="background-color: #0F8B44;">
                    <h6 class="fw-bold mb-0"><i class="bi bi-bullseye me-2"></i> Visi & Misi</h6>
                </div>
                <div class="p-4">
                    <h6 class="fw-bold mb-2" style="color: #0F8B44;">Visi</h6>
                    <p class="text-secondary fst-italic mb-3">"{!! optional($profil)->visi ?? (optional($profil)->visi_misi ?? 'Belum diatur') !!}"</p>

                    <h6 class="fw-bold mb-2" style="color: #0F8B44;">Misi</h6>
                    <div class="text-secondary small lh-lg">
                        {!! optional($profil)->misi ?? 'Belum ada misi yang diinput.' !!}
                    </div>
                </div>
            </div>

            <!-- Sejarah Singkat -->
            <div class="card-modern">
                <div class="p-4 text-white d-flex align-items-center" style="background-color: #0F8B44;">
                    <h6 class="fw-bold mb-0"><i class="bi bi-clock-history me-2"></i> Sejarah Singkat</h6>
                </div>
                <div class="p-4">
                    <p class="text-secondary small mb-0 lh-lg">
                        {!! optional($profil)->sejarah ?? 'Belum ada catatan sejarah singkat sekolah yang dimasukkan.' !!}
                    </p>
                </div>
            </div>

        </div>

        <!-- KOLOM KANAN (Sidebar Informasi: Identitas Detail & Fasilitas) -->
        <div class="col-lg-4 d-flex flex-column gap-4">

            <!-- Identitas Detail -->
            <div class="card-modern">
                <div class="p-4 text-white d-flex align-items-center" style="background-color: #0F8B44;">
                    <h6 class="fw-bold mb-0"><i class="bi bi-building-check me-2"></i> Identitas Sekolah</h6>
                </div>
                <div class="p-4">
                    <ul class="list-group list-group-flush bg-transparent">
                        <li
                            class="list-group-item px-0 py-2 d-flex justify-content-between align-items-center bg-transparent">
                            <span class="text-secondary small">Nama Sekolah</span>
                            <span
                                class="fw-semibold text-end">{{ optional($profil)->nama_sekolah ?? (optional($profil)->nama ?? '-') }}</span>
                        </li>
                        <li
                            class="list-group-item px-0 py-2 d-flex justify-content-between align-items-center bg-transparent">
                            <span class="text-secondary small">NPSN</span>
                            <span class="fw-semibold text-end">{{ optional($profil)->npsn ?? '-' }}</span>
                        </li>
                        <li
                            class="list-group-item px-0 py-2 d-flex justify-content-between align-items-center bg-transparent">
                            <span class="text-secondary small">Tahun Berdiri</span>
                            <span class="fw-semibold text-end">{{ optional($profil)->tahun_berdiri ?? '1998' }}</span>
                        </li>
                        <li
                            class="list-group-item px-0 py-2 d-flex justify-content-between align-items-center bg-transparent">
                            <span class="text-secondary small">Kepala Sekolah</span>
                            <span class="fw-semibold text-end">{{ optional($profil)->kepala_sekolah ?? '-' }}</span>
                        </li>
                        <li
                            class="list-group-item px-0 py-2 d-flex justify-content-between align-items-center bg-transparent">
                            <span class="text-secondary small">Alamat Lengkap</span>
                            <span class="fw-semibold text-end small">{{ optional($profil)->alamat ?? '-' }}</span>
                        </li>
                        <li
                            class="list-group-item px-0 py-2 d-flex justify-content-between align-items-center bg-transparent">
                            <span class="text-secondary small">Email</span>
                            <span
                                class="fw-semibold text-end small">{{ optional($profil)->email ?? (optional($profil)->kontak ?? '-') }}</span>
                        </li>
                        <li
                            class="list-group-item px-0 py-2 d-flex justify-content-between align-items-center bg-transparent border-0">
                            <span class="text-secondary small">Telepon</span>
                            <span class="fw-semibold text-end">{{ optional($profil)->telepon ?? '-' }}</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Fasilitas Utama -->
            <div class="card-modern">
                <div class="p-4 text-white d-flex align-items-center" style="background-color: #0F8B44;">
                    <h6 class="fw-bold mb-0"><i class="bi bi-tools me-2"></i> Fasilitas Utama</h6>
                </div>
                <div class="p-4">
                    <p class="text-secondary small mb-0 lh-lg">
                        {!! optional($profil)->fasilitas ??
                            'Laboratorium Komputer, Laboratorium IPA, Lapangan Olahraga Multifungsi, Perpustakaan Digital, Masjid, Ruang Musik.' !!}
                    </p>
                </div>
            </div>

        </div>

    </div>

    <!-- MODAL EDIT LENGKAP -->
    <div class="modal fade" id="modalEditProfil" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content rounded-4 border-0 shadow bg-body">
                <div class="modal-header text-white pt-4 px-4" style="background-color: #0F8B44;">
                    <h5 class="modal-title fw-bold"><i class="bi bi-pencil-square me-2"></i> Edit Profil & Aset Sekolah
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <form action="{{ route('profil.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row g-3">
                            <!-- Nama Sekolah -->
                            <div class="col-md-6">
                                <label class="form-label small fw-semibold">Nama Sekolah</label>
                                <input type="text" name="nama_sekolah" class="form-control rounded-3"
                                    value="{{ old('nama_sekolah', $profil->nama_sekolah ?? '') }}" required>
                            </div>

                            <!-- NPSN -->
                            <div class="col-md-6">
                                <label class="form-label small fw-semibold">NPSN</label>
                                <input type="text" name="npsn" class="form-control rounded-3"
                                    value="{{ old('npsn', $profil->npsn ?? '') }}" required>
                            </div>

                            <!-- Kepala Sekolah -->
                            <div class="col-md-6">
                                <label class="form-label small fw-semibold">Kepala Sekolah</label>
                                <input type="text" name="kepala_sekolah" class="form-control rounded-3"
                                    value="{{ old('kepala_sekolah', $profil->kepala_sekolah ?? '') }}" required>
                            </div>

                            <!-- Tahun Berdiri -->
                            <div class="col-md-6">
                                <label class="form-label small fw-semibold">Tahun Berdiri</label>
                                <input type="number" name="tahun_berdiri" class="form-control rounded-3"
                                    value="{{ old('tahun_berdiri', $profil->tahun_berdiri ?? '') }}">
                            </div>

                            <!-- Email Sekolah -->
                            <div class="col-md-6">
                                <label class="form-label small fw-semibold">Email Sekolah</label>
                                <input type="email" name="email" class="form-control rounded-3"
                                    value="{{ old('email', $profil->email ?? '') }}">
                            </div>

                            <!-- Nomor Telepon -->
                            <div class="col-md-6">
                                <label class="form-label small fw-semibold">Nomor Telepon</label>
                                <input type="text" name="telepon" class="form-control rounded-3"
                                    value="{{ old('telepon', $profil->telepon ?? '') }}">
                            </div>

                            <!-- Alamat Lengkap -->
                            <div class="col-12">
                                <label class="form-label small fw-semibold">Alamat Lengkap</label>
                                <textarea name="alamat" class="form-control rounded-3" rows="2" required>{{ old('alamat', $profil->alamat ?? '') }}</textarea>
                            </div>

                            <!-- Ganti Logo Sekolah -->
                            <div class="col-md-6">
                                <label class="form-label small fw-semibold">Ganti Logo Sekolah</label>
                                <input type="file" name="logo" class="form-control rounded-3" accept="image/*">
                                <small class="text-secondary">Format: PNG, JPG (Opsional)</small>
                            </div>

                            <!-- Ganti Foto Utama / Gedung -->
                            <div class="col-md-6">
                                <label class="form-label small fw-semibold">Ganti Foto Utama / Gedung</label>
                                <input type="file" name="foto" class="form-control rounded-3" accept="image/*">
                                <small class="text-secondary">Format: PNG, JPG (Opsional)</small>
                            </div>

                            <!-- Visi -->
                            <div class="col-12">
                                <label class="form-label small fw-semibold">Visi</label>
                                <textarea name="visi" class="form-control rounded-3" rows="2" required>{{ old('visi', $profil->visi ?? '') }}</textarea>
                            </div>

                            <!-- Misi -->
                            <div class="col-12">
                                <label class="form-label small fw-semibold">Misi</label>
                                <textarea name="misi" class="form-control rounded-3" rows="3" required>{{ old('misi', $profil->misi ?? '') }}</textarea>
                            </div>

                            <!-- Sejarah Singkat -->
                            <div class="col-12">
                                <label class="form-label small fw-semibold">Sejarah Singkat</label>
                                <textarea name="sejarah" class="form-control rounded-3" rows="3">{{ old('sejarah', $profil->sejarah ?? '') }}</textarea>
                            </div>

                            <!-- Fasilitas Utama -->
                            <div class="col-12">
                                <label class="form-label small fw-semibold">Fasilitas Utama</label>
                                <textarea name="fasilitas" class="form-control rounded-3" rows="2">{{ old('fasilitas', $profil->fasilitas ?? '') }}</textarea>
                            </div>

                            <!-- Tombol Submit -->
                            <div class="col-12 mt-4">
                                <button type="submit"
                                    class="btn text-white w-100 py-2 rounded-pill fw-semibold shadow-sm" style="background-color: #0F8B44;">Simpan
                                    Perubahan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection