@extends('layouts.layouts')

@section('content')

<style>
    body {
        background: #f8fafc; 
    }

    .dashboard-title {
        font-weight: 700;
        color: #0f172a;
        letter-spacing: -0.02em;
    }

    .hero-card {
        position: relative;
        overflow: hidden;
        border: none;
        border-radius: 20px;
        background: linear-gradient(135deg, #4f46e5, #2563eb); /* Gradasi Indigo-Blue yang elegan untuk siswa */
        color: #ffffff;
        box-shadow: 0 10px 30px rgba(37, 99, 235, 0.15);
    }

    .hero-card::before {
        content: '';
        position: absolute;
        width: 280px;
        height: 280px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.06);
        top: -80px;
        right: -60px;
    }

    .hero-card::after {
        content: '';
        position: absolute;
        width: 180px;
        height: 180px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.04);
        bottom: -50px;
        right: 120px;
    }

    .hero-content {
        position: relative;
        z-index: 2;
    }

    .search-box-hero {
        background: rgba(255, 255, 255, 0.2);
        border: 1px solid rgba(255, 255, 255, 0.25);
        border-radius: 30px;
        padding: 10px 20px;
        color: white;
        backdrop-filter: blur(4px);
    }

    .search-box-hero::placeholder {
        color: rgba(255, 255, 255, 0.75);
    }

    .search-box-hero:focus {
        background: rgba(255, 255, 255, 0.3);
        border-color: rgba(255, 255, 255, 0.5);
        color: white;
        box-shadow: none;
    }

    .stat-card {
        border: none;
        border-radius: 16px;
        background: #ffffff;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
    }

    .stat-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 20px -3px rgba(0, 0, 0, 0.08), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    }

    .stat-icon {
        width: 52px;
        height: 52px;
        border-radius: 12px;
        display: flex;
        justify-content: center;
        align-items: center;
        color: #ffffff;
        font-size: 20px;
        flex-shrink: 0;
    }

    .table th {
        font-weight: 600;
        color: #475569;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        border-bottom-width: 1px;
    }

    .table td {
        color: #334155;
        font-size: 0.95rem;
        vertical-align: middle;
    }

    .progress {
        background-color: #f1f5f9;
        border-radius: 8px;
        height: 8px;
        overflow: hidden;
    }
    
    .progress-bar {
        border-radius: 8px;
    }

    .progress-lg {
        height: 18px;
    }

    .progress-lg .progress-bar {
        font-size: 0.75rem;
        font-weight: 600;
    }

    .alert {
        border: none;
        border-radius: 12px;
        padding: 14px 16px;
        font-size: 0.9rem;
    }
</style>

<div class="container-fluid px-4 py-3">

    <!-- Header Panel -->
    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-2 mb-4">
        <div>
            <h2 class="dashboard-title m-0">Selamat Datang</h2>
            <p class="text-secondary small m-0">Semangat belajar dan berkarya hari ini.</p>
        </div>
        <span class="badge bg-white text-secondary border px-3 py-2 rounded-pill d-inline-flex align-items-center shadow-sm">
            <i class="far fa-calendar-alt me-2 text-primary"></i>
            {{ now()->translatedFormat('l, d F Y') }}
        </span>
    </div>

    <!-- Hero Card dengan kolom pencarian -->
    <div class="card hero-card mb-4">
        <div class="card-body p-4 p-md-5 hero-content">
            <div class="row align-items-center gy-4">
                <div class="col-lg-8 text-center text-lg-start">
                    <span class="badge bg-white text-primary px-3 py-2 mb-3 rounded-pill fw-semibold shadow-sm">
                        <i class="fas fa-graduation-cap me-2"></i>Student Panel
                    </span>
                    <h2 class="fw-bold mb-2 text-white">Halo, {{ auth()->user()->name ?? 'Siswa' }}!</h2>
                    <p class="mb-4 text-white text-opacity-75 fs-5 fw-light" style="max-width: 600px;">
                        Ayo perluas wawasanmu. Ikuti kuis interaktif dan aktif berdiskusi di forum belajar.
                    </p>
                    
                    <!-- Search Input Box terintegrasi -->
                    <div class="row m-0" style="max-width: 500px;">
                        <div class="input-group p-0">
                            <span class="input-group-text border-0 bg-white bg-opacity-20 text-white rounded-start-pill ps-3"><i class="fas fa-search"></i></span>
                            <input type="text" class="form-control search-box-hero rounded-end-pill" placeholder="Cari kuis atau topik forum di sini...">
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 text-center d-none d-lg-block">
                    <i class="fas fa-laptop-code text-white opacity-25" style="font-size: 140px;"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards (3 Kolom Data Siswa setelah Artikel dihapus) -->
    <div class="row g-3 mb-4">
        <!-- Card Pertanyaan Forum -->
        <div class="col-xl-4 col-md-4">
            <div class="card stat-card h-100">
                <div class="card-body d-flex flex-column justify-content-between p-4">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <span class="text-secondary small fw-medium text-uppercase tracking-wider d-block mb-1">Pertanyaan Forum</span>
                            <h2 class="fw-bold m-0" style="color: #0f172a;">{{ $totalForum ?? 0 }}</h2>
                        </div>
                        <div class="stat-icon bg-info bg-gradient shadow-sm">
                            <i class="fas fa-comments"></i>
                        </div>
                    </div>
                    <div>
                        <div class="progress mb-2">
                            <div class="progress-bar bg-info" style="width: 5%"></div>
                        </div>
                        <span class="text-muted small">Aktif bertanya dan berdiskusi</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card Quiz Selesai -->
        <div class="col-xl-4 col-md-4">
            <div class="card stat-card h-100">
                <div class="card-body d-flex flex-column justify-content-between p-4">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <span class="text-secondary small fw-medium text-uppercase tracking-wider d-block mb-1">Quiz Selesai</span>
                            <h2 class="fw-bold m-0" style="color: #0f172a;">{{ $totalQuiz ?? 0 }}</h2>
                        </div>
                        <div class="stat-icon bg-success bg-gradient shadow-sm">
                            <i class="fas fa-tasks"></i>
                        </div>
                    </div>
                    <div>
                        <div class="progress mb-2">
                            <div class="progress-bar bg-success" style="width: 0%"></div>
                        </div>
                        <span class="text-muted small">Selesaikan latihan mingguan</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card Nilai Saya -->
        <div class="col-xl-4 col-md-4">
            <div class="card stat-card h-100">
                <div class="card-body d-flex flex-column justify-content-between p-4">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <span class="text-secondary small fw-medium text-uppercase tracking-wider d-block mb-1">Nilai Rata-rata</span>
                            <h2 class="fw-bold m-0" style="color: #2563eb;">85</h2>
                        </div>
                        <div class="stat-icon bg-gradient shadow-sm" style="background: linear-gradient(135deg, #ff9900, #ff5500);">
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                    <div>
                        <div class="progress mb-2">
                            <div class="progress-bar bg-warning" style="width: 85%"></div>
                        </div>
                        <span class="text-success small fw-semibold d-inline-flex align-items-center">
                            <i class="fas fa-arrow-up me-1"></i>Sangat Bagus!
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Section -->
    <div class="row g-4">
        <!-- Kolom Kiri: Daftar Tugas/Kuis -->
        <div class="col-lg-8">
            <!-- Quiz & Tugas Terbaru -->
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header bg-white border-0 pt-4 px-4 pb-2">
                    <h5 class="fw-bold mb-0 text-dark">
                        <i class="fas fa-clipboard-list text-danger me-2"></i>Quiz & Latihan Terbaru
                    </h5>
                </div>
                <div class="table-responsive px-2 pb-2">
                    <table class="table table-hover align-middle mb-0">
                        <thead>
                            <tr class="text-muted">
                                <th class="border-0 px-3">Nama Kuis</th>
                                <th class="border-0">Materi</th>
                                <th class="border-0">Batas Waktu</th>
                                <th class="border-0 text-end px-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="px-3 fw-medium text-dark">Kuis Pertemuan 1: Dasar HTML</td>
                                <td><span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill fw-semibold">Web Programming</span></td>
                                <td class="text-danger fw-medium">Hari ini, 23:59</td>
                                <td class="text-end px-3">
                                    <a href="#" class="btn btn-sm btn-primary rounded-pill px-3">Kerjakan</a>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-3 fw-medium text-dark">Evaluasi Bootstrap Layouting</td>
                                <td><span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill fw-semibold">UI/UX Design</span></td>
                                <td class="text-secondary">15 Juli 2026</td>
                                <td class="text-end px-3">
                                    <a href="#" class="btn btn-sm btn-outline-secondary rounded-pill px-3 disabled">Belum Buka</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Kolom Kanan: Info & Progress Belajar -->
        <div class="col-lg-4">
            <!-- Progress Tracker -->
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-header bg-white border-0 pt-4 px-4 pb-2">
                    <h5 class="fw-bold mb-0 text-dark">
                        <i class="fas fa-chart-line text-success me-2"></i>Progress Belajar Bulan Ini
                    </h5>
                </div>
                <div class="card-body px-4 pb-4">
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <span class="small fw-semibold text-secondary">Kuis Terselesaikan</span>
                            <span class="small fw-bold text-success">80%</span>
                        </div>
                        <div class="progress progress-lg">
                            <div class="progress-bar bg-success" style="width:80%">80%</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tips Belajar Hari Ini -->
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header bg-white border-0 pt-4 px-4 pb-2">
                    <h5 class="fw-bold mb-0 text-dark">
                        <i class="far fa-lightbulb text-warning me-2"></i>Tips Belajar Efektif
                    </h5>
                </div>
                <div class="card-body px-4 pb-4">
                    <div class="alert alert-info d-flex align-items-start gap-2 mb-0">
                        <i class="fas fa-info-circle mt-1"></i>
                        <div>
                            <strong class="d-block mb-1 text-dark">Gunakan AI Tutor!</strong>
                            Gunakan menu <strong>AI Tutor</strong> di bilah navigasi kiri jika kamu mengalami kesulitan memahami baris kode tertentu secara real-time.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Space -->
    <div class="card border-0 shadow-sm rounded-4 mt-4">
        <div class="card-body p-4">
            <div class="row align-items-center gy-2">
                <div class="col-md-8 text-center text-md-start">
                    <h6 class="fw-bold mb-1 text-dark">EduLearn Student Portal</h6>
                    <p class="text-secondary small m-0">Kembangkan potensimu tanpa batas bersama rekan dan pengajarmu.</p>
                </div>
                <div class="col-md-4 text-center text-md-end">
                    <small class="text-muted">©️ {{ date('Y') }} EduLearn. All rights reserved.</small>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection