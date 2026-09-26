<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\EkskulController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;

// Route untuk yang BELUM login (Guest)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'processLogin']);

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'processRegister']);
});

// Route untuk yang SUDAH login (Auth)
Route::middleware('auth')->group(function () {
    // Halaman utama (dashboard) - Memanggil HomeController dengan data lengkap
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Profil Pengguna (User)
    Route::get('/profil-saya', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profil-saya', [ProfileController::class, 'update'])->name('profile.update');

    // Profil Sekolah
    Route::get('/profil', [ProfilController::class, 'index'])->name('profil');
    Route::post('/profil/update', [ProfilController::class, 'update'])->name('profil.update');

    // Ekstrakurikuler
    Route::get('/ekstrakurikuler', [EkskulController::class, 'index'])->name('ekskul.index');
    Route::post('/ekstrakurikuler/store', [EkskulController::class, 'store'])->name('ekskul.store');
    Route::post('/ekstrakurikuler/update/{id}', [EkskulController::class, 'update'])->name('ekskul.update');
    Route::delete('/ekstrakurikuler/delete/{id}', [EkskulController::class, 'destroy'])->name('ekskul.destroy');

    // Galeri
    Route::get('/galeri', [GaleriController::class, 'index'])->name('galeri.index');
    Route::post('/galeri/store', [GaleriController::class, 'store'])->name('galeri.store');
    Route::delete('/galeri/delete/{id}', [GaleriController::class, 'destroy'])->name('galeri.destroy');
    Route::put('/galeri/{id}', [GaleriController::class, 'update'])->name('galeri.update');

    // Berita
    Route::get('/berita', [BeritaController::class, 'index'])->name('berita.index');
    Route::post('/berita/store', [BeritaController::class, 'store'])->name('berita.store');
    Route::post('/berita/update/{id}', [BeritaController::class, 'update'])->name('berita.update');
    Route::delete('/berita/delete/{id}', [BeritaController::class, 'destroy'])->name('berita.destroy');

    // Guru
    Route::get('/guru', [GuruController::class, 'index'])->name('guru.index');
    Route::post('/guru/store', [GuruController::class, 'store'])->name('guru.store');
    Route::post('/guru/update/{id}', [GuruController::class, 'update'])->name('guru.update');
    Route::delete('/guru/delete/{id}', [GuruController::class, 'destroy'])->name('guru.destroy');

    // Siswa
    Route::get('/siswa', [SiswaController::class, 'index'])->name('siswa.index');
    Route::post('/siswa/store', [SiswaController::class, 'store'])->name('siswa.store');
    Route::post('/siswa/update/{id}', [SiswaController::class, 'update'])->name('siswa.update');
    Route::delete('/siswa/delete/{id}', [SiswaController::class, 'destroy'])->name('siswa.destroy');

    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::post('/users/update/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/delete/{id}', [UserController::class, 'destroy'])->name('users.destroy');
});
