<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ekstrakurikuler;

class EkskulController extends Controller
{
    // Menampilkan daftar ekstrakurikuler
    public function index()
    {
        $eskuls = Ekstrakurikuler::all();
        return view('ekstrakurikuler.index', compact('eskuls'));
    }

    // Menyimpan data ekstrakurikuler baru (Admin)
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
            $fotoName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/eskul'), $fotoName);
        }

        Ekstrakurikuler::create([
            'nama_ekskul' => $request->nama_ekskul,
            'pembina' => $request->pembina,
            'jadwal' => $request->jadwal,
            'deskripsi' => $request->deskripsi,
            'foto' => $fotoName
        ]);

        return redirect()->route('ekskul.index')->with('success', 'Ekstrakurikuler baru berhasil ditambahkan!');
    }

    // Memperbarui data ekstrakurikuler (Admin)
    public function update(Request $request, $id)
    {
        $eskul = Ekstrakurikuler::findOrFail($id);

        $request->validate([
            'nama_ekskul' => 'required|string|max:255',
            'pembina' => 'required|string|max:255',
            'jadwal' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('foto')) {
            if ($eskul->foto && file_exists(public_path('uploads/eskul/' . $eskul->foto))) {
                unlink(public_path('uploads/eskul/' . $eskul->foto));
            }

            $file = $request->file('foto');
            $fotoName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/eskul'), $fotoName);
            $eskul->foto = $fotoName;
        }

        $eskul->nama_ekskul = $request->nama_ekskul;
        $eskul->pembina = $request->pembina;
        $eskul->jadwal = $request->jadwal;
        $eskul->deskripsi = $request->deskripsi;
        $eskul->save();

        return redirect()->route('ekskul.index')->with('success', 'Data ekstrakurikuler berhasil diperbarui!');
    }

    // Menghapus data ekstrakurikuler (Admin)
    public function destroy($id)
    {
        $eskul = Ekstrakurikuler::findOrFail($id);
        if ($eskul->foto && file_exists(public_path('uploads/eskul/' . $eskul->foto))) {
            unlink(public_path('uploads/eskul/' . $eskul->foto));
        }
        $eskul->delete();

        return redirect()->route('ekskul.index')->with('success', 'Ekstrakurikuler berhasil dihapus!');
    }
}