<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ekstrakurikuler;
use Illuminate\Support\Str;

class EkskulController extends Controller
{
    public function index()
    {
        $ekstrakurikulers = Ekstrakurikuler::latest()->get();

        $daftarNamaEkskul = $ekstrakurikulers->map(fn($ekstrakurikuler) => $ekstrakurikuler->nama_ekskul);

        return view('ekstrakurikuler.index', compact('ekstrakurikulers', 'daftarNamaEkskul'));
    }

    public function show(string $slug)
    {
        $ekstrakurikuler = Ekstrakurikuler::where('slug', $slug)->firstOrFail();
        return view('ekstrakurikuler.show', compact('ekstrakurikuler'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_ekskul' => 'required|string|max:255',
            'pembina' => 'required|string|max:255',
            'jadwal' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $fotoName = null;
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $destinationPath = public_path('uploads/ekstrakurikuler');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $fotoName = 'ekskul_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move($destinationPath, $fotoName);
        }
        
        $slugBaru = Str::slug($request->nama_ekskul);

        if(Ekstrakurikuler::where('slug', $slugBaru)->exists()) {
             $slugBaru = $slugBaru . '-' . time();
        }

        Ekstrakurikuler::create([
            'nama_ekskul' => $request->nama_ekskul,
            'slug'        => $slugBaru, // Menyimpan slug
            'pembina'     => $request->pembina,
            'jadwal'      => $request->jadwal,
            'deskripsi'   => $request->deskripsi,
            'foto'        => $fotoName
        ]);

        return redirect()->route('ekskul.index')->with('success', 'Data ekstrakurikuler berhasil ditambahkan!');
    }

    public function update(Request $request, string $id)
    {
        $ekskul = Ekstrakurikuler::findOrFail($id);

        $request->validate([
            'nama_ekskul' => 'required|string|max:255',
            'pembina' => 'required|string|max:255',
            'jadwal' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($ekskul->foto && file_exists(public_path('uploads/ekstrakurikuler/' . $ekskul->foto))) {
                @unlink(public_path('uploads/ekstrakurikuler/' . $ekskul->foto));
            }

            $file = $request->file('foto');
            $destinationPath = public_path('uploads/ekstrakurikuler');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $fotoName = 'ekskul_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move($destinationPath, $fotoName);

            $ekskul->foto = $fotoName;
        }

        if ($ekskul->nama_ekskul != $request->nama_ekskul) {
            $slugBaru = Str::slug($request->nama_ekskul);
            
            // PERBAIKAN: Menggunakan getKeyName() agar mendeteksi nama primary key secara otomatis
            if(Ekstrakurikuler::where('slug', $slugBaru)->where($ekskul->getKeyName(), '!=', $id)->exists()){
                 $slugBaru = $slugBaru . '-' . time();
            }
            $ekskul->slug = $slugBaru;
        }

        $ekskul->nama_ekskul = $request->nama_ekskul;
        $ekskul->pembina = $request->pembina;
        $ekskul->jadwal = $request->jadwal;
        $ekskul->deskripsi = $request->deskripsi;
        $ekskul->save();

        return redirect()->route('ekskul.index')->with('success', 'Data ekstrakurikuler berhasil diperbarui!');
    }

    public function destroy(string $id)
    {
        $ekskul = Ekstrakurikuler::findOrFail($id);

        if ($ekskul->foto && file_exists(public_path('uploads/ekstrakurikuler/' . $ekskul->foto))) {
            @unlink(public_path('uploads/ekstrakurikuler/' . $ekskul->foto));
        }

        $ekskul->delete();

        return redirect()->route('ekskul.index')->with('success', 'Data ekstrakurikuler berhasil dihapus!');
    }
}