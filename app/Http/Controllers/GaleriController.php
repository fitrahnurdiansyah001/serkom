<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Galeri;

class GaleriController extends Controller
{
    public function index()
    {
        $galeris = Galeri::latest('tanggal')->get();
        return view('galeri.index', compact('galeris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:50',
            'keterangan' => 'nullable|string',
            'file' => 'required|image|mimes:jpeg,png,jpg,gif|max:6000',
            'kategori' => 'required|in:Foto,Video',
            'tanggal' => 'required|date'
        ]);

        $fileName = null;
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/galeri'), $fileName);
        }

        Galeri::create([
            'judul' => $request->judul,
            'keterangan' => $request->keterangan,
            'file' => $fileName,
            'kategori' => $request->kategori,
            'tanggal' => $request->tanggal
        ]);

        return redirect()->route('galeri.index')->with('success', 'Dokumentasi galeri berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $galeri = Galeri::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:50',
            'keterangan' => 'nullable|string',
            'file' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:6000', // Diubah ke nullable
            'kategori' => 'required|in:Foto,Video',
            'tanggal' => 'nullable|date'
        ]);

        // Cek jika ada file baru yang diunggah
        if ($request->hasFile('file')) {
            // Hapus file lama jika ada
            if ($galeri->file && file_exists(public_path('uploads/galeri/' . $galeri->file))) {
                unlink(public_path('uploads/galeri/' . $galeri->file));
            }

            // Simpan file baru
            $file = $request->file('file');
            $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/galeri'), $fileName);
            
            $galeri->file = $fileName;
        }

        $galeri->judul = $request->judul;
        $galeri->keterangan = $request->keterangan;
        $galeri->kategori = $request->kategori;
        
        if ($request->has('tanggal')) {
            $galeri->tanggal = $request->tanggal;
        }

        $galeri->save();

        return redirect()->route('galeri.index')->with('success', 'Dokumentasi galeri berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $galeri = Galeri::findOrFail($id);
        
        if ($galeri->file && file_exists(public_path('uploads/galeri/' . $galeri->file))) {
            unlink(public_path('uploads/galeri/' . $galeri->file));
        }
        
        $galeri->delete();

        return redirect()->route('galeri.index')->with('success', 'Dokumentasi galeri berhasil dihapus!');
    }
}