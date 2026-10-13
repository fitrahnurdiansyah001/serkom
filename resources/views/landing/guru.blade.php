@extends('landing.layouts.layouts')

@section('title', 'Guru & Staf - ' . ($profil->nama_sekolah ?? 'SDIT Al-Hikmah'))

@section('content')
<section class="container py-5">
    <div class="d-flex justify-content-between align-items-end mb-4 pb-2 border-bottom" data-aos="fade-down">
        <div>
            <span class="fw-bold small text-uppercase" style="color: #0F8B44;">Tenaga Pengajar</span>
            <h2 class="fw-bold text-body mb-0">Guru & Staf Profesional</h2>
        </div>
    </div>
    
    <div class="row g-4">
        @forelse ($gurus as $guru)
            <div class="col-lg-3 col-md-6" data-aos="zoom-in">
                <div class="card card-modern text-center p-4 h-100 border shadow-sm">
                    <div class="mb-3 mx-auto shadow-sm"
                        style="width: 100px; height: 100px; border-radius: 50%; overflow: hidden; border: 4px solid #0F8B44;">
                        @if (isset($guru->foto) && file_exists(public_path('uploads/guru/' . $guru->foto)))
                            <img src="{{ asset('uploads/guru/' . $guru->foto) }}" class="w-100 h-100 object-fit-cover" alt="{{ $guru->nama_guru }}">
                        @else
                            <div class="w-100 h-100 d-flex align-items-center justify-content-center fs-2" style="background-color: rgba(15, 139, 68, 0.1); color: #0F8B44;">
                                <i class="bi bi-person-fill"></i>
                            </div>
                        @endif
                    </div>
                    <h5 class="fw-bold mb-1 text-body">{{ $guru->nama_guru }}</h5>
                    <span class="badge rounded-pill px-3 py-1 mb-3 fw-semibold" style="background-color: rgba(15, 139, 68, 0.1); color: #0F8B44;">
                        {{ $guru->mata_pelajaran ?? 'Pengajar' }}
                    </span>
                    <a href="{{ url('/info-guru/' . ($guru->slug ?? $guru->id)) }}" class="btn btn-sm rounded-pill mt-auto w-100 fw-semibold" style="border: 1px solid #0F8B44; color: #0F8B44;">
                        Lihat Profil
                    </a>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <div class="p-5 bg-white rounded-4 border shadow-sm">
                    <i class="bi bi-person-x display-3 text-secondary opacity-50 mb-3" style="color: #0F8B44;"></i>
                    <h4 class="fw-bold text-body">Belum Ada Data Guru</h4>
                    <p class="text-secondary mb-0">Informasi data guru dan staf akan segera diperbarui.</p>
                </div>
            </div>
        @endforelse
    </div>
</section>
@endsection