@extends('layouts.app')

@section('title', 'Data Pengguna - SDIT Al-Hikmah')

@section('content')
    <style>
        .card-modern {
            background-color: var(--bs-body-bg);
            border: 1px solid var(--bs-border-color, rgba(0, 0, 0, 0.08));
            border-radius: 1rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.03), 0 2px 4px -1px rgba(0, 0, 0, 0.02);
            overflow: hidden;
            transition: all 0.2s ease-in-out;
        }

        .form-control,
        .form-select {
            background-color: var(--bs-body-bg);
            color: var(--bs-body-color);
        }

        html[data-bs-theme="dark"] .modal-content {
            background-color: #1e293b !important;
            color: #f8f9fa !important;
            border: 1px solid rgba(255, 255, 255, 0.08) !important;
        }

        html[data-bs-theme="dark"] .form-control,
        html[data-bs-theme="dark"] .form-select {
            background-color: #0f172a !important;
            border-color: #334155 !important;
            color: #f8f9fa !important;
        }
    </style>

    <!-- BANNER UTAMA -->
    <div class="card border-0 text-white mb-4 shadow-sm"
        style="background: linear-gradient(135deg, #0F8B44 0%, #0c7338 100%); border-radius: 1rem;">
        <div class="card-body p-4 p-md-5 d-flex flex-column flex-md-row justify-content-between align-items-md-center">
            <div>
                <h3 class="fw-bold mb-1 text-white">Manajemen Data Pengguna</h3>
                <p class="mb-0 text-white-50 fs-6">Kelola akun administrator, staf, hak akses (role), serta status akun
                    portal.</p>
            </div>

            <div class="mt-3 mt-md-0">
                <button type="button"
                    class="btn btn-light px-4 py-2 fw-semibold shadow-sm rounded-pill d-flex align-items-center"
                    style="color: #0F8B44;" data-bs-toggle="modal" data-bs-target="#modalTambahUser">
                    <i class="bi bi-person-plus-fill me-2"></i> Tambah Pengguna Baru
                </button>
            </div>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-4 shadow-sm mb-4" role="alert">
            <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show rounded-4 shadow-sm mb-4" role="alert">
            <i class="bi bi-exclamation-triangle me-2"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- TABEL DATA USERS DALAM KARTU MODERN -->
    <div class="card-modern mb-5">
        <div class="p-4 text-white d-flex justify-content-between align-items-center" style="background-color: #0F8B44;">
            <h6 class="fw-bold mb-0"><i class="bi bi-shield-lock-fill me-2"></i> Tabel Akun Pengguna</h6>
            <span class="badge bg-white fw-bold px-3 py-1 rounded-pill" style="color: #0F8B44;">Total:
                {{ count($users ?? []) }} Akun</span>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-body-tertiary">
                        <tr>
                            <th class="py-3 px-4 text-body-secondary fw-semibold" style="width: 70px;">No</th>
                            <th class="py-3 text-body-secondary fw-semibold" style="width: 80px;">Avatar</th>
                            <th class="py-3 text-body-secondary fw-semibold">Nama Pengguna</th>
                            <th class="py-3 text-body-secondary fw-semibold">Username</th>
                            <th class="py-3 text-body-secondary fw-semibold">Email</th>
                            <th class="py-3 text-body-secondary fw-semibold">Hak Akses (Role)</th>
                            <th class="py-3 text-body-secondary fw-semibold">Status</th>
                            <th class="py-3 text-center text-body-secondary fw-semibold" style="width: 150px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="border-top-0">
                        @forelse($users ?? [] as $index => $usr)
                            <tr>
                                <td class="px-4 text-body-secondary">{{ $index + 1 }}</td>
                                <td>
                                    @if (Auth::user()->photo && file_exists(public_path('uploads/profiles/' . Auth::user()->photo)))
                                        <img id="previewImage" src="{{ asset('uploads/profiles/' . Auth::user()->photo) }}"
                                            alt="Foto Profil" class="rounded-circle border object-fit-cover shadow-sm" width="40"
                                            height="40" alt="Avatar">
                                    @else
                                    <div class="rounded-circle d-flex align-items-center justify-content-center fw-bold me-2"
                                            style="width: 35px; height: 35px; font-size: 0.85rem; background-color: rgba(15, 139, 68, 0.1); color: #0F8B44;">
                                            {{ strtoupper(substr($usr->name, 0, 1)) }}
                                        </div>
                                    @endif
                                </td>
                                <td><span class="fw-bold text-body">{{ $usr->name }}</span></td>
                                <td><span class="fw-bold text-body">{{ $usr->username }}</span></td>
                                <td><span class="text-secondary">{{ $usr->email }}</span></td>
                                <td>
                                    <span
                                        class="badge {{ strtolower($usr->role) == 'admin' ? 'bg-success bg-opacity-10 text-success' : 'bg-secondary bg-opacity-10 text-secondary' }} px-3 py-1 rounded-pill text-capitalize"
                                        style="{{ strtolower($usr->role) == 'admin' ? 'background-color: rgba(15, 139, 68, 0.1) !important; color: #0F8B44 !important;' : '' }}">
                                        {{ $usr->role }}
                                    </span>
                                </td>
                                <td>
                                    <span
                                        class="badge {{ strtolower($usr->status ?? 'active') == 'active' ? 'bg-success bg-opacity-10 text-success' : 'bg-warning bg-opacity-10 text-warning' }} px-3 py-1 rounded-pill text-capitalize">
                                        {{ $usr->status ?? 'Active' }}
                                    </span>
                                </td>

                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <!-- Tombol Edit Modal -->
                                        <button type="button" class="btn btn-sm rounded-pill px-3 fw-medium"
                                            style="border: 1px solid #0F8B44; color: #0F8B44;" data-bs-toggle="modal"
                                            data-bs-target="#modalEditUser{{ $usr->id }}" title="Edit">
                                            <i class="bi bi-pencil me-1"></i> Edit
                                        </button>
                                        <!-- Tombol Hapus -->
                                        <form action="{{ route('users.destroy', $usr->id) }}" method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus akun pengguna ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="btn btn-sm btn-outline-danger rounded-pill px-3 fw-medium"
                                                title="Hapus">
                                                <i class="bi bi-trash me-1"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>

                            </tr>

                            <!-- EDIT USER -->
                            <div class="modal fade" id="modalEditUser{{ $usr->id }}" tabindex="-1"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content rounded-4 border-0 shadow bg-body">
                                        <div class="modal-header text-white pt-4 px-4" style="background-color: #0F8B44;">
                                            <h5 class="modal-title fw-bold">Edit Akun Pengguna</h5>
                                            <button type="button" class="btn-close btn-close-white"
                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body p-4 text-start">
                                            <form action="{{ route('users.update', $usr->id) }}" method="POST">
                                                @csrf
                                                <div class="mb-3">
                                                    <label class="form-label fw-semibold small">Nama Lengkap</label>
                                                    <input type="text" name="name" class="form-control rounded-3"
                                                        value="{{ $usr->name }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label fw-semibold small">Nama Lengkap</label>
                                                    <input type="text" name="name" class="form-control rounded-3"
                                                        value="{{ $usr->username }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label fw-semibold small">Email</label>
                                                    <input type="email" name="email" class="form-control rounded-3"
                                                        value="{{ $usr->email }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label fw-semibold small">Hak Akses (Role)</label>
                                                    <select name="role" class="form-select rounded-3" required>
                                                        <option value="admin"
                                                            {{ strtolower($usr->role) == 'admin' ? 'selected' : '' }}>Admin
                                                        </option>
                                                        <option value="operator"
                                                            {{ strtolower($usr->role) == 'operator' ? 'selected' : '' }}>
                                                            Operator</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label fw-semibold small">Status Akun</label>
                                                    <select name="status" class="form-select rounded-3" required>
                                                        <option value="active"
                                                            {{ strtolower($usr->status ?? '') == 'active' ? 'selected' : '' }}>
                                                            Active</option>
                                                        <option value="non active"
                                                            {{ strtolower($usr->status ?? '') == 'non active' ? 'selected' : '' }}>
                                                            Non Active</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label fw-semibold small">Password Baru
                                                        (Opsional)</label>
                                                    <input type="password" name="password" class="form-control rounded-3"
                                                        placeholder="Kosongkan jika tidak diubah">
                                                </div>
                                                <button type="submit"
                                                    class="btn text-white w-100 py-2 rounded-pill fw-semibold shadow-sm"
                                                    style="background-color: #0F8B44;">Simpan
                                                    Perubahan</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-5 text-secondary">
                                    <div class="d-flex flex-column align-items-center">
                                        <i class="bi bi-shield-lock display-4 opacity-50 mb-2"></i>
                                        <h6 class="fw-bold text-body">Belum ada data pengguna.</h6>
                                        <p class="small mb-0">Silakan tambahkan akun pengguna melalui tombol di atas.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- MODAL TAMBAH PENGGUNA BARU -->
    <div class="modal fade" id="modalTambahUser" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4 border-0 shadow bg-body">
                <div class="modal-header text-white pt-4 px-4" style="background-color: #0F8B44;">
                    <h5 class="modal-title fw-bold">Buat Akun Pengguna Baru</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body p-4 text-start">
                    <form action="{{ route('users.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label fw-semibold small">Nama Lengkap</label>
                            <input type="text" name="name" class="form-control rounded-3"
                                placeholder="Nama lengkap..." required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold small">Username</label>
                            <input type="text" name="username" class="form-control rounded-3"
                                placeholder="Usernamep..." required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold small">Alamat Email</label>
                            <input type="email" name="email" class="form-control rounded-3"
                                placeholder="email@sekolah.sch.id" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold small">Hak Akses (Role)</label>
                            <select name="role" class="form-select rounded-3" required>
                                <option value="admin">Admin</option>
                                <option value="operator">Operator</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold small">Password Akun</label>
                            <input type="password" name="password" class="form-control rounded-3"
                                placeholder="Minimal 6 karakter..." required>
                        </div>
                        <button type="submit" class="btn text-white w-100 py-2 rounded-pill fw-semibold shadow-sm"
                            style="background-color: #0F8B44;">Buat
                            Akun Baru</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
