<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prestasi;
use Illuminate\Support\Str;
use App\Models\ProfilSekolah;

class PrestasiController extends Controller
{
    public function index(Request $request)
    {
        $query = Prestasi::query();

        if ($request->has('tingkat') && !empty($request->tingkat)) {
            $query->where('tingkat', $request->tingkat);
        } elseif ($request->has('juara') && !empty($request->juara)) {
            $query->where('juara', $request->juara);
        }

        $profilsekolah = ProfilSekolah::first();
        $prestasis = $query->latest()->get();

        $totalNasional = $prestasis->filter(fn($prestasi) => $prestasi->tingkat === 'Nasional')->count();
        return view('prestasi.index', compact('prestasis', 'totalNasional','profilsekolah'));
    }

    public function show(string $slug)
    {
        $prestasi = Prestasi::where('slug', $slug)->firstOrFail();
        return view('prestasi.show', compact('prestasi'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_prestasi' => 'required|string|max:100',
            'tingkat' => 'required|in:Sekolah,Kecamatan,Kabupaten/Kota,Provinsi,Nasional,Internasional',
            'juara' => 'required|in:Juara 1,Juara 2,Juara 3,Harapan 1,Harapan 2,Juara Favorit,Medali Emas,Medali Perak,Medali Perunggu',
            'tahun' => 'required|digits:4|integer|min:1900|max:' . date('Y'),
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $fotoName = null;
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');

            // Pastikan folder public/uploads/prestasi ada
            $destinationPath = public_path('uploads/prestasi');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $fotoName = 'prestasi_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move($destinationPath, $fotoName);
        }
        $slugBaru = Str::slug($request->nama_prestasi);

        $cekSlug = Prestasi::where('slug', $slugBaru)->count();
        if($cekSlug > 0) {
             $slugBaru = $slugBaru . '-' . time();
        }

        Prestasi::create([
            'nama_prestasi' => $request->nama_prestasi,
            'slug'          => $slugBaru,
            'tingkat'       => $request->tingkat,
            'juara'         => $request->juara,
            'tahun'         => $request->tahun,
            'deskripsi'     => $request->deskripsi,
            'foto'          => $fotoName
        ]);

        return redirect()->route('prestasi.index')->with('success', 'Data prestasi berhasil ditambahkan!');
    }

    public function update(Request $request, string $id)
    {
        $prestasi = Prestasi::findOrFail($id);

        $request->validate([
            'nama_prestasi' => 'required|string|max:100',
            'tingkat' => 'required|in:Sekolah,Kecamatan,Kabupaten/Kota,Provinsi,Nasional,Internasional',
            'juara' => 'required|in:Juara 1,Juara 2,Juara 3,Harapan 1,Harapan 2,Juara Favorit,Medali Emas,Medali Perak,Medali Perunggu',
            'tahun' => 'required|digits:4|integer',
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($prestasi->foto && file_exists(public_path('uploads/prestasi/' . $prestasi->foto))) {
                @unlink(public_path('uploads/prestasi/' . $prestasi->foto));
            }

            $file = $request->file('foto');
            $destinationPath = public_path('uploads/prestasi');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $fotoName = 'prestasi_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move($destinationPath, $fotoName);

            $prestasi->foto = $fotoName;
        }

        if($prestasi->nama_prestasi != $request->nama_prestasi) {
            $slugBaru = Str::slug($request->nama_prestasi);
            // Cek duplikat
            if(Prestasi::where('slug', $slugBaru)->where('id', '!=', $id)->exists()){
                 $slugBaru = $slugBaru . '-' . time();
            }
            $prestasi->slug = $slugBaru;
        }

        $prestasi->nama_prestasi = $request->nama_prestasi;
        $prestasi->tingkat = $request->tingkat;
        $prestasi->juara = $request->juara;
        $prestasi->tahun = $request->tahun;
        $prestasi->deskripsi = $request->deskripsi;
        $prestasi->save();

        return redirect()->route('prestasi.index')->with('success', 'Data prestasi berhasil diperbarui!');
    }

    public function destroy(string $id)
    {
        $prestasi = Prestasi::findOrFail($id);

        if ($prestasi->foto && file_exists(public_path('uploads/prestasi/' . $prestasi->foto))) {
            @unlink(public_path('uploads/prestasi/' . $prestasi->foto));
        }

        $prestasi->delete();

        return redirect()->route('prestasi.index')->with('success', 'Data prestasi berhasil dihapus!');
    }
}