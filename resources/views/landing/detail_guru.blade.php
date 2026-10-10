@extends('landing.layouts')

@section('title', ($guru->nama_guru ?? $guru->nama) . ' - SDIT Al-Hikmah')

@section('content')
    <div class="container mt-5 pt-4 pb-5">
        <div class="row justify-content-center mb-5">
            <div class="col-lg-8">

                <div class="mb-4">
                    <a href="{{ url('/info-guru') }}" class="btn rounded-pill px-4 fw-semibold btn-sm shadow-sm"
                        style="border: 1px solid #0F8B44; color: #0F8B44;">
                        <i class="bi bi-arrow-left me-2"></i> Kembali ke Daftar Guru & Staf
                    </a>
                </div>

                <div class="card-modern p-4 p-md-5 text-center bg-white border shadow-sm">

                    <div class="mb-4 d-flex justify-content-center">
                        @if (!empty($guru->foto) && file_exists(public_path('uploads/guru/' . $guru->foto)))
                            <img src="{{ asset('uploads/guru/' . $guru->foto) }}" alt="{{ $guru->nama_guru }}"
                                class="profile-img-large"
                                style="width: 170px; height: 170px; object-fit: cover; aspect-ratio: 1 / 1; border-radius: 50%; border: 5px solid #0F8B44; box-shadow: 0 10px 25px rgba(15, 139, 68, 0.25);">
                        @else
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($guru->nama_guru ?? 'Guru') }}&background=0F8B44&color=fff&size=256"
                                alt="{{ $guru->nama_guru }}" class="profile-img-large"
                                style="width: 170px; height: 170px; object-fit: cover; aspect-ratio: 1 / 1; border-radius: 50%; border: 5px solid #0F8B44; box-shadow: 0 10px 25px rgba(15, 139, 68, 0.25);">
                        @endif
                    </div>

                    <h2 class="fw-bold text-body mb-2">{{ $guru->nama_guru }}</h2>

                    <hr class="my-4 opacity-10">

                    <div class="row text-start g-3 px-md-3">

                        <div class="col-12">
                            <div class="info-box p-3 bg-body-tertiary border rounded-3">
                                <small class="text-secondary d-block mb-1 font-monospace" style="font-size: 0.8rem;">
                                    <i class="bi bi-briefcase me-1" style="color: #0F8B44;"></i> JABATAN
                                </small>
                                <span
                                    class="fw-bold text-body fs-6">{{ $guru->jabatan ?? 'Tenaga Pengajar Sekolah' }}</span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="info-box p-3.5 h-100 p-3 bg-body-tertiary border rounded-3">
                                <small class="text-secondary d-block mb-1 font-monospace" style="font-size: 0.8rem;">
                                    <i class="bi bi-card-text me-1" style="color: #0F8B44;"></i> NOMOR INDUK (NIP / NUPTK)
                                </small>
                                <span class="fw-bold text-body fs-6">{{ $guru->nip ?? 'Tidak ada data NIP' }}</span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="info-box p-3.5 h-100 p-3 bg-body-tertiary border rounded-3">
                                <small class="text-secondary d-block mb-1 font-monospace" style="font-size: 0.8rem;">
                                    <i class="bi bi-book me-1" style="color: #0F8B44;"></i> BIDANG MATA PELAJARAN
                                </small>
                                <span class="fw-bold text-body fs-6">{{ $guru->mata_pelajaran ?? 'Umum' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
