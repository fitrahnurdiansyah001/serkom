<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Program;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ProgramController extends Controller
{
    public function index()
    {
        $programs = Program::latest('id_program')->get();
        return view('program.index', compact('programs'));
    }

    public function store(Request $request)
    {
        // Tambahkan unique:programs,nama_program dan pesan khusus
        $request->validate([
            'nama_program' => 'required|string|max:255|unique:programs,nama_program',
            'deskripsi'    => 'required|string',
        ], [
            'nama_program.unique' => 'Nama program ini sudah ada, silakan gunakan nama yang lain.'
        ]);

        $slugBaru = Str::slug($request->nama_program);
        
        // Cek duplikasi slug
        if(Program::where('slug', $slugBaru)->exists()) {
             $slugBaru = $slugBaru . '-' . time();
        }

        Program::create([
            'nama_program' => $request->nama_program,
            'slug'         => $slugBaru,
            'deskripsi'    => $request->deskripsi,
        ]);

        return redirect()->back()->with('success', 'Program baru berhasil ditambahkan!');
    }

    public function update(Request $request, string $id)
    {
        $program = Program::findOrFail($id);
        $primaryKeyName = $program->getKeyName();

        // Validasi unique dengan ignore data yang sedang diedit
        $request->validate([
            'nama_program' => [
                'required',
                'string',
                'max:255',
                Rule::unique('programs', 'nama_program')->ignore($id, $primaryKeyName)
            ],
            'deskripsi'    => 'required|string',
        ], [
            'nama_program.unique' => 'Nama program ini sudah digunakan oleh program lain.'
        ]);

        $slugBaru = $program->slug;

        // Jika nama program diubah, buat slug baru
        if ($program->nama_program != $request->nama_program) {
            $slugBaru = Str::slug($request->nama_program);
            // Cek agar slug tidak kembar
            if(Program::where('slug', $slugBaru)->where($primaryKeyName, '!=', $id)->exists()){
                 $slugBaru = $slugBaru . '-' . time();
            }
        }

        $program->update([
            'nama_program' => $request->nama_program,
            'slug'         => $slugBaru,
            'deskripsi'    => $request->deskripsi,
        ]);

        return redirect()->back()->with('success', 'Program berhasil diperbarui!');
    }

    public function destroy(string $id)
    {
        $program = Program::findOrFail($id);
        $program->delete();

        return redirect()->back()->with('success', 'Program berhasil dihapus!');
    }
}