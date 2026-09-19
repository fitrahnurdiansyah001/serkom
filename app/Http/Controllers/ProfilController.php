<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProfilSekolah;

class ProfilController extends Controller
{
    public function index()
    {
        $profil = ProfilSekolah::firstOrNew(['id' => 1]);
        return view('profilsekolah.index', compact('profil'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'nama_sekolah' => 'required|string|max:255',
            'kepala_sekolah' => 'required|string|max:255',
            'npsn' => 'required|string|max:50',
            'visi' => 'required',
            'misi' => 'required',
            'alamat' => 'required',
        ]);

        ProfilSekolah::updateOrCreate(
            ['id' => 1],
            [
                'nama_sekolah' => $request->nama_sekolah,
                'kepala_sekolah' => $request->kepala_sekolah,
                'npsn' => $request->npsn,
                'tahun_berdiri' => $request->tahun_berdiri,
                'alamat' => $request->alamat,
                'telepon' => $request->telepon,
                'email' => $request->email,
                'visi' => $request->visi,
                'misi' => $request->misi,
                'sejarah' => $request->sejarah,
                'fasilitas' => $request->fasilitas,
            ]
        );

        return redirect()->route('profil')->with('success', 'Data profil sekolah berhasil diperbarui!');
    }
}