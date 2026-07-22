<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ActivityLog;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        // 1. Ambil 5 akun guru terbaru
        $recentGurus = User::whereRaw('LOWER(role) = ?', ['guru'])
                            ->latest()
                            ->take(5)
                            ->get();

        // 2. Ambil 5 akun siswa terbaru 
        $recentSiswas = User::whereNotIn(DB::raw('LOWER(role)'), ['guru', 'admin'])
                             ->latest()
                             ->take(5)
                             ->get();

        // 3. Ambil 5 aktivitas sistem terbaru
        $recentActivities = ActivityLog::latest()->take(5)->get();

        return view('admin.dashboard', compact('recentGurus', 'recentSiswas', 'recentActivities'));
    }

    public function getStats()
    {
        // Total & Siswa Baru (Mengabaikan role admin dan guru)
        $totalSiswa = User::whereNotIn(DB::raw('LOWER(role)'), ['guru', 'admin'])->count();
        
        $siswaBaru  = User::whereNotIn(DB::raw('LOWER(role)'), ['guru', 'admin'])
                          ->whereMonth('created_at', now()->month)
                          ->whereYear('created_at', now()->year)
                          ->count();

        $guruAktif  = User::whereRaw('LOWER(role) = ?', ['guru'])
                          ->whereRaw('LOWER(status) = ?', ['aktif'])
                          ->count();

        $guruKeluar = User::whereRaw('LOWER(role) = ?', ['guru'])
                          ->whereIn(DB::raw('LOWER(status)'), ['non-aktif', 'nonaktif', 'keluar'])
                          ->count();

        return response()->json([
            'status'      => 'success',
            'total_siswa' => $totalSiswa,
            'siswa_baru'  => $siswaBaru,
            'guru_aktif'  => $guruAktif,
            'guru_keluar' => $guruKeluar,
        ]);
    }

    public function toggleStatus($id)
    {
        $user = User::findOrFail($id);

        // Toggle status akun
        $user->status = (strtolower($user->status) === 'aktif') ? 'non-aktif' : 'aktif';
        $user->save();

        // Catat otomatis ke ActivityLog
        ActivityLog::create([
            'title'       => 'Perubahan Status Akun',
            'description' => 'Status akun ' . $user->role . ' (' . $user->name . ') diubah menjadi ' . $user->status . '.',
            'type'        => (strtolower($user->status) === 'aktif') ? 'success' : 'warning',
        ]);

        return back()->with('success', 'Status akun berhasil diperbarui!');
    }
}