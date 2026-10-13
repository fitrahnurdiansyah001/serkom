@extends('landing.layouts.layouts')

@section('title', ($berita->nama_berita ?? $berita->nama) . ' - Web Schools')

@section('content')
    <div class="row justify-content-center mb-5">
        <div class="col-lg-9">
            <div class="mb-4">
                <a href="{{ url('/info-berita') }}" class="btn btn-outline-secondary btn-rounded btn-sm">
                    <i class="bi bi-arrow-left me-2"></i> Kembali ke Daftar Berita
                </a>
            </div>
            <div class="card-modern p-4 p-md-5">

                <div class="mb-4 text-center">
                    @if (!empty($berita->gambar) && file_exists(public_path('uploads/berita/' . $berita->gambar)))
                        <img src="{{ asset('uploads/berita/' . $berita->gambar) }}" class="card-img-top object-covaer"
                            style="height: 500px;" alt="Berita">
                    @endif
                </div>

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span
                        class="badge {{ $berita->status == 'Publish' ? 'bg-success' : 'bg-warning text-dark' }} px-3 py-2 rounded-pill fw-semibold"
                        style="font-size: 0.85rem;">
                        {{ $berita->status }}
                    </span>`
                    <span class="text-muted fw-medium">
                        <i class="bi bi-calendar-event me-1"></i>
                        {{ date('d F Y', strtotime($berita->tanggal ?? $berita->created_at)) }}
                    </span>
                </div>

                <h1 class="fw-bold text-dark mb-2" style="line-height: 1.3;">{{ $berita->judul }}</h1>

                <div class="d-flex align-items-center text-muted mb-4 pb-3 border-bottom">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-person-circle text-primary fs-5 me-2"></i>
                        <span>Ditulis oleh <strong
                                class="text-dark">{{ $berita->penulis ?? 'Admin Sekolah' }}</strong></span>
                    </div>
                </div>

                <div class="mb-4">
                    <div class="text-dark lh-lg" style="font-size: 1.05rem; white-space: pre-line;">
                        {!! $berita->isi !!}
                    </div>
                </div>

                <hr class="my-4 opacity-10">

                <div class="info-box p-3">
                    <small class="text-muted d-block mb-1 font-monospace" style="font-size: 0.8rem;">
                        <i class="bi bi-clock-history me-1 text-primary"></i> INFORMASI WAKTU SISTEM
                    </small>
                    <span class="fw-semibold text-dark small">
                        Dibuat pada: {{ $berita->created_at ? $berita->created_at->format('d M Y, H:i') : '-' }}
                        @if ($berita->updated_at && $berita->updated_at != $berita->created_at)
                            <span class="d-inline-block ms-md-2 text-muted">| Terakhir diubah:
                                {{ $berita->updated_at->format('d M Y, H:i') }}</span>
                        @endif
                    </span>
                </div>

            </div>
        </div>
    </div>
@endsection
