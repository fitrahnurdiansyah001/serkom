<!DOCTYPE html>
<html lang="id" data-bs-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - SDIT Al-Hikmah</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/auth.css') }}">

    <script>
        const storedTheme = localStorage.getItem('theme') || 'light';
        document.documentElement.setAttribute('data-bs-theme', storedTheme);
    </script>

</head>

<body>
    <div class="d-flex justify-content-between align-items-center w-100 p-4 position-absolute top-0 start-0">

        <a href="/" class="btn fw-bold shadow-sm btn-kembali">
            <i class="bi bi-arrow-left me-2"></i> KEMBALI
        </a>

        <button id="theme-toggle" class="btn btn-light rounded-circle shadow-sm p-2" title="Ganti Tema"
            style="width: 45px; height: 45px;">
            <i class="bi bi-moon-stars fs-5"></i>
        </button>

    </div>


    <div class="container px-3 py-4">
        <div class="row justify-content-center align-items-center">
            <div class="col-12 col-lg-10 col-xl-9">

                <div class="login-wrapper row g-0">

                    <div class="col-lg-5 login-left-pane">
                        <div class="mb-3 shadow-lg"
                            style="width: 120px; height: 120px; border-radius: 50%; overflow: hidden; background-color: #ffffff; border: 4px solid rgba(255, 255, 255, 0.9);">
                            <img src="{{ asset('uploads/profil/logo_1791247116_6ac4430c6648d.jpeg') }}"
                                alt="Logo Sekolah" style="width: 100%; height: 100%; object-fit: cover;">
                        </div>

                        <h3 class="fw-bold text-white mb-1">SDIT Al-Hikmah</h3>
                        <p class="text-white-50 small mb-4 px-2" style="line-height: 1.6;">Sistem Informasi Akademik &
                            Portal Resmi Berbasis Sains & Tahfidz.</p>

                        <div class="w-150 pt-3 border-top border-light border-opacity-25 w-100">
                            <span
                                class="badge bg-white bg-opacity-25 text-white rounded-pill px-3 py-1 mb-2 fw-semibold">
                                <i class="bi bi-shield-lock-fill me-1"></i> Area Administrator
                            </span>
                            <p class="text-white-50 small mb-0">Silakan login untuk mengelola data akademik sekolah.</p>
                        </div>
                    </div>

                    <div class="col-lg-7 login-right-pane">

                        <div class="mb-4 text-center text-lg-start">
                            <h4 class="fw-bold custom-title mb-1">Masuk Panel Admin</h4>
                            <p class="text-secondary small">Masukkan Username dan Password Anda untuk melanjutkan.</p>
                        </div>

                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show rounded-3 shadow-sm mb-3 small py-2"
                                role="alert">
                                <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
                                <button type="button" class="btn-close py-2" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
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
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif


                        <form action="{{ route('login') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label custom-label">Alamat Username</label>
                                <div class="input-group">
                                    <span class="input-group-text border-end-0 rounded-start-3 px-3">
                                        <i class="bi bi-person"></i>
                                    </span>
                                    <input type="text" name="username"
                                        class="form-control rounded-end-3 border-start-0 ps-2"
                                        value="{{ old('email') }}" placeholder="adminExample" required autofocus>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label custom-label">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text border-end-0 rounded-start-3 px-3">
                                        <i class="bi bi-lock"></i>
                                    </span>
                                    <input type="password" name="password" id="passwordInput"
                                        class="form-control border-start-0 border-end-0 ps-2" placeholder="••••••••"
                                        required>
                                    <button class="btn btn-outline-secondary border-start-0 rounded-end-3 px-3"
                                        type="button" id="togglePassword">
                                        <i class="bi bi-eye" id="toggleIcon"></i>
                                    </button>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-custom-green w-100 shadow-sm mb-3">
                                <i class="bi bi-box-arrow-in-right me-2"></i> Masuk ke Sistem
                            </button>
                        </form>

                        <div class="text-center pt-3 border-top border-secondary border-opacity-10">
                            <small class="text-secondary">&copy; {{ date('Y') }} SDIT Al-Hikmah. Hak Cipta
                                Dilindungi.</small>
                        </div>

                    </div>

                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordInput = document.getElementById('passwordInput');
            const toggleIcon = document.getElementById('toggleIcon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('bi-eye');
                toggleIcon.classList.add('bi-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('bi-eye-slash');
                toggleIcon.classList.add('bi-eye');
            }
        });

        document.getElementById('theme-toggle').addEventListener('click', function() {
            const htmlElement = document.documentElement;
            const themeIcon = this.querySelector('i');
            const currentTheme = htmlElement.getAttribute('data-bs-theme');
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';

            htmlElement.setAttribute('data-bs-theme', newTheme);
            localStorage.setItem('theme', newTheme);

            if (newTheme === 'dark') {
                themeIcon.classList.remove('bi-moon-stars');
                themeIcon.classList.add('bi-sun-fill', 'text-warning');
            } else {
                themeIcon.classList.remove('bi-sun-fill', 'text-warning');
                themeIcon.classList.add('bi-moon-stars');
            }
        });

        window.addEventListener('DOMContentLoaded', () => {
            const currentTheme = document.documentElement.getAttribute('data-bs-theme');
            const themeIcon = document.querySelector('#theme-toggle i');
            if (currentTheme === 'dark') {
                themeIcon.classList.remove('bi-moon-stars');
                themeIcon.classList.add('bi-sun-fill', 'text-warning');
            }
        });
    </script>
</body>

</html>
