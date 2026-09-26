<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;
use Illuminate\Support\Facades\Auth;

class BeritaController extends Controller
{
    // Menampilkan daftar berita
    public function index()
    {
        $beritas = Berita::latest('tanggal')->get();
        return view('berita.index', compact('beritas'));
    }

    // Menyimpan berita baru (Admin/Operator)
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:50',
            'isi' => 'required',
            'tanggal' => 'required|date',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:Publish,Draft'
        ]);

        $gambarName = null;
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $gambarName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/berita'), $gambarName);
        }

        Berita::create([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'tanggal' => $request->tanggal,
            'gambar' => $gambarName,
            'status' => $request->status,
            'id_user' => Auth::id() // Menyimpan ID user yang sedang login
        ]);

        return redirect()->route('berita.index')->with('success', 'Berita berhasil diterbitkan!');
    }

    // Memperbarui berita
    public function update(Request $request, $id)
    {
        $berita = Berita::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:50',
            'isi' => 'required',
            'tanggal' => 'required|date',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:Publish,Draft'
        ]);

        if ($request->hasFile('gambar')) {
            if ($berita->gambar && file_exists(public_path('uploads/berita/' . $berita->gambar))) {
                unlink(public_path('uploads/berita/' . $berita->gambar));                   
            }

            $file = $request->file('gambar');
            $gambarName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/berita'), $gambarName);
            $berita->gambar = $gambarName;
        }

        $berita->judul = $request->judul;
        $berita->isi = $request->isi;
        $berita->tanggal = $request->tanggal;
        $berita->status = $request->status;
        $berita->save();

        return redirect()->route('berita.index')->with('success', 'Berita berhasil diperbarui!');
    }

    // Menghapus berita
    public function destroy($id)
    {
        $berita = Berita::findOrFail($id);
        if ($berita->gambar && file_exists(public_path('uploads/berita/' . $berita->gambar))) {
            unlink(public_path('uploads/berita/' . $berita->gambar));
        }
        $berita->delete();

        return redirect()->route('berita.index')->with('success', 'Berita berhasil dihapus!');
    }
}