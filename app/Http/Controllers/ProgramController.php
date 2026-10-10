<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Program;
use Illuminate\Support\Str;

class ProgramController extends Controller
{
    public function index()
    {
        $programs = Program::latest('id_program')->get();
        return view('program.index', compact('programs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_program' => 'required|string|max:255',
            'deskripsi'    => 'required|string',
        ]);

        Program::create([
            'nama_program' => $request->nama_program,
            'slug'         => Str::slug($request->nama_program),
            'deskripsi'    => $request->deskripsi,
        ]);

        return redirect()->back()->with('success', 'Program baru berhasil ditambahkan!');
    }

    public function update(Request $request, string $id)
    {
        $program = Program::findOrFail($id);
        
        $request->validate([
            'nama_program' => 'required|string|max:255',
            'deskripsi'    => 'required|string',
        ]);

        $program->update([
            'nama_program' => $request->nama_program,
            'slug'         => Str::slug($request->nama_program),
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