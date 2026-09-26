@extends('layouts.app')

@section('title', 'Profil Saya - Web Schools')

@section('content')
    <div class="container-fluid py-4">
      <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
          <div class="card shadow-sm border rounded-4">
            <div class="card-header bg-white border-bottom-0 pt-4 pb-0 rounded-top-4">
              <h4 class="card-title fw-bold">Edit Profil Saya</h4>
              <p class="text-muted small">Perbarui data diri, foto profil, dan kata sandi Anda di sini.</p>
            </div>
            <div class="card-body">

              <!-- Notifikasi Sukses -->
              @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show rounded-3" role="alert">
                  <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              @endif

              <!-- Tambahkan enctype agar form bisa upload file -->
              <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Bagian Preview & Upload Foto -->
                <div class="text-center mb-4">
                  <div class="position-relative d-inline-block">
                    @if(Auth::user()->photo && file_exists(public_path('uploads/profiles/' . Auth::user()->photo)))
                      <img src="{{ asset('uploads/profiles/' . Auth::user()->photo) }}" alt="Foto Profil" class="rounded-circle shadow-sm border" width="100" height="100" style="object-fit: cover;">
                    @else
                      <img src="{{ asset('assets/images/avatar.jpg') }}" alt="Default Avatar" class="rounded-circle shadow-sm border" width="100" height="100" style="object-fit: cover;">
                    @endif
                  </div>
                  <div class="mt-2">
                    <label for="photo" class="btn btn-sm btn-outline-primary rounded-pill px-3">
                      <i class="bi bi-camera me-1"></i> Ganti Foto
                    </label>
                    <input type="file" name="photo" id="photo" class="d-none @error('photo') is-invalid @enderror" accept="image/*">
                    <div class="form-text small">Format: JPG, PNG, JPEG (Maks. 2MB)</div>
                  </div>
                  @error('photo') <small class="text-danger d-block mt-1">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3">
                  <label class="form-label fw-semibold">Nama Lengkap</label>
                  <input type="text" name="name" class="form-control rounded-3 @error('name') is-invalid @enderror" value="{{ old('name', Auth::user()->name) }}" required>
                  @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3">
                  <label class="form-label fw-semibold">Alamat Email</label>
                  <input type="email" name="email" class="form-control rounded-3 @error('email') is-invalid @enderror" value="{{ old('email', Auth::user()->email) }}" required>
                  @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3">
                  <label class="form-label fw-semibold">Hak Akses (Role)</label>
                  <input type="text" class="form-control rounded-3 text-capitalize bg-light" value="{{ Auth::user()->role }}" disabled>
                </div>

                <hr class="my-4">
                <h6 class="fw-bold mb-2">Ubah Kata Sandi (Opsional)</h6>
                <p class="small text-muted mb-3">Biarkan kosong jika Anda tidak ingin mengubah kata sandi.</p>

                <div class="mb-3">
                  <label class="form-label fw-semibold">Kata Sandi Baru</label>
                  <input type="password" name="password" class="form-control rounded-3 @error('password') is-invalid @enderror" placeholder="Minimal 8 karakter">
                  @error('password') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-4">
                  <label class="form-label fw-semibold">Konfirmasi Kata Sandi Baru</label>
                  <input type="password" name="password_confirmation" class="form-control rounded-3" placeholder="Ulangi kata sandi baru">
                </div>

                <button type="submit" class="btn btn-primary w-100 py-2 rounded-pill fw-semibold shadow-sm">Simpan Perubahan</button>
              </form>

            </div>
          </div>
        </div>
      </div>
    </div>
@endsection