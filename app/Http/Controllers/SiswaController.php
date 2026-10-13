<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\ProfilSekolah;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class SiswaController extends Controller
{
    public function index(Request $request)
    {
        $query = Siswa::with('kelas');
        if ($request->has('jenis_kelamin') && in_array($request->jenis_kelamin, ['Laki-laki', 'Perempuan'])) {
            $query->where('jenis_kelamin', $request->jenis_kelamin);
        }

        // Ambil data siswa
        $siswas = $query->latest('id_siswa')->get(); // Pastikan primary key-nya benar id_siswa atau id
        $jumlahLakiLaki = $siswas->filter(fn($siswa) => $siswa->jenis_kelamin === 'Laki-laki')->count();
        $semuaKelas = Kelas::all();

        // 3. KIRIM $semuaKelas KE VIEW
        return view('siswa.index', compact('siswas', 'jumlahLakiLaki', 'semuaKelas'));
    }

    public function show(string $slug)
    {
        // Gunakan eager loading juga saat melihat detail siswa
        $siswa = Siswa::with('kelas')->where('slug', $slug)->firstOrFail();
        return view('siswa.show', compact('siswa'));
    }

    public function store(Request $request)
    {
        $profil = ProfilSekolah::first();
        $tahunBerdiri = $profil && $profil->tahun_berdiri ? (int)$profil->tahun_berdiri : 2000;

        $request->validate([
            'nama_siswa'    => 'required|string|max:255',
            'nisn'          => 'required|string|max:50|unique:siswa,nisn',
            'kelas_id'      => 'required|exists:kelas,id', 
            'tahun_masuk'   => ['required', 'digits:4', 'integer', 'min:' . $tahunBerdiri, 'max:' . date('Y')],
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
        ], [
            'nisn.unique'        => 'NISN ini sudah terdaftar. Silakan periksa kembali data siswa.',
            'kelas_id.required'  => 'Kelas wajib dipilih.',
            'kelas_id.exists'    => 'Kelas yang dipilih tidak valid.',
            'tahun_masuk.min'    => 'Tahun masuk siswa tidak boleh lebih awal dari tahun berdirinya sekolah (' . $tahunBerdiri . ').',
            'tahun_masuk.digits' => 'Format tahun masuk harus 4 digit angka (Contoh: 2024).',
        ]);

        $siswa = new Siswa();
        $siswa->nama_siswa = $request->nama_siswa;

        $slugBaru = Str::slug($request->nama_siswa);
        if (Siswa::where('slug', $slugBaru)->exists()) {
            $slugBaru = $slugBaru . '-' . time();
        }
        $siswa->slug = $slugBaru;
        
        $siswa->kelas_id = $request->kelas_id; 
        
        $siswa->nisn = $request->nisn;
        $siswa->tahun_masuk = $request->tahun_masuk;
        $siswa->jenis_kelamin = $request->jenis_kelamin;
        $siswa->save();

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil ditambahkan!');
    }

    public function update(Request $request, string $id)
    {
        $siswa = Siswa::findOrFail($id);
        $primaryKeyName = $siswa->getKeyName();

        $profil = ProfilSekolah::first();
        $tahunBerdiri = $profil && $profil->tahun_berdiri ? (int)$profil->tahun_berdiri : 2000;

        $request->validate([
            'nama_siswa'    => 'required|string|max:255',
            'nisn'          => [
                'required',
                'string',
                'max:50',
                Rule::unique('siswa', 'nisn')->ignore($id, $primaryKeyName)
            ],
            'kelas_id'      => 'required|exists:kelas,id',
            'tahun_masuk'   => ['required', 'digits:4', 'integer', 'min:' . $tahunBerdiri, 'max:' . date('Y')],
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
        ], [
            'nisn.unique'        => 'NISN ini sudah digunakan oleh data siswa lain.',
            'kelas_id.required'  => 'Kelas wajib dipilih.',
            'kelas_id.exists'    => 'Kelas yang dipilih tidak valid.',
            'tahun_masuk.min'    => 'Tahun masuk siswa tidak boleh lebih awal dari tahun berdirinya sekolah (' . $tahunBerdiri . ').',
            'tahun_masuk.digits' => 'Format tahun masuk harus 4 digit angka (Contoh: 2024).',
        ]);

        if ($siswa->nama_siswa != $request->nama_siswa) {
            $slugBaru = Str::slug($request->nama_siswa);
            if (Siswa::where('slug', $slugBaru)->where($primaryKeyName, '!=', $id)->exists()) {
                $slugBaru = $slugBaru . '-' . time();
            }
            $siswa->slug = $slugBaru;
        }

        $siswa->nama_siswa = $request->nama_siswa;
        $siswa->nisn = $request->nisn;

        $siswa->kelas_id = $request->kelas_id;
        
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