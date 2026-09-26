@extends('layouts.app')

@section('title', 'Data Users - Web Schools')

@section('content')
    <div class="page-header mb-4 d-flex justify-content-between align-items-center">
      <div>
        <h1 class="page-title fw-bold">Manajemen Data Users</h1>
        <p class="page-subtitle text-muted">Daftar akun administrator dan operator yang memiliki akses ke sistem.</p>
      </div>
    </div>

    @if(session('success'))
      <div class="alert alert-success alert-dismissible fade show rounded-4" role="alert">
        <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    @if(session('error'))
      <div class="alert alert-danger alert-dismissible fade show rounded-4" role="alert">
        <i class="bi bi-exclamation-triangle me-2"></i> {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    <!-- Tabel Data Users -->
    <div class="card border shadow-sm rounded-4 overflow-hidden mb-5">
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
              <tr>
                <th class="py-3 px-4">No</th>
                <th class="py-3">Avatar</th>
                <th class="py-3">Nama Pengguna</th>
                <th class="py-3">Email</th>
                <th class="py-3">Hak Akses (Role)</th>
                <th class="py-3">Status</th>
                @auth
                  @if(Auth::user()->role === 'admin')
                    <th class="py-3 text-center" style="width: 150px;">Aksi</th>
                  @endif
                @endauth
              </tr>
            </thead>
            <tbody>
              @forelse($users as $index => $usr)
                <tr>
                  <td class="px-4 text-muted">{{ $index + 1 }}</td>
                  <td>
                    @if($usr->photo && file_exists(public_path('uploads/profiles/' . $usr->photo)))
                      <img src="{{ asset('uploads/profiles/' . $usr->photo) }}" class="rounded-circle border object-fit-cover" width="40" height="40" alt="Avatar">
                    @else
                      <img src="{{ asset('assets/images/avatar.jpg') }}" class="rounded-circle border object-fit-cover" width="40" height="40" alt="Default Avatar">
                    @endif
                  </td>
                  <td><span class="fw-bold text-dark">{{ $usr->name }}</span></td>
                  <td><span class="text-muted">{{ $usr->email }}</span></td>
                  <td>
                    <span class="badge {{ strtolower($usr->role) == 'admin' ? 'bg-primary bg-opacity-10 text-primary' : 'bg-warning bg-opacity-10 text-dark' }} px-3 py-1 rounded-pill text-capitalize">
                      {{ $usr->role }}
                    </span>
                  </td>
                  <td>
                    <span class="badge {{ strtolower($usr->status) == 'active' ? 'bg-primary bg-opacity-10 text-primary' : 'bg-warning bg-opacity-10 text-dark' }} px-3 py-1 rounded-pill text-capitalize">
                      {{ $usr->status }}
                    </span>
                  </td>
                  
                  @auth
                    @if(Auth::user()->role === 'admin')
                      <td class="text-center">
                        <div class="d-flex justify-content-center gap-2">
                          <!-- Tombol Edit -->
                          <button type="button" class="btn btn-sm btn-outline-warning rounded-circle" data-bs-toggle="modal" data-bs-target="#modalEditUser{{ $usr->id }}" title="Edit">
                            <i class="bi bi-pencil"></i>
                          </button>
                          <!-- Tombol Hapus -->
                          <form action="{{ route('users.destroy', $usr->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus akun pengguna ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger rounded-circle" title="Hapus">
                              <i class="bi bi-trash"></i>
                            </button>
                          </form>
                        </div>
                      </td>
                    @endif
                  @endauth
                </tr>

                <!-- MODAL EDIT USER -->
                @auth
                  @if(Auth::user()->role === 'admin')
                    <div class="modal fade" id="modalEditUser{{ $usr->id }}" tabindex="-1" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content rounded-4 border-0 shadow">
                          <div class="modal-header border-bottom-0 pt-4 px-4">
                            <h5 class="modal-title fw-bold">Edit Akun Pengguna</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body px-4 pb-4">
                            <form action="{{ route('users.update', $usr->id) }}" method="POST">
                              @csrf
                              <div class="mb-3">
                                <label class="form-label fw-semibold">Nama Lengkap</label>
                                <input type="text" name="name" class="form-control rounded-3" value="{{ $usr->name }}" required>
                              </div>
                              <div class="mb-3">
                                <label class="form-label fw-semibold">Alamat Email</label>
                                <input type="email" name="email" class="form-control rounded-3" value="{{ $usr->email }}" required>
                              </div>
                              <div class="mb-3">
                                <label class="form-label fw-semibold">Hak Akses (Role)</label>
                                <select name="role" class="form-select rounded-3 text-capitalize" required>
                                  <option value="Admin" {{ strtolower($usr->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                                  <option value="Operator" {{ strtolower($usr->role) == 'operator' ? 'selected' : '' }}>Operator</option>
                                </select>
                              </div>
                              <div class="mb-3">
                                <label class="form-label fw-semibold">Status</label>
                                <select name="status" class="form-select rounded-3 text-capitalize" required>
                                  <option value="active" {{ strtolower($usr->status) == 'active' ? 'selected' : '' }}>active</option>
                                  <option value="non active" {{ strtolower($usr->status) == 'non active' ? 'selected' : '' }}>non active</option>
                                </select>
                              </div>
                              <button type="submit" class="btn btn-primary w-100 rounded-pill py-2 shadow-sm">Simpan Perubahan</button>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  @endif
                @endauth

              @empty
                <tr>
                  <td colspan="6" class="text-center py-5 text-muted">
                    <i class="bi bi-person-slash display-4 opacity-50 d-block mb-2"></i> Belum ada data pengguna terdaftar.
                  </td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
@endsection