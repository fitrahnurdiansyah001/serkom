<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Web Schools</title>

    <link rel="icon" type="image/png" href="{{ asset('assets/images/favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
</head>
<body>

    <div class="login-wrapper">
        <div class="login-bg-shape login-bg-shape-1"></div>
        <div class="login-bg-shape login-bg-shape-2"></div>

        <div class="login-card">

            <a href="/" class="login-brand text-decoration-none">
                <i class="bi bi-building-fill text-lime"></i>
                <span>WEB SCHOOLS</span>
            </a>

            <p class="login-subtitle">Masuk untuk mengakses dashboard sistem</p>

            <!-- Alert Notifikasi Sukses (setelah register) -->
            @if(session('success'))
                <div class="alert alert-success py-2 small mb-3">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Alert Notifikasi Error (jika login gagal) -->
            @if($errors->any())
                <div class="alert alert-danger py-2 small mb-3">
                    {{ $errors->first() }}
                </div>
            @endif

            <!-- Form Login -->
            <form action="{{ route('login') }}" method="POST" id="loginForm">
                @csrf

                <!-- Email Input -->
                <div class="login-form-group mb-3">
                    <label for="email" class="login-form-label">Alamat Email</label>
                    <div class="login-input-group">
                        <i class="bi bi-envelope input-icon"></i>
                        <input type="email" name="email" id="email" class="login-input @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="admin@sekolah.sch.id" required autofocus>
                    </div>
                </div>

                <!-- Password Input -->
                <div class="login-form-group mb-4">
                    <label for="password" class="login-form-label">Kata Sandi</label>
                    <div class="login-input-group position-relative">
                        <i class="bi bi-shield-lock input-icon"></i>
                        <input type="password" name="password" id="password" class="login-input @error('password') is-invalid @enderror" placeholder="••••••••" required>
                        <button type="button" class="btn btn-link position-absolute end-0 top-50 translate-middle-y text-muted text-decoration-none me-2" id="togglePassword">
                            <i class="bi bi-eye" id="eyeIcon"></i>
                        </button>
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn-login w-100" id="btn-submit">
                    <span>Masuk Aplikasi</span>
                    <i class="bi bi-box-arrow-in-right ms-2"></i>
                </button>

            </form>

            <!-- Link Register -->
            <p class="login-footer-text mt-4 text-center text-muted small">
                Belum memiliki akun? <a href="{{ route('register') }}" class="text-primary text-decoration-none fw-semibold">Daftar Sekarang</a>
            </p>

            <p class="mt-2 text-center text-muted small">
                &copy; 2026 Web Schools. Hak Cipta Dilindungi.
            </p>

        </div>
    </div>

    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script>
        // Fitur Toggle Password Visibility
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