<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class BeritaController extends Controller
{
    public function index(Request $request)
    {
        $query = Berita::query();
        if ($request->has('status') && !empty($request->status)) {
            $query->where('status', $request->status);
        }

        $beritas = $query->latest()->get();
        $totalPublish = $beritas->filter(fn($berita) => $berita->status === 'Publish')->count();

        return view('berita.index', compact('beritas', 'totalPublish'));
    }

    public function show(string $slug)
    {
        $berita = Berita::where('slug', $slug)->firstOrFail();
        return view('berita.show', compact('berita'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'   => 'required|string|max:255|unique:berita,judul',
            'tanggal' => 'required|date',
            'status'  => 'required|string',
            'penulis' => 'nullable|string|max:255',
            'isi'     => 'required|string',
            'gambar'  => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'judul.unique' => 'Judul berita ini sudah ada, silakan gunakan judul yang lain.'
        ]);

        $berita = new Berita();
        $berita->judul = $request->judul;
        $slugBaru = Str::slug($request->judul);

        if(Berita::where('slug', $slugBaru)->exists()) {
             $slugBaru = $slugBaru . '-' . time();
        }

        $berita->slug = $slugBaru;
        $berita->tanggal = $request->tanggal;
        $berita->status = $request->status;
        $berita->penulis = $request->penulis ?? (Auth::user()->name ?? 'Admin Sekolah');
        
        $berita->id_user = Auth::id() ?? 1; 
        $berita->isi = $request->isi;

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            
            // Pengecekan folder agar tidak error saat diupload
            $destinationPath = public_path('uploads/berita');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move($destinationPath, $filename);
            $berita->gambar = $filename;
        }

        $berita->save();

        return redirect()->route('berita.index')->with('success', 'Berita berhasil ditambahkan!');
    }

    public function update(Request $request, string $id)
    {
        $berita = Berita::findOrFail($id);
        $primaryKeyName = $berita->getKeyName();

        $request->validate([
            'judul'   => [
                'required',
                'string',
                'max:255',
                Rule::unique('berita', 'judul')->ignore($id, $primaryKeyName)
            ],
            'tanggal' => 'required|date',
            'status'  => 'required|string',
            'penulis' => 'nullable|string|max:255',
            'isi'     => 'required|string',
            'gambar'  => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'judul.unique' => 'Judul berita ini sudah digunakan oleh berita lain.'
        ]);

        if ($berita->judul != $request->judul) {
            $slugBaru = Str::slug($request->judul);

            if(Berita::where('slug', $slugBaru)->where($primaryKeyName, '!=', $id)->exists()){
                 $slugBaru = $slugBaru . '-' . time();
            }
            $berita->slug = $slugBaru;
        }

        $berita->judul = $request->judul;
        $berita->tanggal = $request->tanggal;
        $berita->status = $request->status;
        $berita->penulis = $request->penulis ?? $berita->penulis; 

        $berita->id_user = Auth::id() ?? $berita->id_user ?? 1;

        $berita->isi = $request->isi;

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama
            if ($berita->gambar && File::exists(public_path('uploads/berita/' . $berita->gambar))) {
                File::delete(public_path('uploads/berita/' . $berita->gambar));
            }

            $file = $request->file('gambar');
            
            // Pengecekan folder
            $destinationPath = public_path('uploads/berita');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move($destinationPath, $filename);
            $berita->gambar = $filename;
        }

        $berita->save();

        return redirect()->route('berita.index')->with('success', 'Berita berhasil diperbarui!');
    }

    public function destroy(string $id)
    {
        $berita = Berita::findOrFail($id);

        if ($berita->gambar && File::exists(public_path('uploads/berita/' . $berita->gambar))) {
            File::delete(public_path('uploads/berita/' . $berita->gambar));
        }

        $berita->delete();

        return redirect()->route('berita.index')->with('success', 'Berita berhasil dihapus!');
    }
}