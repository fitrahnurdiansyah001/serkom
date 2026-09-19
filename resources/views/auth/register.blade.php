<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - Web Schools</title>

    <link rel="icon" type="image/png" href="{{ asset('assets/images/favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
</head>
<body>

    <div class="login-wrapper py-5">
        <div class="login-bg-shape login-bg-shape-1"></div>
        <div class="login-bg-shape login-bg-shape-2"></div>

        <div class="login-card">

            <a href="/" class="login-brand text-decoration-none">
                <i class="bi bi-building-fill text-lime"></i>
                <span>WEB SCHOOLS</span>
            </a>

            <p class="login-subtitle">Buat akun pengguna baru sistem sekolah</p>

            <!-- Form Register -->
            <form action="{{ route('register') }}" method="POST" id="registerForm">
                @csrf

                <!-- Nama Lengkap -->
                <div class="login-form-group mb-3">
                    <label for="name" class="login-form-label">Nama Lengkap</label>
                    <div class="login-input-group">
                        <i class="bi bi-person input-icon"></i>
                        <input type="text" name="name" id="name" class="login-input @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Nama Lengkap" required autofocus>
                    </div>
                    @error('name')
                        <small class="text-danger mt-1 d-block">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Email Input -->
                <div class="login-form-group mb-3">
                    <label for="email" class="login-form-label">Alamat Email</label>
                    <div class="login-input-group">
                        <i class="bi bi-envelope input-icon"></i>
                        <input type="email" name="email" id="email" class="login-input @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="user@sekolah.sch.id" required>
                    </div>
                    @error('email')
                        <small class="text-danger mt-1 d-block">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Role Selection -->
                <div class="login-form-group mb-3">
                    <label for="role" class="login-form-label">Pilih Akses (Role)</label>
                    <div class="login-input-group">
                        <i class="bi bi-person-badge input-icon"></i>
                        <select name="role" id="role" class="login-input @error('role') is-invalid @enderror" required>
                            <option value="" disabled selected>-- Pilih Role --</option>
                            <option value="operator" {{ old('role') === 'operator' ? 'selected' : '' }}>Operator</option>
                            <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Administrator</option>
                        </select>
                    </div>
                    @error('role')
                        <small class="text-danger mt-1 d-block">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Password Input -->
                <div class="login-form-group mb-3">
                    <label for="password" class="login-form-label">Kata Sandi</label>
                    <div class="login-input-group position-relative">
                        <i class="bi bi-shield-lock input-icon"></i>
                        <input type="password" name="password" id="password" class="login-input @error('password') is-invalid @enderror" placeholder="Minimal 8 Karakter" required>
                        <!-- Tombol untuk melihat password jika diperlukan -->
                        <button type="button" class="btn btn-link position-absolute end-0 top-50 translate-middle-y text-muted text-decoration-none me-2" id="togglePassword">
                            <i class="bi bi-eye" id="eyeIcon"></i>
                        </button>
                    </div>
                    @error('password')
                        <small class="text-danger mt-1 d-block">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Password Confirmation Input -->
                <div class="login-form-group mb-4">
                    <label for="password_confirmation" class="login-form-label">Konfirmasi Kata Sandi</label>
                    <div class="login-input-group">
                        <i class="bi bi-shield-check input-icon"></i>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="login-input" placeholder="Ulangi Kata Sandi" required>
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn-login w-100" id="btn-submit">
                    <span>Daftarkan Akun</span>
                    <i class="bi bi-arrow-right ms-2"></i>
                </button>

            </form>

            <p class="login-footer-text mt-4 text-center text-muted small">
                Sudah punya akun? <a href="{{ route('login') }}" class="text-primary text-decoration-none fw-semibold">Masuk di sini</a>
            </p>

        </div>
    </div>

    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    
    <!-- Script untuk Toggle Show/Hide Password (Opsional) -->
    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');
        const eyeIcon = document.querySelector('#eyeIcon');

        if (togglePassword) {
            togglePassword.addEventListener('click', function () {
                const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                password.setAttribute('type', type);
                eyeIcon.classList.toggle('bi-eye');
                eyeIcon.classList.toggle('bi-eye-slash');
            });
        }
    </script>
</body>
</html>