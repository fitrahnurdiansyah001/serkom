@extends('landing.layouts')

@section('title', 'Pengumuman - Web Schools')
@section('content')
    <section class="container py-5">
        <div class="d-flex justify-content-between align-items-end mb-4 pb-2 border-bottom" data-aos="fade-down">
            <div>
                <span class="text-primary fw-bold small text-uppercase">Informasi Sekolah</span>
                <h2 class="fw-bold text-dark mb-0">Pengumuman</h2>
            </div>
        </div>
        <div class="row g-4">
            @forelse($pengumumans as $pengumuman)
                <div class="col-lg-4 col-md-6" data-aos="fade-up">
                    <div class="card card-modern h-100 border shadow-sm overflow-hidden">
                        <div class="position-relative">
                            @if (!empty($item->foto) && file_exists(public_path('uploads/pengumuman/' . $item->foto)))
                                <img src="{{ asset('uploads/pengumuman/' . $pengumuman->foto) }}"
                                    class="card-img-top object-fit-cover" style="height: 220px;" alt="Berita">
                                    alt="{{ $item->judul }}">
                            @endif
                        </div>
                        <div class="card-body p-4 d-flex flex-column">
                            <small class="text-muted mb-2"><i class="bi bi-calendar3 me-1"></i>
                                {{ \Carbon\Carbon::parse($pengumuman->tanggal)->format('d M Y') }}</small>
                            <h5 class="fw-bold mb-3 text-dark">{{ $pengumuman->judul }}</h5>
                            <p class="text-muted small flex-grow-1">{{ Str::limit($pengumuman->isi, 85) }}</p>
                            <a href="{{ url('/info-pengumuman/' . $pengumuman->slug) }}"
                                class="btn btn-primary btn-sm btn-rounded w-100 mt-auto">Baca Selengkapnya</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-4 text-muted">
                    <p>Belum ada pengumuman yang tersedia.</p>
                </div>
            @endforelse
        </div>
    </section>
@endsection
