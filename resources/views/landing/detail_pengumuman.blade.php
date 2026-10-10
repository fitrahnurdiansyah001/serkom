@extends('landing.layouts')

@section('title', 'Pengumuman - Web Schools')
@section('content')
    <div class="row justify-content-center mb-5">
        <div class="col-lg-9">
            <div class="mb-4">
                <a href="{{ url('/info-pengumuman') }}" class="btn btn-outline-secondary btn-rounded btn-sm">
                    <i class="bi bi-arrow-left me-2"></i> Kembali ke Daftar Pengumuman
                </a>
            </div>
            <div class="card-modern p-4 p-md-5">

                <div class="mb-4 text-center">
                    @if (!empty($pengumuman->foto) && file_exists(public_path('uploads/pengumuman/' . $pengumuman->foto)))
                        <div class="mb-4 text-center">
                            <img src="{{ asset('uploads/pengumuman/' . $pengumuman->foto) }}" alt="{{ $pengumuman->judul }}"
                                class="pengumuman-img-large">
                        </div>
                    @endif
                </div>

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span
                        class="badge {{ $pengumuman->status == 'Publish' ? 'bg-success' : 'bg-warning text-dark' }} px-3 py-2 rounded-pill fw-semibold"
                        style="font-size: 0.85rem;">
                        {{ $pengumuman->status }}
                    </span>
                    <span class="text-muted fw-medium">
                        <i class="bi bi-calendar-event me-1"></i>
                        {{ date('d F Y', strtotime($pengumuman->tanggal ?? $pengumuman->created_at)) }}
                    </span>
                </div>

                <h1 class="fw-bold text-dark mb-2" style="line-height: 1.3;">{{ $pengumuman->judul }}</h1>

                <div class="d-flex align-items-center text-muted mb-4 pb-3 border-bottom">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-person-circle text-primary fs-5 me-2"></i>
                        <span>Ditulis oleh <strong
                                class="text-dark">{{ $pengumuman->penulis ?? 'Admin Sekolah' }}</strong></span>
                    </div>
                </div>

                <div class="mb-4">
                    <div class="text-dark lh-lg" style="font-size: 1.05rem; white-space: pre-line;">
                        {!! $pengumuman->isi !!}
                    </div>
                </div>

                <hr class="my-4 opacity-10">

                <div class="info-box p-3">
                    <small class="text-muted d-block mb-1 font-monospace" style="font-size: 0.8rem;">
                        <i class="bi bi-clock-history me-1 text-primary"></i> INFORMASI WAKTU SISTEM
                    </small>
                    <span class="fw-semibold text-dark small">
                        Dibuat pada: {{ $pengumuman->created_at ? $pengumuman->created_at->format('d M Y, H:i') : '-' }}
                        @if ($pengumuman->updated_at && $pengumuman->updated_at != $pengumuman->created_at)
                            <span class="d-inline-block ms-md-2 text-muted">| Terakhir diubah:
                                {{ $pengumuman->updated_at->format('d M Y, H:i') }}</span>
                        @endif
                    </span>
                </div>

            </div>
        </div>
    </div>
@endsection
