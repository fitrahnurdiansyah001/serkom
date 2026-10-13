<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guru;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str; 
use Illuminate\Validation\Rule;

class GuruController extends Controller
{
    public function index()
    {
        $gurus = Guru::latest()->get();
        $daftarMapel = $gurus->map(fn($guru) => $guru->mata_pelajaran)->filter()->unique();

        return view('guru.index', compact('gurus', 'daftarMapel'));
    }

    public function show(string $slug)
    {
        $guru = Guru::where('slug', $slug)->firstOrFail();
        return view('guru.show', compact('guru'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_guru'      => 'required|string|max:255',
            'jabatan'        => 'nullable|string|max:255',
            'nip'            => 'nullable|string|max:50|unique:guru,nip',
            'mata_pelajaran' => 'nullable|string|max:255',
            'foto'           => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'nip.unique' => 'NIP ini sudah terdaftar. Silakan periksa kembali data guru.'
        ]);

        $guru = new Guru();
        $guru->nama_guru = $request->nama_guru;
        $slugBaru = Str::slug($request->nama_guru);

        if(Guru::where('slug', $slugBaru)->exists()) {
             $slugBaru = $slugBaru . '-' . time();
        }

        $guru->slug = $slugBaru;
        $guru->jabatan = $request->jabatan;
        $guru->nip = $request->nip;
        $guru->mata_pelajaran = $request->mata_pelajaran;

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            
            $destinationPath = public_path('uploads/guru');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move($destinationPath, $filename);
            $guru->foto = $filename;
        }

        $guru->save();

        return redirect()->route('guru.index')->with('success', 'Data guru berhasil ditambahkan!');
    }

    public function update(Request $request, string $id)
    {
        $guru = Guru::findOrFail($id);
        $primaryKeyName = $guru->getKeyName();

        $request->validate([
            'nama_guru'      => 'required|string|max:255',
            'jabatan'        => 'nullable|string|max:255',
            'nip'            => [
                'nullable',
                'string',
                'max:50',
                Rule::unique('guru', 'nip')->ignore($id, $primaryKeyName)
            ],
            'mata_pelajaran' => 'nullable|string|max:255',
            'foto'           => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'nip.unique' => 'NIP ini sudah digunakan oleh data guru lain.'
        ]);

        if ($guru->nama_guru != $request->nama_guru) {
            $slugBaru = Str::slug($request->nama_guru);
            if(Guru::where('slug', $slugBaru)->where($primaryKeyName, '!=', $id)->exists()){
                 $slugBaru = $slugBaru . '-' . time();
            }
            $guru->slug = $slugBaru;
        }

        $guru->nama_guru = $request->nama_guru;
        $guru->jabatan = $request->jabatan;
        $guru->nip = $request->nip;
        $guru->mata_pelajaran = $request->mata_pelajaran;

        if ($request->hasFile('foto')) {
            if ($guru->foto && File::exists(public_path('uploads/guru/' . $guru->foto))) {
                File::delete(public_path('uploads/guru/' . $guru->foto));
            }

            $file = $request->file('foto');
            
            $destinationPath = public_path('uploads/guru');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move($destinationPath, $filename);
            $guru->foto = $filename;
        }

        $guru->save();

        return redirect()->route('guru.index')->with('success', 'Data guru berhasil diperbarui!');
    }

    public function destroy(string $id)
    {
        $guru = Guru::findOrFail($id);

        if ($guru->foto && File::exists(public_path('uploads/guru/' . $guru->foto))) {
            File::delete(public_path('uploads/guru/' . $guru->foto));
        }

        $guru->delete();

        return redirect()->route('guru.index')->with('success', 'Data guru berhasil dihapus!');
    }
}