<?php

namespace App\Http\Controllers;

use App\Models\ProfilSekolah;
use App\Models\Prestasi;
use App\Models\Ekstrakurikuler;
use App\Models\Galeri;
use App\Models\Berita;
use App\Models\Pengumuman;
use App\Models\Guru;
use App\Models\Siswa;
use App\Models\Program;

class LandingController extends Controller
{
    public function index()
    {
        $profil = ProfilSekolah::first();
        $prestasis = Prestasi::latest()->take(4)->get();
        $ekskuls = Ekstrakurikuler::latest()->take(6)->get();
        $galeris = Galeri::latest()->take(3)->get();
        $beritas = Berita::where('status', 'Publish')->latest()->take(3)->get();
        $pengumumans = Pengumuman::latest()->take(3)->get();
        $gurus = Guru::latest()->take(4)->get();
        $programs = Program::latest()->take(3)->get();

        return view('landing.index', compact(
            'profil',
            'prestasis',
            'ekskuls',
            'galeris',
            'beritas',
            'pengumumans',
            'gurus',
            'programs'
        ));
    }

    public function tentang()
    {
        $profil = ProfilSekolah::first();
        $totalSiswa = Siswa::count();
        $totalGuru = Guru::count();
        $totalEkskul = Ekstrakurikuler::count();
        $totalPrestasi = Prestasi::count();

        return view('landing.tentang', compact(
            'profil',
            'totalSiswa',
            'totalGuru',
            'totalEkskul',
            'totalPrestasi'
        ));
    }

    public function prestasi()
    {
        $profil = ProfilSekolah::first();
        $prestasis = Prestasi::all();

        return view('landing.prestasi', compact('profil', 'prestasis'));
    }

    public function detailPrestasi(string $slug)
    {
        $profil = ProfilSekolah::first();
        $prestasi = Prestasi::where('slug', $slug)->firstOrFail();

        return view('landing.detail.detail_prestasi', compact('profil', 'prestasi'));
    }

    public function ekskul()
    {
        $profil = ProfilSekolah::first();
        $ekskuls = Ekstrakurikuler::all();

        return view('landing.eskul', compact('profil', 'ekskuls'));
    }

    public function detailEkskul(string $slug)
    {
        $profil = ProfilSekolah::first();
        $ekskul = Ekstrakurikuler::where('slug', $slug)->firstOrFail();

        return view('landing.detail.detail_eskul', compact('profil', 'ekskul'));
    }

    public function guru()
    {
        $profil = ProfilSekolah::first();
        $gurus = Guru::all();

        return view('landing.guru', compact('profil', 'gurus'));
    }

    public function detailguru(string $slug)
    {
        $profil = ProfilSekolah::first();
        $guru = Guru::where('slug', $slug)->firstOrFail();

        return view('landing.detail.detail_guru', compact('profil', 'guru'));
    }

    public function berita()
    {
        $profil = ProfilSekolah::first();
        $semuaBerita = Berita::where('status', 'Publish')->latest()->get();

        $beritas = $semuaBerita->filter(fn($berita) => $berita->status === 'Publish');

        return view('landing.berita', compact('profil', 'beritas'));
    }

    public function detailberita(string $slug)
    {
        $profil = ProfilSekolah::first();
        $berita = Berita::where('slug', $slug)->firstOrFail();

        return view('landing.detail.detail_berita', compact('profil', 'berita'));
    }

    public function pengumuman()
    {
        $profil = ProfilSekolah::first();
        $pengumumans = Pengumuman::where('status', 'Publish')->latest()->get();

        return view('landing.pengumuman', compact('profil', 'pengumumans'));
    }

    public function detailPengumuman(string $slug)
    {
        $profil = ProfilSekolah::first();
        $pengumuman = Pengumuman::where('slug', $slug)->firstOrFail();

        return view('landing.detail.detail_pengumuman', compact('profil', 'pengumuman'));
    }

    public function galeri()
    {
        $profil = ProfilSekolah::first();
        $galeris = Galeri::all();

        return view('landing.galeri', compact('profil', 'galeris'));
    }

    public function detailGaleri(string $slug)
    {
        $profil = ProfilSekolah::first();
        $galeris = Galeri::where('slug', $slug)->firstOrFail();

        return view('landing.detail.detail_galeri', compact('profil', 'galeris'));
    }

    public function program()
    {
        $profil = ProfilSekolah::first();
        $programs = Program::latest()->get();

        return view('landing.program', compact('profil', 'programs'));
    }


    public function siswa()
    {
        $profil = ProfilSekolah::first();
        $siswas = Siswa::with('kelas')->get();

        return view('landing.siswa', compact('siswas','profil'));
    }

    public function profil()
    {
        $profil = ProfilSekolah::first();
        return view('landing.profil', compact('profil'));
    }
}
