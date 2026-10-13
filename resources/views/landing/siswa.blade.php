@extends('landing.layouts.layouts')

@section('title', 'siswa- ' . ($profil->nama_sekolah ?? 'SDIT Al-Hikmah'))
@section('content')
    <div class="container mt-5">
        <h2 class="text-center mb-4">Daftar Siswa & Kelas</h2>
        @php
            $profil = \App\Models\ProfilSekolah::first();
            $kelas = \App\Models\kelas::all();
        @endphp

        <div class="row">
            @forelse ($siswas as $siswa)
                <div class="col-lg-4 col-md-6" data-aos="fade-up">
                    <div class="card card-modern p-4 h-100 border shadow-sm bg-white d-flex flex-column text-center">
                        <div class="mb-3 mx-auto d-flex align-items-center justify-content-center"
                            style="width: 80px; height: 80px; border-radius: 50%; background-color: rgba(15, 139, 68, 0.1); color: #0F8B44;">
                            <i class="bi bi-person-fill" style="font-size: 40px;"></i>
                        </div>

                        <h4 class="fw-bold text-body mb-2">{{ $siswa->nama_siswa ?? $siswa->nama }}</h4>

                        <small class="fw-bold">NISN: {{ $siswa->nisn }}</small>


                        <div class="mt-4 pt-3 border-top">
                            <span class="badge rounded-pill px-3 py-2 fw-semibold"
                                style="background-color: rgba(15, 139, 68, 0.1); color: #0F8B44;">
                                <i class="bi bi-check-circle-fill me-1"></i> Kelas: {{ $siswa->kelas ? $siswa->kelas->kode_kelas : 'Belum masuk kelas' }}</span>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center text-muted">
                    <p>Belum ada data siswa yang terdaftar.</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection
