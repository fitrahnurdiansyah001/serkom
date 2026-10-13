@extends('layouts.app')

@section('title', 'Profil Saya - SDIT Al-Hikmah')

@section('content')
    <style>
        :root {
            --primary-green: #0F8B44;
            --accent-green: #0c7338;
            --light-green: #4ade80;
        }

        /* Styling Kartu Universal */
        .card-modern {
            background-color: var(--bs-card-bg, #ffffff);
            border: 1px solid var(--bs-border-color, rgba(0, 0, 0, 0.08));
            border-radius: 1.25rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
            overflow: hidden;
            transition: all 0.3s ease;
        }

        /* Styling Foto Profil */
        .profile-avatar-large {
            width: 120px;
            height: 120px;
            object-fit: cover;
            aspect-ratio: 1 / 1;
            border-radius: 50%;
            border: 4px solid var(--primary-green);
            box-shadow: 0 8px 20px rgba(15, 139, 68, 0.2);
            transition: all 0.3s ease;
            background-color: var(--bs-body-bg);
        }

        .profile-avatar-large:hover {
            transform: scale(1.05);
        }

        /* Styling Input Form Universal */
        .form-control,
        .form-select {
            background-color: var(--bs-body-bg);
            color: var(--bs-body-color);
            border: 1px solid var(--bs-border-color);
            transition: all 0.2s ease;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--primary-green);
            box-shadow: 0 0 0 0.25rem rgba(15, 139, 68, 0.25);
            background-color: var(--bs-body-bg);
            color: var(--bs-body-color);
        }

        /* Styling Tombol Tema Hijau */
        .btn-theme {
            background-color: var(--primary-green);
            border-color: var(--primary-green);
            color: #ffffff;
        }

        .btn-theme:hover {
            background-color: var(--accent-green);
            border-color: var(--accent-green);
            color: #ffffff;
            box-shadow: 0 6px 15px rgba(15, 139, 68, 0.2);
        }

        .btn-outline-theme {
            color: var(--primary-green);
            border-color: var(--primary-green);
        }

        .btn-outline-theme:hover {
            background-color: var(--primary-green);
            color: #ffffff;
        }

        /* Custom Alert Hijau Universal */
        .alert-success-custom {
            background-color: rgba(15, 139, 68, 0.1);
            border-color: rgba(15, 139, 68, 0.2);
            color: var(--primary-green);
        }


        html[data-bs-theme="dark"] .card-modern {
            background-color: #1e293b;
            border-color: #334155;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
        }

        html[data-bs-theme="dark"] .form-control,
        html[data-bs-theme="dark"] .form-select {
            background-color: #0f172a;
            border-color: #334155;
            color: #f8f9fa;
        }

        html[data-bs-theme="dark"] .form-control:focus,
        html[data-bs-theme="dark"] .form-select:focus {
            background-color: #1e293b;
        }

        html[data-bs-theme="dark"] .text-theme-title {
            color: var(--light-green) !important;
        }

        html[data-bs-theme="dark"] .input-disabled-custom {
            background-color: #0f172a !important;
            color: #94a3b8 !important;
            border-color: #334155 !important;
            opacity: 0.8;
        }

        html[data-bs-theme="dark"] .alert-success-custom {
            background-color: rgba(15, 139, 68, 0.25);
            border-color: rgba(15, 139, 68, 0.4);
            color: var(--light-green);
        }

        html[data-bs-theme="dark"] .text-muted-custom {
            color: #94a3b8 !important;
        }

        html[data-bs-theme="dark"] .btn-outline-theme {
            color: var(--light-green);
            border-color: var(--light-green);
        }

        html[data-bs-theme="dark"] .btn-outline-theme:hover {
            background-color: var(--primary-green);
            color: #fff;
            border-color: var(--primary-green);
        }
    </style>

    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card card-modern p-4 p-md-5">

                    <div class="text-center mb-4">
                        <h3 class="fw-bold text-body mb-1">Edit Profil Saya</h3>
                        <p class="text-muted text-muted-custom small">Perbarui data diri, foto profil, dan kata sandi Anda
                            dengan mudah.</p>
                    </div>

                    @if (session('success'))
                        <div class="alert alert-success-custom alert-dismissible fade show rounded-4 shadow-sm mb-4"
                            role="alert">
                            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Terjadi Kesalahan!</strong> Silakan periksa kembali isian Anda:
                            <ul class="mb-0 mt-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="text-center mb-4">
                            <div class="position-relative d-inline-block">
                                @if (Auth::user()->photo && file_exists(public_path('uploads/profiles/' . Auth::user()->photo)))
                                    <img id="previewImage" src="{{ asset('uploads/profiles/' . Auth::user()->photo) }}"
                                        alt="Foto Profil" class="profile-avatar-large">
                                @else
                                    <div class="rounded-circle d-flex align-items-center justify-content-center fw-bold me-2"
                                        style="width: 120px; height: 120px; font-size: 32px; font-weight: bold; background-color: rgba(15, 139, 68, 0.1); color: #0F8B44;">
                                        {{ strtoupper(substr( Auth::user()->name, 0, 1)) }}
                                    </div>
                                @endif
                            </div>
                            <div class="mt-3">
                                <label for="photo"
                                    class="btn btn-sm btn-outline-theme rounded-pill px-4 fw-semibold shadow-sm cursor-pointer"
                                    style="cursor: pointer;">
                                    <i class="bi bi-camera-fill me-1"></i> Ganti Foto Profil
                                </label>
                                <input type="file" name="photo" id="photo"
                                    class="d-none @error('photo') is-invalid @enderror" accept="image/*"
                                    onchange="previewFile(this)">
                                <div class="form-text text-muted-custom small mt-2">Format: JPG, PNG, JPEG (Maks. 2MB)</div>
                            </div>
                            @error('photo')
                                <small class="text-danger d-block mt-1">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Input Nama Lengkap -->
                        <div class="mb-3 text-start">
                            <label class="form-label fw-semibold small text-body">Nama Lengkap</label>
                            <input type="text" name="name"
                                class="form-control rounded-3 py-2 @error('name') is-invalid @enderror"
                                value="{{ old('name', Auth::user()->name) }}" required>
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Input Email -->
                        <div class="mb-3 text-start">
                            <label class="form-label fw-semibold small text-body">Alamat Email</label>
                            <input type="email" name="email"
                                class="form-control rounded-3 py-2 @error('email') is-invalid @enderror"
                                value="{{ old('email', Auth::user()->email) }}" required>
                            @error('email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Hak Akses (Role) -->
                        <div class="mb-4 text-start">
                            <label class="form-label fw-semibold small text-body">Hak Akses (Role Sistem)</label>
                            <input type="text"
                                class="form-control input-disabled-custom rounded-3 py-2 text-capitalize bg-light text-muted"
                                value="{{ Auth::user()->role ?? 'User' }}" disabled>
                        </div>

                        <hr class="my-4 opacity-10">

                        <div class="text-start mb-3">
                            <h6 class="fw-bold mb-1 text-theme-title" style="color: var(--primary-green);">Ubah Kata Sandi
                            </h6>
                            <p class="small text-muted text-muted-custom mb-3">Biarkan kosong jika Anda tidak ingin
                                mengganti kata sandi saat ini.</p>
                        </div>

                        <div class="mb-3 text-start">
                            <label class="form-label fw-semibold small text-body">Kata Sandi Baru</label>
                            <input type="password" name="password"
                                class="form-control rounded-3 py-2 @error('password') is-invalid @enderror"
                                placeholder="Minimal 8 karakter">
                            @error('password')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-4 text-start">
                            <label class="form-label fw-semibold small text-body">Konfirmasi Kata Sandi Baru</label>
                            <input type="password" name="password_confirmation" class="form-control rounded-3 py-2"
                                placeholder="Ulangi kata sandi baru">
                        </div>

                        <button type="submit" class="btn btn-theme w-100 py-2.5 rounded-pill fw-semibold transition">
                            <i class="bi bi-save-fill me-1"></i> Simpan Perubahan
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <script>
        function previewFile(input) {
            const file = input.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('previewImage').src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        }
    </script>
@endsection
