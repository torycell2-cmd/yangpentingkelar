<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage; // WAJIB DITAMBAHKAN

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('profile.index', compact('user'));
    }

    public function update(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();

        // 1. JIKA USER MENGINPUT FOTO
        if ($request->hasFile('foto')) {
            $request->validate([
                'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            ]);

            // Hapus foto lama jika ada
            if ($user->foto && Storage::disk('public')->exists($user->foto)) {
                Storage::disk('public')->delete($user->foto);
            }

            $path = $request->file('foto')->store('profile-photos', 'public');
            $user->foto = $path;
            $user->save();

            return redirect()->back()->with('success', 'Foto profil berhasil diperbarui!');
        }

        // 2. JIKA USER MENGUBAH PASSWORD
        if ($request->filled('password')) {
            $request->validate([
                'current_password' => ['required', 'current_password'],
                'password'         => ['required', 'confirmed', 'min:8'],
            ]);

            $user->password = Hash::make($request->password);
            $user->save();

            return redirect()->back()->with('success', 'Password berhasil diperbarui!');
        }

        // 3. JIKA USER MENGUBAH DATA PROFIL (NAMA, EMAIL, PHONE)
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
        ]);

        $user->name  = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->save();

        return redirect()->back()->with('success', 'Data profil berhasil diperbarui!');
    }
    public function show($id)
    {
        $user = \App\Models\User::findOrFail($id);
        $currentUser = auth()->user();

        // Cek apakah sudah berteman (accepted) - dari dua sisi
        $isFriend = $currentUser->friends()->where('friend_id', $id)->where('status', 'accepted')->exists() 
                 || $currentUser->friendRequests()->where('user_id', $id)->where('status', 'accepted')->exists();

    // Cek apakah sedang pending - dari dua sisi
        $isPending = $currentUser->friends()->where('friend_id', $id)->where('status', 'pending')->exists()
                  || $currentUser->friendRequests()->where('user_id', $id)->where('status', 'pending')->exists();

        return view('profile.show', compact('user', 'isFriend', 'isPending'));
    }

  
}