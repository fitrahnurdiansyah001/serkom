@extends('landing.layouts')

@section('title', ($ekskul->nama_ekskul ?? $ekskul->nama) . ' - SDIT Al-Hikmah')

@section('content')
<div class="container mt-5 pt-4 pb-5">
    <div class="row justify-content-center">
        <div class="col-lg-8" data-aos="fade-up">
            
            <!-- Tombol Kembali -->
            <div class="mb-4">
                <a href="{{ url('/info-ekskul') }}" class="btn rounded-pill px-4 fw-semibold btn-sm shadow-sm" style="border: 1px solid #0F8B44; color: #0F8B44;">
                    <i class="bi bi-arrow-left me-2"></i> Kembali ke Daftar Ekstrakurikuler
                </a>
            </div>

            <!-- Kartu Detail Ekskul -->
            <div class="card card-modern p-4 p-md-5 border shadow-sm bg-white">
                <div class="d-flex align-items-center gap-3 mb-4">
                    <div class="rounded-circle p-3 d-flex align-items-center justify-content-center shadow-sm" style="width: 60px; height: 60px; background-color: rgba(15, 139, 68, 0.1); color: #0F8B44;">
                        <i class="bi bi-award-fill fs-3"></i>
                    </div>
                    <div>
                        <span class="badge rounded-pill px-3 py-1 fw-semibold mb-1" style="background-color: rgba(15, 139, 68, 0.1); color: #0F8B44;">
                            Kegiatan Ekstrakurikuler
                        </span>
                        @if(isset($ekskul->pembina) || isset($ekskul->guru_pembina))
                        <small class="text-secondary d-block">
                            <i class="bi bi-person-badge me-1" style="color: #0F8B44;"></i> Pembina: {{ $ekskul->pembina ?? $ekskul->guru_pembina }}
                        </small>
                        @endif
                    </div>
                </div>

                <h1 class="fw-bold text-body mb-4">{{ $ekskul->nama_ekskul ?? $ekskul->nama }}</h1>

                <!-- BAGIAN MENAMPILKAN FOTO / GAMBAR -->
                @php
                    $fotoEkskul = $ekskul->foto ?? ($ekskul->gambar ?? ($ekskul->file ?? ($ekskul->image ?? ($ekskul->logo ?? null))));
                @endphp

                @if ($fotoEkskul && file_exists(public_path('uploads/ekstrakurikuler/' . $fotoEkskul)))
                    <div class="mb-4 text-center">
                        <img src="{{ asset('uploads/ekstrakurikuler/' . $fotoEkskul) }}" alt="Foto Ekstrakurikuler"
                            class="img-fluid rounded-4 shadow-sm w-100 object-fit-cover border" style="max-height: 420px;">
                    </div>
                @else
                    <!-- Placeholder jika foto tidak ada di database atau folder -->
                    <div class="bg-body-tertiary text-center py-5 rounded-4 mb-4 text-secondary border d-flex flex-column align-items-center justify-content-center"
                        style="height: 220px;">
                        <i class="bi bi-image fs-1 opacity-50 mb-2" style="color: #0F8B44;"></i>
                        <span class="small fw-semibold">Tidak ada dokumentasi foto untuk ekstrakurikuler ini</span>
                    </div>
                @endif

                @if(isset($ekskul->jadwal) || isset($ekskul->hari))
                <div class="p-3 bg-body-tertiary rounded-3 mb-4 border d-flex align-items-center gap-2">
                    <i class="bi bi-calendar-event-fill fs-4" style="color: #0F8B44;"></i>
                    <div>
                        <small class="text-secondary d-block">Jadwal Latihan:</small>
                        <strong class="text-body">{{ $ekskul->jadwal ?? $ekskul->hari }}</strong>
                    </div>
                </div>
                @endif

                <div class="fs-5 text-secondary" style="line-height: 1.8;">
                    {!! nl2br(e($ekskul->deskripsi ?? 'Tidak ada keterangan tambahan.')) !!}
                </div>
            </div>

        </div>
    </div>
</div>
@endsection