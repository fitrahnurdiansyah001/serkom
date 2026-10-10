<!DOCTYPE html>
<html lang="id" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - SDIT Al-Hikmah</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Google Fonts Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Script Cegah Flash Mode Gelap -->
    <script>
        const storedTheme = localStorage.getItem('theme') || 'light';
        document.documentElement.setAttribute('data-bs-theme', storedTheme);
    </script>

    <style>
        :root {
            --primary-green: #0F8B44;
            --accent-green: #0c7338;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #f1f5f9;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
        }

        html[data-bs-theme="dark"] body {
            background: #090d16;
        }

        .login-wrapper {
            width: 100%;
            max-width: 960px;
            background-color: #ffffff;
            border: 1px solid rgba(0, 0, 0, 0.06);
            border-radius: 1.75rem;
            box-shadow: 0 25px 50px -12px rgba(15, 139, 68, 0.12);
            overflow: hidden;
            transition: all 0.3s ease;
        }

        html[data-bs-theme="dark"] .login-wrapper {
            background-color: #111827;
            border: 1px solid rgba(255, 255, 255, 0.08);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.6);
        }

        .login-left-pane {
            background: linear-gradient(135deg, #0F8B44 0%, #0c7338 100%);
            color: #ffffff;
            padding: 3rem 2.5rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .login-right-pane {
            padding: 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .form-control {
            background-color: #f8f9fa;
            border-color: #e2e8f0;
            color: #212529;
            padding: 0.8rem 1rem;
            font-size: 0.95rem;
        }

        html[data-bs-theme="dark"] .form-control {
            background-color: #1f2937;
            border-color: #374151;
            color: #f9fafb;
        }

        .form-control:focus {
            background-color: #ffffff;
            border-color: #0F8B44;
            box-shadow: 0 0 0 4px rgba(15, 139, 68, 0.15);
        }

        html[data-bs-theme="dark"] .form-control:focus {
            background-color: #111827;
            border-color: #0F8B44;
            color: #ffffff;
        }

        .input-group-text {
            background-color: #f1f5f9;
            border-color: #e2e8f0;
            color: #64748b;
        }

        html[data-bs-theme="dark"] .input-group-text {
            background-color: #1f2937;
            border-color: #374151;
            color: #9ca3af;
        }

        .custom-label {
            font-weight: 600;
            font-size: 0.85rem;
            color: #334155;
        }

        html[data-bs-theme="dark"] .custom-label {
            color: #cbd5e1;
        }

        .custom-title {
            color: #0f172a;
        }

        html[data-bs-theme="dark"] .custom-title {
            color: #ffffff;
        }

        .btn-custom-green {
            background-color: #0F8B44;
            border-color: #0F8B44;
            color: #ffffff;
            padding: 0.8rem;
            font-weight: 600;
            border-radius: 0.75rem;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }

        .btn-custom-green:hover {
            background-color: #0c7338;
            border-color: #0c7338;
            color: #ffffff;
        }

        .theme-toggle-fixed {
            position: fixed;
            top: 25px;
            right: 25px;
            background: #ffffff;
            border: 1px solid rgba(0, 0, 0, 0.1);
            width: 42px;
            height: 42px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            transition: all 0.2s ease;
            z-index: 10;
            color: #334155;
        }

        html[data-bs-theme="dark"] .theme-toggle-fixed {
            background: #1f2937;
            border-color: rgba(255, 255, 255, 0.1);
            color: #f9fafb;
        }
        
        .theme-toggle-fixed:hover {
            transform: scale(1.05);
        }
    </style>
</head>
<body>

    <!-- Tombol Toggle Tema Mengambang -->
    <button id="theme-toggle" class="theme-toggle-fixed" title="Ganti Tema">
        <i class="bi bi-moon-stars fs-5"></i>
    </button>

    <div class="container px-3 py-4">
        <div class="row justify-content-center align-items-center">
            <div class="col-12 col-lg-10 col-xl-9">
                
                <div class="login-wrapper row g-0">
                    
                    <!-- SISI KIRI: Branding, Logo Besar & Sambutan -->
                    <div class="col-lg-5 login-left-pane">
                        <!-- Logo Diperbesar Menjadi 120px -->
                        <div class="mb-3 shadow-lg" style="width: 120px; height: 120px; border-radius: 50%; overflow: hidden; background-color: #ffffff; border: 4px solid rgba(255, 255, 255, 0.9);">
                            <img src="{{ asset('uploads/profil/logo_1791247116_6ac4430c6648d.jpeg') }}" alt="Logo Sekolah"
                                style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                        
                        <h3 class="fw-bold text-white mb-1">SDIT Al-Hikmah</h3>
                        <p class="text-white-50 small mb-4 px-2" style="line-height: 1.6;">Sistem Informasi Akademik & Portal Resmi Berbasis Sains & Tahfidz.</p>
                        
                        <div class="w-150 pt-3 border-top border-light border-opacity-25 w-100">
                            <span class="badge bg-white bg-opacity-25 text-white rounded-pill px-3 py-1 mb-2 fw-semibold">
                                <i class="bi bi-shield-lock-fill me-1"></i> Area Administrator
                            </span>
                            <p class="text-white-50 small mb-0">Silakan login untuk mengelola data akademik sekolah.</p>
                        </div>
                    </div>

                    <!-- SISI KANAN: Form Input -->
                    <div class="col-lg-7 login-right-pane">
                        
                        <div class="mb-4 text-center text-lg-start">
                            <h4 class="fw-bold custom-title mb-1">Masuk Panel Admin</h4>
                            <p class="text-secondary small">Masukkan Username dan Password Anda untuk melanjutkan.</p>
                        </div>

                        <!-- Notifikasi -->
                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show rounded-3 shadow-sm mb-3 small py-2" role="alert">
                                <i class="bi bi-exclamation-triangle me-2"></i> {{ session('error') }}
                                <button type="button" class="btn-close py-2" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show rounded-3 shadow-sm mb-3 small py-2" role="alert">
                                <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
                                <button type="button" class="btn-close py-2" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        @if($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show rounded-3 shadow-sm mb-3 small py-2" role="alert">
                                <i class="bi bi-exclamation-triangle me-2"></i> Email atau password salah.
                                <button type="button" class="btn-close py-2" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <!-- Form Login -->
                        <form action="{{ route('login') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label custom-label">Alamat Username</label>
                                <div class="input-group">
                                    <span class="input-group-text border-end-0 rounded-start-3 px-3">
                                        <i class="bi bi-envelope"></i>
                                    </span>
                                    <input type="text" name="username" class="form-control rounded-end-3 border-start-0 ps-2" value="{{ old('email') }}" placeholder="adminExample" required autofocus>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label custom-label">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text border-end-0 rounded-start-3 px-3">
                                        <i class="bi bi-lock"></i>
                                    </span>
                                    <input type="password" name="password" id="passwordInput" class="form-control border-start-0 border-end-0 ps-2" placeholder="••••••••" required>
                                    <button class="btn btn-outline-secondary border-start-0 rounded-end-3 px-3" type="button" id="togglePassword">
                                        <i class="bi bi-eye" id="toggleIcon"></i>
                                    </button>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-custom-green w-100 shadow-sm mb-3">
                                <i class="bi bi-box-arrow-in-right me-2"></i> Masuk ke Sistem
                            </button>
                        </form>

                        <!-- Footer -->
                        <div class="text-center pt-3 border-top border-secondary border-opacity-10">
                            <small class="text-secondary">&copy; {{ date('Y') }} SDIT Al-Hikmah. Hak Cipta Dilindungi.</small>
                        </div>

                    </div>

                </div>

            </div>
        </div>
    </div>

    <!-- Script JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('togglePassword').addEventListener('click', function () {
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

        document.getElementById('theme-toggle').addEventListener('click', function () {
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