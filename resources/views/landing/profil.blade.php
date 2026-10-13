@extends('landing.layouts.layouts')

@section('title','profil - SDIT Al-Hikmah')

@section('content')
    <div class="container mt-5 pt-4 pb-5">
        <div class="row justify-content-center mb-5">
            <div class="col-lg-8">

                <div class="card-modern p-4 p-md-5 text-center bg-white border shadow-sm">

                    <div class="mb-4 d-flex justify-content-center">
                            <img src="{{ asset('assets/images/download (9).jpg') }}" alt=""
                                class="profile-img-large"
                                style="width: 170px; height: 170px; object-fit: cover; aspect-ratio: 1 / 1; border-radius: 50%; border: 5px solid #0F8B44; box-shadow: 0 10px 25px rgba(15, 139, 68, 0.25);">
                    </div>

                    <h2 class="fw-bold text-body mb-2">FITRAH NURDIANSYAH</h2>

                    <hr class="my-4 opacity-10">

                    <div class="row text-start g-3 px-md-3">

                        <div class="col-12">
                            <div class="info-box p-3 bg-body-tertiary border rounded-3">
                                <small class="text-secondary d-block mb-1 font-monospace" style="font-size: 0.8rem;">
                                    <i class="bi bi-briefcase me-1" style="color: #0F8B44;"></i> ALAMAT
                                </small>
                                <span
                                    class="fw-bold text-body fs-6">MANGUNREJA KAB.TASIKAMALAYA</span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="info-box p-3.5 h-100 p-3 bg-body-tertiary border rounded-3">
                                <small class="text-secondary d-block mb-1 font-monospace" style="font-size: 0.8rem;">
                                    <i class="bi bi-card-text me-1" style="color: #0F8B44;"></i>NISN
                                </small>
                                <span class="fw-bold text-body fs-6">008228915</span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="info-box p-3.5 h-100 p-3 bg-body-tertiary border rounded-3">
                                <small class="text-secondary d-block mb-1 font-monospace" style="font-size: 0.8rem;">
                                    <i class="bi bi-book me-1" style="color: #0F8B44;"></i> EMAIL
                                </small>
                                <span class="fw-bold text-body fs-6">FITRAHNURDIASNYAH001@GMAIL.COM</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
