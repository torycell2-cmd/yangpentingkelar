<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Forum;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\QuizResult;
use App\Models\Article;
use App\Models\ActivityLog;

class DashboardController extends Controller
{
    public function index()
    {
        if (auth()->check()) {
            $user = auth()->user();

            // Ambil data user untuk daftar teman
            $users = User::where('id', '!=', $user->id)
                         ->inRandomOrder()
                         ->limit(5)
                         ->get();
            

            if ($user->role == 'admin') {
                // 1. Ambil 5 data guru terbaru
                $recentGurus = User::where('role', 'guru')->latest()->take(5)->get();

                // 2. AMBIL 5 DATA SISWA TERBARU (Tambahan agar muncul di tabel siswa)
                $recentSiswas = User::where('role', 'siswa')->latest()->take(5)->get();

                // 3. Buat data aktivitas dinamis berdasarkan user yang baru mendaftar
                $recentActivities = User::latest()
                    ->take(5)
                    ->get()
                    ->map(function ($u) {
                        return [
                            'type' => $u->role === 'guru' ? 'primary' : 'success',
                            'title' => 'Pengguna Baru Terdaftar',
                            'description' => "Akun {$u->role} baru atas nama {$u->name} telah terdaftar.",
                            'time' => $u->created_at ? $u->created_at->diffForHumans() : '-'
                        ];
                    });

                    return view('admin.dashboard', compact('recentGurus', 'recentSiswas', 'recentActivities'));
            }

            elseif ($user->role == 'guru') {
                // GURU: hitung berdasarkan konten yang dia buat
                $counts = [
                    'totalArtikel'  => Article::where('author', $user->name)->count(),
                    'totalQuestion' => Question::whereHas('quiz', function ($q) use ($user) {
                                            $q->where('pembuat', $user->id);
                                        })->count(),
                    'totalQuiz'     => Quiz::where('pembuat', $user->id)->count(),
                    'totalForum'    => Forum::where('user_id', $user->id)->count(),
                ];

                return view('guru.dashboard', compact('users') + $counts);
            }

            elseif ($user->role == 'siswa') {
                // SISWA: hitung berdasarkan aktivitas belajar dia
                $counts = [
                    'totalForum'   => Forum::where('user_id', $user->id)->count(),
                    'totalQuiz' => QuizResult::where('user_id', $user->id)->count(),
                    'rataNilai'    => round(QuizResult::where('user_id', $user->id)->avg('nilai') ?? 0),
                ];

                $availableQuizzes = Quiz::latest()->take(5)->get();
                $recentResults    = QuizResult::with('quiz')
                            ->where('user_id', $user->id)
                            ->latest()
                            ->take(5)
                            ->get();

                return view('siswa.dashboard', compact('users', 'availableQuizzes', 'recentResults') + $counts);            }
        }

        // Fallback jika belum login / role tidak terdeteksi
        return view('dashboard.index', [
            'totalArtikel' => 0,
            'totalQuestion' => 0,
            'totalQuiz' => 0,
            'totalForum' => 0,
        ]);
    }
}