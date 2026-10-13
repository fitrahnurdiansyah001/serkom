<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guru;
use App\Models\Siswa;
use App\Models\Ekstrakurikuler;
use App\Models\Prestasi;
use App\Models\Galeri;
use App\Models\Berita;
use App\Models\Pengumuman;
use App\Models\Program;
use App\Models\User;
use App\Models\ProfilSekolah;

class HomeController extends Controller
{
    public function index()
    {
        $totalGuru = Guru::count();
        $totalSiswa = Siswa::count();
        $totalEkskul = Ekstrakurikuler::count();
        $totalPrestasi = Prestasi::count();
        $totalGaleri = Galeri::count();
        $totalBerita = Berita::count();
        $totalPengumuman = Pengumuman::count();
        $totalUser = User::count();
        $totalProgram = Program::count();
        $profil = ProfilSekolah::first();
        $programs = Program::latest()->get();
        $prestasis = Prestasi::latest()->take(5)->get();
        $ekskuls = Ekstrakurikuler::all();
        $galeris = Galeri::latest()->take(6)->get(); 
        $gurus = Guru::all();

        $semuaBerita = Berita::orderBy('tanggal', 'desc')->get();
        $beritas = $semuaBerita->filter(fn($berita) => $berita->status === 'Publish')->take(3);
        $pengumumans = Pengumuman::orderBy('tanggal', 'desc')->take(3)->get();


        return view('dashboard.index', compact(
            'totalGuru',
            'totalSiswa',
            'totalEkskul',
            'totalPrestasi',
            'totalGaleri',
            'totalBerita',
            'totalPengumuman',
            'totalUser',
            'totalProgram',
            'programs',   
            'profil', 
            'prestasis', 
            'ekskuls', 
            'galeris', 
            'beritas', 
            'pengumumans', 
            'gurus'
        ));
    }

    public function search(Request $request)
    {
        $keyword = $request->input('query');

        $hasilSiswa = Siswa::where('nama_siswa', 'LIKE', "%{$keyword}%")
            ->orWhere('nisn', 'LIKE', "%{$keyword}%")
            ->get();

        $hasilGuru = Guru::where('nama_guru', 'LIKE', "%{$keyword}%")
            ->orWhere('nip', 'LIKE', "%{$keyword}%")
            ->get();

        $hasilBerita = Berita::where('judul', 'LIKE', "%{$keyword}%")
            ->orWhere('isi', 'LIKE', "%{$keyword}%")
            ->get();

        $hasilEkskul = Ekstrakurikuler::where('nama_ekskul', 'LIKE', "%{$keyword}%")
            ->orWhere('pembina', 'LIKE', "%{$keyword}%")
            ->orWhere('deskripsi', 'LIKE', "%{$keyword}%")
            ->get();

        $hasilGaleri = Galeri::where('judul', 'LIKE', "%{$keyword}%")
            ->orWhere('keterangan', 'LIKE', "%{$keyword}%")
            ->get();

        $hasilPengumuman = Pengumuman::where('judul', 'LIKE', "%{$keyword}%")
            ->orWhere('isi', 'LIKE', "%{$keyword}%")
            ->get();

        $hasilPrestasi = Prestasi::where('nama_prestasi', 'LIKE', "%{$keyword}%")
            ->orWhere('juara', 'LIKE', "%{$keyword}%")
            ->orWhere('tingkat', 'LIKE', "%{$keyword}%")
            ->get();

        // Tambahkan pencarian untuk Program Sekolah
        $hasilProgram = Program::where('nama_program', 'LIKE', "%{$keyword}%")
            ->orWhere('deskripsi', 'LIKE', "%{$keyword}%")
            ->get();

        $semuaHasil = collect([
            $hasilSiswa, 
            $hasilGuru, 
            $hasilBerita, 
            $hasilEkskul, 
            $hasilGaleri, 
            $hasilPengumuman, 
            $hasilPrestasi,
            $hasilProgram,
        ]);
        
        $totalPencarian = $semuaHasil->sum(fn($kumpulanData) => $kumpulanData->count());

        return view('search.search_result', compact(
            'keyword',
            'hasilSiswa',
            'hasilGuru',
            'hasilBerita',
            'hasilEkskul',
            'hasilGaleri',
            'hasilPengumuman',
            'hasilPrestasi',
            'hasilProgram',
            'totalPencarian'
        ));
    }
}