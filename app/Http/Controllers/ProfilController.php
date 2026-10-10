<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProfilSekolah;

class ProfilController extends Controller
{
    public function index()
    {
        $profil = ProfilSekolah::firstOrNew(['id' => 1]);

        $daftarFasilitas = collect(explode(',', $profil->fasilitas ?? ''))
                            ->map(fn($fasilitas) => trim($fasilitas))
                            ->filter(fn($fasilitas) => !empty($fasilitas));

        return view('profilsekolah.index', compact('profil', 'daftarFasilitas'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'nama_sekolah'   => 'required|string|max:255',
            'kepala_sekolah' => 'required|string|max:255',
            'npsn'           => 'required|string|max:10',
            'tahun_berdiri'  => 'nullable|digits:4|integer|min:1900|max:' . date('Y'),
            'alamat'         => 'required|string',
            'telepon'        => 'nullable|string|max:20',
            'email'          => 'nullable|email|max:255',
            'visi'           => 'required|string',
            'misi'           => 'required|string',
            'sejarah'        => 'nullable|string',
            'fasilitas'      => 'nullable|string',
            'logo'           => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'foto'           => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'tahun_berdiri.digits' => 'Tahun berdiri harus tepat 4 digit angka (contoh: 1998).',
            'tahun_berdiri.max'    => 'Tahun berdiri tidak boleh melebihi tahun saat ini.',
            'npsn.max'             => 'NPSN maksimal 10 karakter.',
            'logo.max'             => 'Ukuran logo tidak boleh lebih dari 2MB.',
            'foto.max'             => 'Ukuran foto tidak boleh lebih dari 2MB.',
        ]);

        $profil = ProfilSekolah::firstOrNew(['id' => 1]);
        
        $destinationPath = public_path('uploads/profil');
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0755, true);
        }

        if ($request->hasFile('logo')) {
            if ($profil->logo && file_exists(public_path('uploads/profil/' . $profil->logo))) {
                @unlink(public_path('uploads/profil/' . $profil->logo));
            }
            
            $logoFile = $request->file('logo');
            $logoName = 'logo_' . time() . '_' . uniqid() . '.' . $logoFile->getClientOriginalExtension();
            $logoFile->move($destinationPath, $logoName);
            
            $profil->logo = $logoName;
        }

        // 2. Upload & Replace Foto Gedung
        if ($request->hasFile('foto')) {
            if ($profil->foto && file_exists(public_path('uploads/profil/' . $profil->foto))) {
                @unlink(public_path('uploads/profil/' . $profil->foto));
            }
            
            $fotoFile = $request->file('foto');
            $fotoName = 'foto_' . time() . '_' . uniqid() . '.' . $fotoFile->getClientOriginalExtension();
            $fotoFile->move($destinationPath, $fotoName);
            
            $profil->foto = $fotoName;
        }

        $profil->nama_sekolah   = $request->nama_sekolah;
        $profil->kepala_sekolah = $request->kepala_sekolah;
        $profil->npsn           = $request->npsn;
        $profil->tahun_berdiri  = $request->tahun_berdiri;
        $profil->alamat         = $request->alamat;
        $profil->telepon        = $request->telepon;
        $profil->email          = $request->email;
        $profil->visi           = $request->visi;
        $profil->misi           = $request->misi;
        $profil->sejarah        = $request->sejarah;
        $profil->fasilitas      = $request->fasilitas;
        
        $profil->save();

        return redirect()->route('profil')->with('success', 'Data profil sekolah berhasil diperbarui!');
    }
}