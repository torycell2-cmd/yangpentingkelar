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
        // 1. Validasi file yang diupload (harus gambar, max 2MB)
        $request->validate([
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user = Auth::user();

        // 2. Cek apakah ada file foto yang diupload
        if ($request->hasFile('foto')) {
            
            // Hapus foto profil lama jika ada di storage (biar gak numpuk)
            if ($user->foto && Storage::disk('public')->exists($user->foto)) {
                Storage::disk('public')->delete($user->foto);
            }

            // Simpan foto baru ke folder 'profile_photos' di dalam storage/app/public
            $file = $request->file('foto');
            $path = $file->store('profile_photos', 'public');
            
            // Simpan path foto ke dalam kolom 'foto' di database
            $user->foto = $path;
            $user->save();
        }

        // 3. Kembalikan ke halaman profil dengan pesan sukses
        return redirect()->back()->with('success', 'Foto profil berhasil diperbarui!');
    }
}