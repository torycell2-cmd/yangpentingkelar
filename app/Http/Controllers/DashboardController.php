<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Jangan lupa import model User

class DashboardController extends Controller
{
    public function index()
    {
        if (auth()->check()) {    
            $user = auth()->user();
            
            // Ambil data user untuk daftar teman (Add Friend)
            $users = User::where('id', '!=', auth()->id())
                         ->inRandomOrder()
                         ->limit(5)
                         ->get();

            if ($user->role == 'admin') {
                return view('admin.dashboard');
            } 
            
            elseif ($user->role == 'guru') {
                // KIRIM $users ke view guru
                return view('guru.dashboard', compact('users'));
            } 
            
            elseif ($user->role == 'siswa') {
                // KIRIM $users ke view siswa jika ingin tampil di sana juga
                return view('siswa.dashboard', compact('users') + [
                    'totalArtikel' => 0,
                    'totalQuestion' => 0,
                    'totalQuiz' => 0,
                    'totalForum' => 0,
                ]);
            }
        }

        // Fallback jika role tidak terdeteksi
        return view('dashboard.index', [
            'totalArtikel' => 0,
            'totalQuestion' => 0,
            'totalQuiz' => 0,
            'totalForum' => 0,
        ]);
    }
}