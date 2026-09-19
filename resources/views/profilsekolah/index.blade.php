@extends('layouts.app')

@section('title', 'Profil Sekolah - Web Schools')

@section('content')
    <div class="page-header mb-4 d-flex justify-content-between align-items-center">
      <div>
        <h1 class="page-title fw-bold">Profil Sekolah</h1>
        <p class="page-subtitle text-muted">Informasi lengkap, visi misi, dan fasilitas sekolah.</p>
      </div>
      
      @auth
        @if(Auth::user()->role === 'admin')
          <div>
            <button type="button" id="btnToggleEdit" class="btn btn-primary rounded-pill px-4 shadow-sm" onclick="toggleEditMode()">
              <i class="bi bi-pencil-square me-2" id="iconEdit"></i> <span id="textBtn">Edit Profil</span>
            </button>
          </div>
        @endif
      @endauth
    </div>

    @if(session('success'))
      <div class="alert alert-success alert-dismissible fade show rounded-4" role="alert">
        <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    <form action="{{ route('profil.update') }}" method="POST" id="formProfil">
      @csrf

      <div class="row g-4 mb-5">
        
        <!-- KIRI: Visi, Misi, Sejarah -->
        <div class="col-xl-8 col-lg-7">
          <div class="card mb-4 border shadow-sm rounded-4">
            <div class="card-header bg-white pb-0 border-0 pt-4 rounded-top-4">
              <h5 class="fw-bold"><i class="bi bi-bullseye text-primary me-2"></i> Visi & Misi</h5>
            </div>
            <div class="card-body">
              <div class="view-mode">
                <h6 class="fw-bold text-primary">Visi</h6>
                <p class="text-muted">"{!! nl2br(e($profil->visi ?? 'Belum diisi')) !!}"</p>
                
                <h6 class="fw-bold text-primary mt-4">Misi</h6>
                <div class="text-muted mb-0" style="white-space: pre-line;">
                  {!! $profil->misi ?? 'Belum diisi' !!}
                </div>
              </div>

              <div class="edit-mode d-none">
                <div class="mb-3">
                  <label class="form-label fw-semibold">Visi Sekolah</label>
                  <textarea name="visi" class="form-control rounded-3" rows="2" required>{{ $profil->visi ?? '' }}</textarea>
                </div>
                <div class="mb-3">
                  <label class="form-label fw-semibold">Misi Sekolah</label>
                  <textarea name="misi" class="form-control rounded-3" rows="4" required>{{ $profil->misi ?? '' }}</textarea>
                </div>
              </div>
            </div>
          </div>

          <div class="card border shadow-sm rounded-4">
            <div class="card-header bg-white pb-0 border-0 pt-4 rounded-top-4">
              <h5 class="fw-bold"><i class="bi bi-clock-history text-success me-2"></i> Sejarah Singkat</h5>
            </div>
            <div class="card-body">
              <div class="view-mode">
                <p class="text-muted mb-0" style="text-align: justify; white-space: pre-line;">
                  {{ $profil->sejarah ?? 'Belum diisi' }}
                </p>
              </div>
              <div class="edit-mode d-none">
                <label class="form-label fw-semibold">Sejarah Singkat</label>
                <textarea name="sejarah" class="form-control rounded-3" rows="5">{{ $profil->sejarah ?? '' }}</textarea>
              </div>
            </div>
          </div>
        </div>

        <!-- KANAN: Identitas & Fasilitas -->
        <div class="col-xl-4 col-lg-5">
          <div class="card mb-4 border shadow-sm rounded-4">
            <div class="card-header bg-white pb-0 border-0 pt-4 rounded-top-4">
              <h5 class="fw-bold"><i class="bi bi-card-checklist text-warning me-2"></i> Identitas Sekolah</h5>
            </div>
            <div class="card-body">
              <ul class="list-group list-group-flush view-mode">
                <li class="list-group-item px-0 d-flex justify-content-between align-items-center">
                  <span class="text-muted">Nama Sekolah</span>
                  <span class="fw-semibold text-end">{{ $profil->nama_sekolah ?? '-' }}</span>
                </li>
                <li class="list-group-item px-0 d-flex justify-content-between align-items-center">
                  <span class="text-muted">NPSN</span>
                  <span class="fw-semibold text-end">{{ $profil->npsn ?? '-' }}</span>
                </li>
                <li class="list-group-item px-0 d-flex justify-content-between align-items-center">
                  <span class="text-muted">Tahun Berdiri</span>
                  <span class="fw-semibold text-end">{{ $profil->tahun_berdiri ?? '-' }}</span>
                </li>
                <li class="list-group-item px-0 d-flex justify-content-between align-items-center">
                  <span class="text-muted">Kepala Sekolah</span>
                  <span class="fw-semibold text-end">{{ $profil->kepala_sekolah ?? '-' }}</span>
                </li>
                <li class="list-group-item px-0 d-flex flex-column align-items-start">
                  <span class="text-muted mb-1">Alamat Lengkap</span>
                  <span class="fw-semibold small">{{ $profil->alamat ?? '-' }}</span>
                </li>
                <li class="list-group-item px-0 d-flex justify-content-between align-items-center">
                  <span class="text-muted">Email</span>
                  <span class="fw-semibold text-end">{{ $profil->email ?? '-' }}</span>
                </li>
                <li class="list-group-item px-0 d-flex justify-content-between align-items-center">
                  <span class="text-muted">Telepon</span>
                  <span class="fw-semibold text-end">{{ $profil->telepon ?? '-' }}</span>
                </li>
              </ul>

              <div class="edit-mode d-none">
                <div class="mb-3">
                  <label class="form-label small fw-semibold">Nama Sekolah</label>
                  <input type="text" name="nama_sekolah" class="form-control form-control-sm rounded-3" value="{{ $profil->nama_sekolah ?? '' }}" required>
                </div>
                <div class="mb-3">
                  <label class="form-label small fw-semibold">NPSN</label>
                  <input type="text" name="npsn" class="form-control form-control-sm rounded-3" value="{{ $profil->npsn ?? '' }}" required>
                </div>
                <div class="mb-3">
                  <label class="form-label small fw-semibold">Tahun Berdiri</label>
                  <input type="number" name="tahun_berdiri" class="form-control form-control-sm rounded-3" value="{{ $profil->tahun_berdiri ?? '' }}">
                </div>
                <div class="mb-3">
                  <label class="form-label small fw-semibold">Kepala Sekolah</label>
                  <input type="text" name="kepala_sekolah" class="form-control form-control-sm rounded-3" value="{{ $profil->kepala_sekolah ?? '' }}" required>
                </div>
                <div class="mb-3">
                  <label class="form-label small fw-semibold">Alamat</label>
                  <textarea name="alamat" class="form-control form-control-sm rounded-3" rows="2" required>{{ $profil->alamat ?? '' }}</textarea>
                </div>
                <div class="mb-3">
                  <label class="form-label small fw-semibold">Email</label>
                  <input type="email" name="email" class="form-control form-control-sm rounded-3" value="{{ $profil->email ?? '' }}">
                </div>
                <div class="mb-3">
                  <label class="form-label small fw-semibold">Telepon</label>
                  <input type="text" name="telepon" class="form-control form-control-sm rounded-3" value="{{ $profil->telepon ?? '' }}">
                </div>
              </div>
            </div>
          </div>

          <div class="card border shadow-sm rounded-4">
            <div class="card-header bg-white pb-0 border-0 pt-4 rounded-top-4">
              <h5 class="fw-bold"><i class="bi bi-building-check text-info me-2"></i> Fasilitas Utama</h5>
            </div>
            <div class="card-body">
              <div class="view-mode">
                <p class="text-muted small mb-0">{{ $profil->fasilitas ?? 'Belum diisi' }}</p>
              </div>
              <div class="edit-mode d-none">
                <textarea name="fasilitas" class="form-control rounded-3" rows="3">{{ $profil->fasilitas ?? '' }}</textarea>
              </div>
            </div>
          </div>
        </div>

      </div>

      <div id="saveContainer" class="text-center mb-5 d-none">
        <button type="submit" class="btn btn-success btn-lg rounded-pill px-5 shadow">
          <i class="bi bi-check-circle me-2"></i> Simpan Perubahan Profil
        </button>
      </div>

    </form>

    <script>
      function toggleEditMode() {
        const viewElements = document.querySelectorAll('.view-mode');
        const editElements = document.querySelectorAll('.edit-mode');
        const saveContainer = document.getElementById('saveContainer');
        const textBtn = document.getElementById('textBtn');
        const iconEdit = document.getElementById('iconEdit');
        const btnToggle = document.getElementById('btnToggleEdit');

        let isEditing = textBtn.innerText === 'Batal';

        if (isEditing) {
          viewElements.forEach(el => el.classList.remove('d-none'));
          editElements.forEach(el => el.classList.add('d-none'));
          saveContainer.classList.add('d-none');
          textBtn.innerText = 'Edit Profil';
          iconEdit.className = 'bi bi-pencil-square me-2';
          btnToggle.className = 'btn btn-primary rounded-pill px-4 shadow-sm';
        } else {
          viewElements.forEach(el => el.classList.add('d-none'));
          editElements.forEach(el => el.classList.remove('d-none'));
          saveContainer.classList.remove('d-none');
          textBtn.innerText = 'Batal';
          iconEdit.className = 'bi bi-x-circle me-2';
          btnToggle.className = 'btn btn-outline-danger rounded-pill px-4 shadow-sm';
        }
      }
    </script>
@endsection