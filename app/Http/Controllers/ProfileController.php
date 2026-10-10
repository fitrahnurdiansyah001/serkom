<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('profile.index');
    }

    // Memproses perubahan data profil
    public function update(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'password' => 'nullable|min:8|confirmed'
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        // Logika Upload Foto Profil    
        if ($request->hasFile('photo')) {
            if ($user->photo && file_exists(public_path('uploads/profiles/' . $user->photo))) {
                unlink(public_path('uploads/profiles/' . $user->photo));
            }

            $file = $request->file('photo');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

            $file->move(public_path('uploads/profiles'), $filename);

            $user->photo = $filename;
        }

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->back()->with('success', 'Profil dan foto berhasil diperbarui!');
    }
}
