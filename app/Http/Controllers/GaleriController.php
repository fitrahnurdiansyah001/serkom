<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Galeri;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class GaleriController extends Controller
{
    public function index(Request $request)
    {
        $query = Galeri::query();
        if ($request->has('kategori') && !empty($request->kategori)) {
            $query->where('kategori', $request->kategori);
        }

        $semuaGaleri = $query->latest('id_galeri')->get();

        $totalVideo = $semuaGaleri->filter(fn($galeri) => $galeri->kategori === 'Video')->count();

        return view('galeri.index', [
            'galeris' => $semuaGaleri,
            'totalVideo' => $totalVideo
        ]);
    }

    public function show(string $slug)
    {
        // Mencari galeri berdasarkan slug
        $galeri = Galeri::where('slug', $slug)->firstOrFail();
        return view('galeri.show', compact('galeri'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'      => 'required|string|max:50|unique:galeris,judul',
            'keterangan' => 'nullable|string',
            'kategori'   => 'required|in:Foto,Video',
            'tanggal'    => 'required|date',
            'file'       => 'required|file|mimes:jpeg,png,jpg,gif,mp4,webm|max:10240'
        ], [
            'judul.unique' => 'Judul galeri ini sudah ada, silakan gunakan judul yang lain.'
        ]);

        $fileName = null;
        if ($request->hasFile('file')) {
            $uploadedFile = $request->file('file');
            $destinationPath = public_path('uploads/galeri');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $fileName = 'galeri_' . time() . '_' . uniqid() . '.' . $uploadedFile->getClientOriginalExtension();
            $uploadedFile->move($destinationPath, $fileName);
        }

        $slugBaru = Str::slug($request->judul);

        if(Galeri::where('slug', $slugBaru)->exists()) {
             $slugBaru = $slugBaru . '-' . time();
        }

        Galeri::create([
            'judul'      => $request->judul,
            'slug'       => $slugBaru,
            'keterangan' => $request->keterangan,
            'kategori'   => $request->kategori,
            'tanggal'    => $request->tanggal,
            'file'       => $fileName
        ]);

        return redirect()->route('galeri.index')->with('success', 'Data galeri berhasil ditambahkan!');
    }

    public function update(Request $request, string $id)
    {
        $galeri = Galeri::findOrFail($id);
        $primaryKeyName = $galeri->getKeyName();

        // Validasi unique dengan ignore data yang sedang diedit
        $request->validate([
            'judul'      => [
                'required',
                'string',
                'max:50',
                Rule::unique('galeris', 'judul')->ignore($id, $primaryKeyName)
            ],
            'keterangan' => 'nullable|string',
            'kategori'   => 'required|in:Foto,Video',
            'tanggal'    => 'required|date',
            'file'       => 'nullable|file|mimes:jpeg,png,jpg,gif,mp4,webm|max:10240'
        ], [
            'judul.unique' => 'Judul galeri ini sudah digunakan oleh data galeri lain.'
        ]);

        if ($request->hasFile('file')) {
            // Hapus file lama
            if ($galeri->file && file_exists(public_path('uploads/galeri/' . $galeri->file))) {
                @unlink(public_path('uploads/galeri/' . $galeri->file));
            }

            $uploadedFile = $request->file('file');
            $destinationPath = public_path('uploads/galeri');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $fileName = 'galeri_' . time() . '_' . uniqid() . '.' . $uploadedFile->getClientOriginalExtension();
            $uploadedFile->move($destinationPath, $fileName);

            $galeri->file = $fileName;
        }

        if ($galeri->judul != $request->judul) {
            $slugBaru = Str::slug($request->judul);
            // Pengecekan slug menggunakan nama kolom primary key dinamis
            if(Galeri::where('slug', $slugBaru)->where($primaryKeyName, '!=', $id)->exists()){
                 $slugBaru = $slugBaru . '-' . time();
            }
            $galeri->slug = $slugBaru;
        }

        $galeri->judul = $request->judul;
        $galeri->keterangan = $request->keterangan;
        $galeri->kategori = $request->kategori;
        $galeri->tanggal = $request->tanggal;
        $galeri->save();

        return redirect()->route('galeri.index')->with('success', 'Data galeri berhasil diperbarui!');
    }

    public function destroy(string $id)
    {
        $galeri = Galeri::findOrFail($id);

        if ($galeri->file && file_exists(public_path('uploads/galeri/' . $galeri->file))) {
            @unlink(public_path('uploads/galeri/' . $galeri->file));
        }

        $galeri->delete();

        return redirect()->route('galeri.index')->with('success', 'Data galeri berhasil dihapus!');
    }
}