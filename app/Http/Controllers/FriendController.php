<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FriendController extends Controller
{
    public function addFriend($friend_id)
    {
        $user = Auth::user();

        // 1. Cek: Nggak boleh nambahin diri sendiri dong wkwk
        if ($user->id == $friend_id) {
            return back()->with('error', 'Tidak bisa menambahkan diri sendiri!');
        }

        // 2. Cek: Apakah sudah berteman sebelumnya?
        if (!$user->friends->contains($friend_id)) {
            // Kalau belum, masukkan ke database!
            $user->friends()->attach($friend_id);
            return back()->with('success', 'Berhasil menambahkan teman! Gagah kos beko!');
        }

        // Kalau ternyata sudah berteman
        return back()->with('error', 'Kalian sudah berteman!');
    }
    public function index()
    {
    // Mengambil semua teman dari user yang sedang login
        $friends = auth()->user()->friends;
        return view('friends.index', compact('friends'));
    }

    public function unfriend($friend_id)
    {
    // Menghapus relasi pertemanan
        auth()->user()->friends()->detach($friend_id);
        return back()->with('success', 'Teman berhasil dihapus.');
    }
}