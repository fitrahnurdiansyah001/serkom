<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\ProfilSekolah;
use Illuminate\Support\Str;

class SiswaController extends Controller
{
    public function index(Request $request)
    {
        $query = Siswa::query();

        if ($request->has('jenis_kelamin') && in_array($request->jenis_kelamin, ['Laki-laki', 'Perempuan'])) {
            $query->where('jenis_kelamin', $request->jenis_kelamin);
        }

        $siswas = $query->latest('id_siswa')->get();

        $jumlahLakiLaki = $siswas->filter(fn($siswa) => $siswa->jenis_kelamin === 'Laki-laki')->count();

        return view('siswa.index', compact('siswas', 'jumlahLakiLaki'));
    }

    public function show(string $slug)
    {
        $siswa = Siswa::where('slug', $slug)->firstOrFail();
        return view('siswa.show', compact('siswa'));
    }

    public function store(Request $request)
    {
        $profil = ProfilSekolah::first();
        $tahunBerdiri = $profil && $profil->tahun_berdiri ? (int)$profil->tahun_berdiri : 2000;

        $request->validate([
            'nama_siswa'    => 'required|string|max:255',
            'nisn'          => 'required|string|max:50|unique:siswa,nisn',
            'tahun_masuk'   => ['required', 'digits:4', 'integer', 'min:' . $tahunBerdiri, 'max:' . date('Y')],
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
        ], [
            'tahun_masuk.min' => 'Tahun masuk siswa tidak boleh lebih awal dari tahun berdirinya sekolah (' . $tahunBerdiri . ').',
            'tahun_masuk.digits' => 'Format tahun masuk harus 4 digit angka (Contoh: 2024).',
        ]);

        $siswa = new Siswa();
        $siswa->nama_siswa = $request->nama_siswa;

        $slugBaru = Str::slug($request->nama_siswa);
        if (Siswa::where('slug', $slugBaru)->exists()) {
            $slugBaru = $slugBaru . '-' . time();
        }
        $siswa->slug = $slugBaru;

        $siswa->nisn = $request->nisn;
        $siswa->tahun_masuk = $request->tahun_masuk;
        $siswa->jenis_kelamin = $request->jenis_kelamin;
        $siswa->save();

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil ditambahkan!');
    }

    // Menambahkan tipe data string pada parameter $id
    public function update(Request $request, string $id)
    {
        $siswa = Siswa::findOrFail($id);

        $profil = ProfilSekolah::first();
        $tahunBerdiri = $profil && $profil->tahun_berdiri ? (int)$profil->tahun_berdiri : 2000;

        $request->validate([
            'nama_siswa'    => 'required|string|max:255',
            // Pengecualian unik berdasarkan primary key 'id_siswa'
            'nisn'          => 'required|string|max:50|unique:siswa,nisn,' . $id . ',id_siswa',
            'tahun_masuk'   => ['required', 'digits:4', 'integer', 'min:' . $tahunBerdiri, 'max:' . date('Y')],
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
        ], [
            'tahun_masuk.min' => 'Tahun masuk siswa tidak boleh lebih awal dari tahun berdirinya sekolah (' . $tahunBerdiri . ').',
            'tahun_masuk.digits' => 'Format tahun masuk harus 4 digit angka (Contoh: 2024).',
        ]);

        if ($siswa->nama_siswa != $request->nama_siswa) {
            $slugBaru = Str::slug($request->nama_siswa);
            if (Siswa::where('slug', $slugBaru)->where('id_siswa', '!=', $id)->exists()) {
                $slugBaru = $slugBaru . '-' . time();
            }
            $siswa->slug = $slugBaru;
        }

        $siswa->nama_siswa = $request->nama_siswa;
        $siswa->nisn = $request->nisn;
        $siswa->tahun_masuk = $request->tahun_masuk;
        $siswa->jenis_kelamin = $request->jenis_kelamin;
        $siswa->save();

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil diperbarui!');
    }

    public function destroy(string $id)
    {
        $siswa = Siswa::findOrFail($id);
        $siswa->delete();

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil dihapus!');
    }
}
