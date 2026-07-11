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

    /* Style Tambahan untuk Dropdown Profil Ala Copilot/Modern */
    .profile-dropdown-menu {
        border: none;
        border-radius: 20px;
        background: #1e293b; /* Dark theme ala gambar pertama */
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.25);
        padding: 20px;
        min-width: 280px;
    }

    .profile-dropdown-menu .user-name {
        color: #ffffff;
        font-weight: 600;
        font-size: 1.1rem;
    }

    .profile-dropdown-menu .user-email {
        color: #94a3b8;
        font-size: 0.85rem;
    }

    .profile-dropdown-menu .dropdown-item {
        color: #cbd5e1;
        padding: 10px 12px;
        border-radius: 10px;
        transition: all 0.2s;
    }

    .profile-dropdown-menu .dropdown-item:hover {
        background: rgba(255, 255, 255, 0.05);
        color: #ffffff;
    }

    .profile-dropdown-menu .btn-signout {
        background: rgba(255, 255, 255, 0.1);
        color: #ffffff;
        border: none;
        border-radius: 12px;
        font-weight: 600;
        transition: all 0.2s;
    }

    .profile-dropdown-menu .btn-signout:hover {
        background: #ef4444; /* Berubah merah saat hover */
        color: #ffffff;
    }

    .avatar-circle {
        width: 40px;
        height: 40px;
        background-color: #3b82f6;
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        cursor: pointer;
    }

    /* Style Bawaan Anda sebelumnya */
    .hero-card {
        position: relative;
        overflow: hidden;
        border: none;
        border-radius: 20px;
        background: linear-gradient(135deg, #3b82f6, #1d4ed8); 
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

    .quick-card {
        border: 1px solid #f1f5f9;
        border-radius: 16px;
        transition: all 0.25s ease;
        background: #ffffff;
    }

    .quick-card:hover {
        transform: translateY(-4px);
        border-color: #e2e8f0;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05);
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

    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-2 mb-4">
        <div>
            <h2 class="dashboard-title m-0">Dashboard Guru</h2>
            <p class="text-secondary small m-0">Pantau dan kelola aktivitas belajar mengajar Anda.</p>
        </div>
        
        <div class="d-flex align-items-center gap-3">
            <!-- Badge Tanggal -->
            <span class="badge bg-white text-secondary border px-3 py-2 rounded-pill d-inline-flex align-items-center shadow-sm">
                <i class="far fa-calendar-alt me-2 text-primary"></i>
                {{ now()->translatedFormat('l, d F Y') }}
            </span>

            <!-- Dropdown Profil Baru (Posisi di bawah navbar / kanan atas konten) -->
            <div class="dropdown">
                <div class="avatar-circle shadow-sm" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    {{ strtoupper(substr(auth()->user()->name ?? 'G', 0, 1)) }}
                </div>
                
                <div class="dropdown-menu dropdown-menu-end profile-dropdown-menu mt-2" aria-labelledby="profileDropdown">
                    <!-- Bagian Atas: Nama & Email -->
                    <div class="mb-3">
                        <div class="user-name">{{ auth()->user()->name ?? 'Nama Guru' }}</div>
                        <div class="user-email">{{ auth()->user()->email ?? 'guru@edulearn.com' }}</div>
                    </div>
                    <hr class="text-secondary opacity-25">
                    
                    <!-- Bagian Tengah: Navigasi/Menu Tambahan -->
                    <ul class="list-unstyled mb-3">
                        <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i> Settings</a></li>
                        <li><a class="dropdown-item" href="#"><i class="fas fa-brain me-2"></i> Memory</a></li>
                        <li><a class="dropdown-item" href="#"><i class="fas fa-bell me-2"></i> Reminders</a></li>
                    </ul>
                    <hr class="text-secondary opacity-25">
                    
                    <!-- Bagian Bawah: Tombol Sign Out (Sesuai contoh foto pertama) -->
                    <form action="{{ route('logout') }}" method="POST" class="m-0">
                        @csrf
                        <button type="submit" class="btn btn-signout w-100 py-2">Sign out</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Hero Card -->
    <div class="card hero-card mb-4">
        <div class="card-body p-4 p-md-5 hero-content">
            <div class="row align-items-center gy-4">
                <div class="col-lg-12 text-center text-lg-start">
                    <span class="badge bg-white text-primary px-3 py-2 mb-3 rounded-pill fw-semibold shadow-sm">
                        <i class="fas fa-user-tie me-2"></i>Teacher Panel
                    </span>
                    <h2 class="fw-bold mb-2 text-white">Halo, {{ auth()->user()->name }}!</h2>
                    <p class="mb-4 text-white text-opacity-75 fs-5 fw-light" style="max-width: 600px;">
                        Selamat datang kembali. Kelola artikel, quiz, dan forum pembelajaran dengan lebih menyenangkan hari ini.
                    </p>
                    <div class="d-flex flex-wrap gap-2 justify-content-center justify-content-lg-start">
                        <a href="#" class="btn btn-light px-4 py-2 fw-semibold rounded-pill text-primary shadow-sm">
                            <i class="fas fa-plus-circle me-2"></i>Buat Artikel
                        </a>
                        <a href="#" class="btn btn-outline-light px-4 py-2 fw-semibold rounded-pill">
                            <i class="fas fa-file-signature me-2"></i>Buat Quiz
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row g-3 mb-4">
        <!-- Card Total Artikel -->
        <div class="col-xl-3 col-md-6">
            <div class="card stat-card h-100">
                <div class="card-body d-flex flex-column justify-content-between p-4">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <span class="text-secondary small fw-medium text-uppercase tracking-wider d-block mb-1">Total Artikel</span>
                            <h2 class="fw-bold m-0" style="color: #0f172a;">12</h2>
                        </div>
                        <div class="stat-icon bg-primary bg-gradient shadow-sm">
                            <i class="fas fa-newspaper"></i>
                        </div>
                    </div>
                    <div>
                        <div class="progress mb-2">
                            <div class="progress-bar bg-primary" style="width: 75%"></div>
                        </div>
                        <span class="text-success small fw-semibold d-inline-flex align-items-center">
                            <i class="fas fa-arrow-up me-1"></i>+2 Minggu Ini
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card Menunggu ACC -->
        <div class="col-xl-3 col-md-6">
            <div class="card stat-card h-100">
                <div class="card-body d-flex flex-column justify-content-between p-4">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <span class="text-secondary small fw-medium text-uppercase tracking-wider d-block mb-1">Menunggu ACC</span>
                            <h2 class="fw-bold m-0" style="color: #0f172a;">3</h2>
                        </div>
                        <div class="stat-icon bg-warning bg-gradient shadow-sm">
                            <i class="fas fa-clock"></i>
                        </div>
                    </div>
                    <div>
                        <div class="progress mb-2">
                            <div class="progress-bar bg-warning" style="width: 40%"></div>
                        </div>
                        <span class="text-warning small fw-semibold d-inline-flex align-items-center">
                            <i class="fas fa-exclamation-circle me-1"></i>Butuh Persetujuan
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card Quiz Dibuat -->
        <div class="col-xl-3 col-md-6">
            <div class="card stat-card h-100">
                <div class="card-body d-flex flex-column justify-content-between p-4">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <span class="text-secondary small fw-medium text-uppercase tracking-wider d-block mb-1">Quiz Dibuat</span>
                            <h2 class="fw-bold m-0" style="color: #0f172a;">8</h2>
                        </div>
                        <div class="stat-icon bg-success bg-gradient shadow-sm">
                            <i class="fas fa-file-alt"></i>
                        </div>
                    </div>
                    <div>
                        <div class="progress mb-2">
                            <div class="progress-bar bg-success" style="width: 85%"></div>
                        </div>
                        <span class="text-success small fw-semibold d-inline-flex align-items-center">
                            <i class="fas fa-check-circle me-1"></i>Aktif
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card Forum -->
        <div class="col-xl-3 col-md-6">
            <div class="card stat-card h-100">
                <div class="card-body d-flex flex-column justify-content-between p-4">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <span class="text-secondary small fw-medium text-uppercase tracking-wider d-block mb-1">Forum</span>
                            <h2 class="fw-bold m-0" style="color: #0f172a;">24</h2>
                        </div>
                        <div class="stat-icon bg-info bg-gradient shadow-sm">
                            <i class="fas fa-comments"></i>
                        </div>
                    </div>
                    <div>
                        <div class="progress mb-2">
                            <div class="progress-bar bg-info" style="width: 90%"></div>
                        </div>
                        <span class="text-info small fw-semibold d-inline-flex align-items-center">
                            <i class="fas fa-reply me-1"></i>Balasan Siswa
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Section (2 Columns) -->
    <div class="row g-4">
        <!-- Left Side -->
        <div class="col-lg-8">
            <!-- Menu Cepat -->
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-header bg-white border-0 pt-4 px-4 pb-2">
                    <h5 class="fw-bold mb-0 text-dark">
                        <i class="fas fa-bolt text-warning me-2"></i>Menu Cepat
                    </h5>
                </div>
                <div class="card-body px-4 pb-4">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="card quick-card text-center h-100">
                                <div class="card-body p-4 d-flex flex-column justify-content-between">
                                    <div>
                                        <div class="stat-icon bg-primary mx-auto mb-3 shadow-sm">
                                            <i class="fas fa-newspaper"></i>
                                        </div>
                                        <h6 class="fw-bold text-dark mb-2">Upload Artikel</h6>
                                        <p class="text-secondary small mb-3">Tambahkan artikel baru untuk pembelajaran siswa.</p>
                                    </div>
                                    <a href="#" class="btn btn-primary btn-sm rounded-pill w-100 py-2 fw-medium mt-2">Buka</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card quick-card text-center h-100">
                                <div class="card-body p-4 d-flex flex-column justify-content-between">
                                    <div>
                                        <div class="stat-icon bg-success mx-auto mb-3 shadow-sm">
                                            <i class="fas fa-file-medical"></i>
                                        </div>
                                        <h6 class="fw-bold text-dark mb-2">Buat Quiz</h6>
                                        <p class="text-secondary small mb-3">Kelola soal, latihan, dan evaluasi hasil belajar.</p>
                                    </div>
                                    <a href="#" class="btn btn-success btn-sm rounded-pill text-white w-100 py-2 fw-medium mt-2">Buka</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card quick-card text-center h-100">
                                <div class="card-body p-4 d-flex flex-column justify-content-between">
                                    <div>
                                        <div class="stat-icon bg-info mx-auto mb-3 shadow-sm">
                                            <i class="fas fa-comments"></i>
                                        </div>
                                        <h6 class="fw-bold text-dark mb-2">Forum Diskusi</h6>
                                        <p class="text-secondary small mb-3">Balas diskusi aktif dan pertanyaan dari siswa.</p>
                                    </div>
                                    <a href="#" class="btn btn-info btn-sm rounded-pill text-white w-100 py-2 fw-medium mt-2">Buka</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Artikel Saya -->
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center pt-4 px-4 pb-2">
                    <h5 class="fw-bold mb-0 text-dark">
                        <i class="fas fa-book-open text-success me-2"></i>Artikel Saya
                    </h5>
                    <a href="#" class="btn btn-sm btn-primary rounded-pill px-3 py-2 fw-medium">
                        <i class="fas fa-plus me-1"></i>Tambah
                    </a>
                </div>
                <div class="table-responsive px-2 pb-2">
                    <table class="table table-hover align-middle mb-0">
                        <thead>
                            <tr class="text-muted">
                                <th class="border-0 px-3">Judul</th>
                                <th class="border-0">Status</th>
                                <th class="border-0">Tanggal</th>
                                <th class="border-0 text-end px-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="px-3 fw-medium text-dark">Laravel Dasar</td>
                                <td><span class="badge bg-warning bg-opacity-10 text-warning px-3 py-2 rounded-pill fw-semibold">Pending</span></td>
                                <td class="text-secondary">09 Juli 2026</td>
                                <td class="text-end px-3">
                                    <button class="btn btn-sm btn-outline-primary rounded-pill px-3">Detail</button>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-3 fw-medium text-dark">Bootstrap 5</td>
                                <td><span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill fw-semibold">Publish</span></td>
                                <td class="text-secondary">05 Juli 2026</td>
                                <td class="text-end px-3">
                                    <button class="btn btn-sm btn-outline-success rounded-pill px-3">Lihat</button>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-3 fw-medium text-dark">PHP Native</td>
                                <td><span class="badge bg-danger bg-opacity-10 text-danger px-3 py-2 rounded-pill fw-semibold">Ditolak</span></td>
                                <td class="text-secondary">03 Juli 2026</td>
                                <td class="text-end px-3">
                                    <button class="btn btn-sm btn-outline-danger rounded-pill px-3">Edit</button>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-3 fw-medium text-dark">CSS Responsive</td>
                                <td><span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill fw-semibold">Publish</span></td>
                                <td class="text-secondary">28 Juni 2026</td>
                                <td class="text-end px-3">
                                    <button class="btn btn-sm btn-outline-success rounded-pill px-3">Lihat</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Right Side -->
        <div class="col-lg-4">
            <!-- Informasi Penting -->
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-header bg-white border-0 pt-4 px-4 pb-2">
                    <h5 class="fw-bold mb-0 text-dark">
                        <i class="fas fa-bullhorn text-danger me-2"></i>Informasi Penting
                    </h5>
                </div>
                <div class="card-body px-4 pb-4">
                    <div class="alert alert-warning d-flex align-items-start gap-2 mb-3">
                        <i class="fas fa-info-circle mt-1"></i>
                        <div>
                            <strong class="d-block mb-1 text-dark">Persetujuan Artikel</strong>
                            Semua artikel baru harus disetujui Admin terlebih dahulu sebelum dipublikasikan ke siswa.
                        </div>
                    </div>
                    <div class="alert alert-info d-flex align-items-start gap-2 mb-0">
                        <i class="fas fa-exclamation-circle mt-1"></i>
                        <div>
                            <strong class="d-block mb-1 text-dark">Verifikasi Soal Quiz</strong>
                            Pastikan butir pertanyaan dan kunci jawaban sudah diperiksa kembali untuk menghindari salah input.
                        </div>
                    </div>
                </div>
            </div>

            <!-- Progress Bulanan -->
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-header bg-white border-0 pt-4 px-4 pb-2">
                    <h5 class="fw-bold mb-0 text-dark">
                        <i class="fas fa-chart-line text-success me-2"></i>Progress Bulan Ini
                    </h5>
                </div>
                <div class="card-body px-4 pb-4">
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <span class="small fw-semibold text-secondary">Artikel</span>
                            <span class="small fw-bold text-primary">70%</span>
                        </div>
                        <div class="progress progress-lg">
                            <div class="progress-bar bg-primary" style="width:70%">70%</div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <span class="small fw-semibold text-secondary">Quiz</span>
                            <span class="small fw-bold text-success">85%</span>
                        </div>
                        <div class="progress progress-lg">
                            <div class="progress-bar bg-success" style="width:85%">85%</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bottom Section (Activity, Target, Tips & Info) -->
    <div class="row g-4 mt-1">
        <!-- Aktivitas Terbaru -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-header bg-white border-0 pt-4 px-4 pb-2">
                    <h5 class="fw-bold mb-0 text-dark">
                        <i class="fas fa-history text-primary me-2"></i>Aktivitas Terbaru
                    </h5>
                </div>
                <div class="card-body px-4 pb-4">
                    <!-- Item 1 -->
                    <div class="d-flex gap-3 align-items-start mb-3">
                        <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width:40px; height:40px;">
                            <i class="fas fa-newspaper text-primary"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="fw-bold text-dark mb-1 fs-6">Artikel Laravel Dasar</h6>
                            <p class="text-muted small m-0">Dikirim untuk verifikasi Admin</p>
                            <span class="badge bg-warning bg-opacity-10 text-warning px-2 py-1 rounded-pill small mt-2 fw-semibold">Pending</span>
                        </div>
                    </div>
                    <hr class="text-secondary opacity-10 my-3">
                    
                    <!-- Item 2 -->
                    <div class="d-flex gap-3 align-items-start mb-3">
                        <div class="bg-success bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width:40px; height:40px;">
                            <i class="fas fa-file-signature text-success"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="fw-bold text-dark mb-1 fs-6">Quiz HTML Dasar</h6>
                            <p class="text-muted small m-0">Selesai dibuat & diterbitkan</p>
                            <span class="badge bg-success bg-opacity-10 text-success px-2 py-1 rounded-pill small mt-2 fw-semibold">Published</span>
                        </div>
                    </div>
                    <hr class="text-secondary opacity-10 my-3">

                    <!-- Item 3 -->
                    <div class="d-flex gap-3 align-items-start">
                        <div class="bg-info bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width:40px; height:40px;">
                            <i class="fas fa-comments text-info"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="fw-bold text-dark mb-1 fs-6">Membalas Forum</h6>
                            <p class="text-muted small m-0">Menjawab 5 diskusi aktif siswa</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Target Bulanan -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-header bg-white border-0 pt-4 px-4 pb-2">
                    <h5 class="fw-bold mb-0 text-dark">
                        <i class="fas fa-bullseye text-danger me-2"></i>Target Bulan Ini
                    </h5>
                </div>
                <div class="card-body px-4 pb-4">
                    <div class="mb-3">
                        <p class="small text-secondary mb-1 d-flex justify-content-between">
                            <span>Upload 10 Artikel</span>
                            <span class="fw-bold text-primary">7 / 10</span>
                        </p>
                        <div class="progress progress-lg">
                            <div class="progress-bar bg-primary" style="width: 70%">70%</div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <p class="small text-secondary mb-1 d-flex justify-content-between">
                            <span>Membuat 5 Quiz</span>
                            <span class="fw-bold text-success">4 / 5</span>
                        </p>
                        <div class="progress progress-lg">
                            <div class="progress-bar bg-success" style="width: 80%">80%</div>
                        </div>
                    </div>
                    <div>
                        <p class="small text-secondary mb-1 d-flex justify-content-between">
                            <span>Balas Diskusi Forum</span>
                            <span class="fw-bold text-info">18 Balasan</span>
                        </p>
                        <div class="progress progress-lg">
                            <div class="progress-bar bg-info" style="width: 60%">60%</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tips & EduCalendar Info -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-header bg-white border-0 pt-4 px-4 pb-2">
                    <h5 class="fw-bold mb-0 text-dark">
                        <i class="fas fa-calendar-alt text-primary me-2"></i>Info & Tips
                    </h5>
                </div>
                <div class="card-body px-4 pb-4">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <h2 class="fw-bold text-primary m-0" style="font-size: 2.5rem;">{{ now()->format('d') }}</h2>
                        <div>
                            <h5 class="fw-bold text-dark m-0">{{ now()->translatedFormat('F Y') }}</h5>
                            <small class="text-secondary">Info Status Pembelajaran</small>
                        </div>
                    </div>
                    <hr class="text-secondary opacity-10 my-3">
                    <div class="d-flex flex-column gap-2 small text-secondary">
                        <p class="m-0"><i class="fas fa-circle text-success me-2" style="font-size: 8px;"></i><strong>Publish:</strong> Artikel langsung aktif dilihat siswa.</p>
                        <p class="m-0"><i class="fas fa-circle text-warning me-2" style="font-size: 8px;"></i><strong>Pending:</strong> Menunggu peninjauan Admin.</p>
                        <p class="m-0"><i class="fas fa-circle text-danger me-2" style="font-size: 8px;"></i><strong>Ditolak:</strong> Perbaiki kembali dan kirim ulang.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Area -->
    <div class="card border-0 shadow-sm rounded-4 mt-4">
        <div class="card-body p-4">
            <div class="row align-items-center gy-2">
                <div class="col-md-8 text-center text-md-start">
                    <h6 class="fw-bold mb-1 text-dark">EduLearn Teacher Dashboard</h6>
                    <p class="text-secondary small m-0">Sistem manajemen belajar modern berbasis web untuk efisiensi mengajar.</p>
                </div>
                <div class="col-md-4 text-center text-md-end">
                    <small class="text-muted d-block">Version 1.0</small>
                    <small class="text-muted">© {{ date('Y') }} EduLearn. All rights reserved.</small>
                </div>
            </div>
        </div>
    </div>

</div>


@endsection