<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guru;
use App\Models\Siswa;
use App\Models\Ekstrakurikuler;
use App\Models\ProfilSekolah;
use App\Models\Berita;

class HomeController extends Controller
{
    public function index()
    {
        $totalGuru = Guru::count();
        $totalSiswa = Siswa::count();
        $totalEkskul = Ekstrakurikuler::count();
        
        $profil = ProfilSekolah::first();
        $beritas = Berita::where('status', 'Publish')->latest('tanggal')->take(2)->get();

        return view('index', compact('totalGuru', 'totalSiswa', 'totalEkskul', 'profil', 'beritas'));
    }
}