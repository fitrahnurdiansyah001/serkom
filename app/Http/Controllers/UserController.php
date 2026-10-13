<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->get();
        return view('users.index', compact('users'));
    }

    public function store(Request $request)
    {
        // Hanya admin yang diizinkan menambah
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('users.index')->with('error', 'Akses ditolak. Anda bukan admin.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'role' => 'required|in:admin,operator',
            'password' => 'required|string|min:6'
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'role' => $request->role,
            'status' => 'active',
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('users.index')->with('success', 'Akun pengguna baru berhasil dibuat!');
    }

    public function update(Request $request,string $id)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('users.index')->with('error', 'Akses ditolak. Anda bukan admin.');
        }

        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id, 
            'role' => 'required|in:admin,operator',
            'status' => 'required|in:active,non active',
            'password' => 'nullable|string|min:6' 
        ]);

        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->status = $request->status;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('users.index')->with('success', 'Data akun pengguna berhasil diperbarui!');
    }

    public function destroy(string $id)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('users.index')->with('error', 'Akses ditolak. Anda bukan admin.');
        }

        if (Auth::id() == $id) {
            return redirect()->route('users.index')->with('error', 'Anda tidak dapat menghapus akun yang sedang Anda gunakan.');
        }

        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'Akun pengguna berhasil dihapus!');
    }
}