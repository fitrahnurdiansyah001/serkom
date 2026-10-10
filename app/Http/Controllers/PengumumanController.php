<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengumuman;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PengumumanController extends Controller
{
    public function index(Request $request)
{
    $query = Pengumuman::query();

    if ($request->has('status') && !empty($request->status)) {
        $query->where('status', $request->status);
    }
    
    $pengumumans = $query->latest()->get();

    $totalPublish = $pengumumans->filter(fn($pengumuman) => $pengumuman->status === 'Publish')->count();

    return view('pengumuman.index', compact('pengumumans', 'totalPublish'));
}

    public function show(string $slug)
    {
        // Mencari pengumuman berdasarkan slug
        $pengumuman = Pengumuman::where('slug', $slug)->firstOrFail();
        return view('pengumuman.show', compact('pengumuman'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'   => 'required|string|max:255',
            'tanggal' => 'required|date',
            'status'  => 'required|in:Publish,Draft',
            'isi'     => 'required|string',
            'foto'    => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $pengumuman = new Pengumuman();
        $pengumuman->judul = $request->judul;
        
        $slugBaru = Str::slug($request->judul);
        
        if(Pengumuman::where('slug', $slugBaru)->exists()) {
             $slugBaru = $slugBaru . '-' . time();
        }
        $pengumuman->slug = $slugBaru; 

        $pengumuman->tanggal = $request->tanggal;
        $pengumuman->status = $request->status;
        $pengumuman->isi = $request->isi;
        $pengumuman->id_user = Auth::id();

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/pengumuman'), $filename);
            $pengumuman->foto = $filename;
        }

        $pengumuman->save();

        return redirect()->route('pengumuman.index')->with('success', 'Pengumuman berhasil ditambahkan!');
    }

    public function update(Request $request, string $id)
    {
        $pengumuman = Pengumuman::findOrFail($id);

        $request->validate([
            'judul'   => 'required|string|max:255',
            'tanggal' => 'required|date',
            'status'  => 'required|in:Publish,Draft',
            'isi'     => 'required|string',
            'foto'    => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($pengumuman->judul != $request->judul) {
            $slugBaru = Str::slug($request->judul);
            // Cek agar slug tidak kembar dengan pengumuman lain (kecuali pengumuman ini sendiri)
            if(Pengumuman::where('slug', $slugBaru)->where('id', '!=', $id)->exists()){
                 $slugBaru = $slugBaru . '-' . time();
            }
            $pengumuman->slug = $slugBaru;
        }

        $pengumuman->judul = $request->judul;
        $pengumuman->tanggal = $request->tanggal;
        $pengumuman->status = $request->status;
        $pengumuman->isi = $request->isi;

        if ($request->hasFile('foto')) {
            if ($pengumuman->foto && File::exists(public_path('uploads/pengumuman/' . $pengumuman->foto))) {
                File::delete(public_path('uploads/pengumuman/' . $pengumuman->foto));
            }

            $file = $request->file('foto');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/pengumuman'), $filename);
            $pengumuman->foto = $filename;
        }

        $pengumuman->save();

        return redirect()->route('pengumuman.index')->with('success', 'Pengumuman berhasil diperbarui!');
    }

    public function destroy(string $id)
    {
        $pengumuman = Pengumuman::findOrFail($id);

        if ($pengumuman->foto && File::exists(public_path('uploads/pengumuman/' . $pengumuman->foto))) {
            File::delete(public_path('uploads/pengumuman/' . $pengumuman->foto));
        }

        $pengumuman->delete();

        return redirect()->route('pengumuman.index')->with('success', 'Pengumuman berhasil dihapus!');
    }
}