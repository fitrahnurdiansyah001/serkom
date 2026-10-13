<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\EkskulController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PrestasiController;
use App\Http\Controllers\LandingController;

Route::get('/', [LandingController::class, 'index'])->name('landing.home');
Route::get('/tentang', [LandingController::class, 'tentang'])->name('landing.tentang');

Route::get('/info-prestasi', [LandingController::class, 'prestasi'])->name('landing.prestasi');      
Route::get('/info-prestasi/{slug}', [LandingController::class, 'detailPrestasi'])->name('landing.prestasi.detail');

Route::get('/info-ekskul', [LandingController::class, 'ekskul'])->name('landing.ekskul');
Route::get('/info-ekskul/{slug}', [LandingController::class, 'detailEkskul'])->name('landing.ekskul.detail');

Route::get('/info-guru', [LandingController::class, 'guru'])->name('landing.guru');                  
Route::get('/info-guru/{slug}', [LandingController::class, 'detailGuru'])->name('landing.guru.detail');        

Route::get('/info-berita', [LandingController::class, 'berita'])->name('landing.berita');         
Route::get('/info-berita/{slug}', [LandingController::class, 'detailBerita'])->name('landing.berita.detail');   

Route::get('/info-pengumuman', [LandingController::class, 'pengumuman'])->name('landing.pengumuman');
Route::get('/info-pengumuman/{slug}', [LandingController::class, 'detailPengumuman'])->name('landing.pengumuman.detail');

Route::get('/info-galeri', [LandingController::class, 'galeri'])->name('landing.galeri');
Route::get('/info-galeri/{slug}', [LandingController::class, 'detailGaleri'])->name('landing.galeri.detail');

Route::get('/info-program', [LandingController::class, 'program'])->name('landing.program');

Route::get('/info-siswa', [LandingController::class, 'siswa'])->name('landing.siswa'); 
Route::get('/info-profil', [LandingController::class, 'profil'])->name('landing.profil'); 


Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'processLogin']);
});


Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [HomeController::class, 'index'])->name('home');
    Route::get('/search', [HomeController::class, 'search'])->name('search.index');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Profil Akun 
    Route::get('/profil-saya', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profil-saya', [ProfileController::class, 'update'])->name('profile.update');

    // Profil Sekolah
    Route::get('/profil', [ProfilController::class, 'index'])->name('profil');
    Route::post('/profil/update', [ProfilController::class, 'update'])->name('profil.update');

    // Manajemen Ekstrakurikuler
    Route::prefix('ekskul')->name('ekskul.')->group(function () {
        Route::get('/', [EkskulController::class, 'index'])->name('index');
        Route::post('/store', [EkskulController::class, 'store'])->name('store');
        Route::get('/show/{slug}', [EkskulController::class, 'show'])->name('show');
        Route::post('/update/{slug}', [EkskulController::class, 'update'])->name('update');
        Route::delete('/delete/{slug}', [EkskulController::class, 'destroy'])->name('destroy');
    });

    // Manajemen Galeri
    Route::prefix('galeri')->name('galeri.')->group(function () {
        Route::get('/', [GaleriController::class, 'index'])->name('index');
        Route::post('/store', [GaleriController::class, 'store'])->name('store');
        Route::get('/show/{slug}', [GaleriController::class, 'show'])->name('show');
        Route::post('/update/{slug}', [GaleriController::class, 'update'])->name('update');
        Route::delete('/delete/{slug}', [GaleriController::class, 'destroy'])->name('destroy');
    });

    // Manajemen Berita
    Route::prefix('berita')->name('berita.')->group(function () {
        Route::get('/', [BeritaController::class, 'index'])->name('index');
        Route::post('/store', [BeritaController::class, 'store'])->name('store');
        Route::get('/show/{slug}', [BeritaController::class, 'show'])->name('show');
        Route::post('/update/{slug}', [BeritaController::class, 'update'])->name('update');
        Route::delete('/delete/{slug}', [BeritaController::class, 'destroy'])->name('destroy');
    });

    // Manajemen Pengumuman
    Route::prefix('pengumuman')->name('pengumuman.')->group(function () {
        Route::get('/', [PengumumanController::class, 'index'])->name('index');
        Route::post('/store', [PengumumanController::class, 'store'])->name('store');
        Route::get('/show/{slug}', [PengumumanController::class, 'show'])->name('show');
        Route::post('/update/{slug}', [PengumumanController::class, 'update'])->name('update');
        Route::delete('/delete/{slug}', [PengumumanController::class, 'destroy'])->name('destroy');
    });

    // Manajemen Guru
    Route::prefix('guru')->name('guru.')->group(function () {
        Route::get('/', [GuruController::class, 'index'])->name('index');
        Route::post('/store', [GuruController::class, 'store'])->name('store');
        Route::get('/show/{slug}', [GuruController::class, 'show'])->name('show');
        Route::post('/update/{slug}', [GuruController::class, 'update'])->name('update');
        Route::delete('/delete/{slug}', [GuruController::class, 'destroy'])->name('destroy');
    });

    // Manajemen Siswa
    Route::prefix('siswa')->name('siswa.')->group(function () {
        Route::get('/', [SiswaController::class, 'index'])->name('index');
        Route::post('/store', [SiswaController::class, 'store'])->name('store');
        Route::get('/show/{slug}', [SiswaController::class, 'show'])->name('show');
        Route::post('/update/{slug}', [SiswaController::class, 'update'])->name('update');
        Route::delete('/delete/{slug}', [SiswaController::class, 'destroy'])->name('destroy');
    });

    // Manajemen Prestasi
    Route::prefix('prestasi')->name('prestasi.')->group(function () {
        Route::get('/', [PrestasiController::class, 'index'])->name('index');
        Route::post('/store', [PrestasiController::class, 'store'])->name('store');
        Route::get('/show/{slug}', [PrestasiController::class, 'show'])->name('show');
        Route::post('/update/{slug}', [PrestasiController::class, 'update'])->name('update');
        Route::delete('/delete/{slug}', [PrestasiController::class, 'destroy'])->name('destroy');
    });

    // Manajemen Users
    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::post('/store', [UserController::class, 'store'])->name('store');
        Route::post('/update/{slug}', [UserController::class, 'update'])->name('update');
        Route::delete('/delete/{slug}', [UserController::class, 'destroy'])->name('destroy');
    });

    // Manajemen Program Sekolah (Admin)
    Route::prefix('program')->name('program.')->group(function () {
        Route::get('/', [App\Http\Controllers\ProgramController::class, 'index'])->name('index');
        Route::post('/store', [App\Http\Controllers\ProgramController::class, 'store'])->name('store');
        Route::post('/update/{slug}', [App\Http\Controllers\ProgramController::class, 'update'])->name('update');
        Route::delete('/delete/{slug}', [App\Http\Controllers\ProgramController::class, 'destroy'])->name('destroy');
    });
});