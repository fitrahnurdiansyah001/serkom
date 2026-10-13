@extends('landing.layouts.layouts')

@section('title', ($prestasi->nama_prestasi ?? $prestasi->judul) . ' - SDIT Al-Hikmah')

@section('content')
    <div class="container mt-5 pt-4 pb-5">
        <div class="row justify-content-center">
            <div class="col-lg-8" data-aos="fade-up">

                <div class="mb-4">
                    <a href="{{ url('/info-prestasi') }}" class="btn rounded-pill px-4 fw-semibold btn-sm shadow-sm" style="border: 1px solid #0F8B44; color: #0F8B44;">
                        <i class="bi bi-arrow-left me-2"></i> Kembali ke Daftar Prestasi
                    </a>
                </div>

                <div class="card card-modern p-4 p-md-5 border shadow-sm bg-white">
                    <div class="d-flex align-items-center gap-3 mb-4">
                        <div class="bg-warning text-white rounded-circle p-3 d-flex align-items-center justify-content-center shadow-sm"
                            style="width: 60px; height: 60px;">
                            <i class="bi bi-trophy-fill fs-3"></i>
                        </div>
                        <div>
                            @if(!empty($prestasi->tingkat))
                                <span class="badge rounded-pill px-3 py-2 fw-semibold mb-1" style="background-color: rgba(15, 139, 68, 0.1); color: #0F8B44;">
                                    {{ $prestasi->tingkat }}
                                </span>
                            @endif
                            <small class="text-secondary d-block">
                                <i class="bi bi-calendar3 me-1" style="color: #0F8B44;"></i>
                                {{ $prestasi->tahun ?? (isset($prestasi->tanggal) ? \Carbon\Carbon::parse($prestasi->tanggal)->format('d F Y') : '-') }}
                            </small>
                        </div>
                    </div>

                    <h1 class="fw-bold text-body mb-3">{{ $prestasi->nama_prestasi ?? $prestasi->judul }}</h1>

                    @if (isset($prestasi->pemenang) || isset($prestasi->nama_siswa))
                        <div class="p-3 bg-body-tertiary rounded-3 mb-4 border d-flex align-items-center gap-2">
                            <i class="bi bi-person-badge-fill fs-4" style="color: #0F8B44;"></i>
                            <div>
                                <small class="text-secondary d-block">Peraih / Pemenang:</small>
                                <strong class="text-body">{{ $prestasi->pemenang ?? $prestasi->nama_siswa }}</strong>
                            </div>
                        </div>
                    @endif

                    <!-- FOTO PRESTASI -->
                    @php
                        $fotoPrestasi = $prestasi->foto ?? ($prestasi->gambar ?? ($prestasi->file ?? null));
                    @endphp

                    @if ($fotoPrestasi && file_exists(public_path('uploads/prestasi/' . $fotoPrestasi)))
                        <div class="mb-4 text-center">
                            <img src="{{ asset('uploads/prestasi/' . $fotoPrestasi) }}" alt="Foto Prestasi"
                                class="img-fluid rounded-4 shadow-sm w-100 object-fit-cover border" style="max-height: 420px;">
                        </div>
                    @else
                        <div class="bg-body-tertiary text-center py-5 rounded-4 mb-4 text-secondary border d-flex flex-column align-items-center justify-content-center"
                            style="height: 220px;">
                            <i class="bi bi-trophy fs-1 opacity-50 mb-2" style="color: #0F8B44;"></i>
                            <span class="small fw-semibold">Tidak ada dokumentasi foto untuk prestasi ini</span>
                        </div>
                    @endif

                    <div class="fs-5 text-secondary" style="line-height: 1.8;">
                        {!! nl2br(e($prestasi->keterangan ?? ($prestasi->deskripsi ?? 'Tidak ada keterangan tambahan.'))) !!}
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection