@extends('landing.layouts.layouts')

@section('title', 'Galeri - Web Schools')
@section('content')
    @if (isset($galeris) && $galeris->count() > 0)
        <section class="container py-5 mb-5">
            <div class="text-center mb-5" data-aos="fade-down">
                <span class="text-primary fw-bold small text-uppercase">Dokumentasi Visual</span>
                <h2 class="fw-bold text-dark">Galeri Kegiatan Sekolah</h2>
            </div>
            <div class="row g-4">
                @foreach ($galeris as $galeri)
                    <div class="col-lg-4 col-md-6" data-aos="zoom-in">
                        <a href="{{ url('/info-galeri', $galeri->slug) }}" class="text-decoration-none">
                            <div class="card card-modern overflow-hidden h-100 border shadow-sm position-relative">
                                
                                @if (isset($galeri->file) && file_exists(public_path('uploads/galeri/' . $galeri->file)))
                                    
                        
                                    @if ($galeri->kategori == 'Video')
                        
                                        <div class="position-relative w-100 h-100 bg-dark">
                                            <video class="gallery-img w-100" style="object-fit: cover; height: 240px; opacity: 0.8;" muted>
                                                <source src="{{ asset('uploads/galeri/' . $galeri->file) }}" type="video/mp4">
                                            </video>
                            
                                            <div class="position-absolute top-50 start-50 translate-middle text-white" style="z-index: 2;">
                                                <i class="bi bi-play-circle-fill display-2 drop-shadow"></i>
                                            </div>
                                        </div>
                                    @else
                                        <img src="{{ asset('uploads/galeri/' . $galeri->file) }}"
                                            alt="{{ $galeri->judul ?? 'Galeri' }}" class="gallery-img w-100" style="object-fit: cover; height: 240px;">
                                    @endif

                                @else
                                    <div class="text-center p-5 bg-light text-primary opacity-50"
                                        style="height: 240px; display: flex; align-items: center; justify-content: center;">
                                        <i class="bi bi-image display-3"></i>
                                    </div>
                                @endif

                                @if (isset($galeri->judul) || isset($galeri->keterangan))
                                    <div
                                        class="position-absolute bottom-0 start-0 w-100 p-3 text-white bg-dark bg-opacity-75 backdrop-blur" style="z-index: 3;">
                                        <h6 class="fw-bold mb-0 text-center">{{ $galeri->judul ?? $galeri->keterangan }}
                                        </h6>
                                    </div>
                                @endif
                                
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </section>
    @endif
@endsection