@extends('adminlte::page')

@section('content')

<style>
    body {
        background: #f8fafc; 
        font-family: 'Inter', system-ui, -apple-system, sans-serif;
    }

    .dashboard-container {
        max-width: 1600px;
        margin: 0 auto;
    }

    .dashboard-title {
        font-weight: 700;
        color: #0f172a;
        letter-spacing: -0.02em;
    }

    .admin-hero-card {
        position: relative;
        overflow: hidden;
        border: 0;
        border-radius: 16px;
        background: linear-gradient(135deg, #1e293b, #0f172a);
        color: #ffffff;
        box-shadow: 0 4px 20px rgba(15, 23, 42, 0.08);
    }

    .admin-hero-card::after {
        content: '';
        position: absolute;
        width: 320px;
        height: 320px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(255,255,255,0.06) 0%, rgba(255,255,255,0) 70%);
        top: -100px;
        right: -60px;
        pointer-events: none;
    }

    .stat-card {
        border: 1px solid #e2e8f0;
        border-radius: 14px;
        background: #ffffff;
        transition: all 0.25s ease;
    }

    .stat-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.03);
        border-color: #cbd5e1;
    }

    .stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 10px;
        display: flex;
        justify-content: center;
        align-items: center;
        color: #ffffff;
        font-size: 18px;
        flex-shrink: 0;
    }

    .custom-table {
        margin-bottom: 0;
    }

    .custom-table th {
        font-weight: 600;
        color: #64748b;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        padding: 16px 20px;
        background-color: #f8fafc;
        border-bottom: 1px solid #e2e8f0;
    }

    .custom-table td {
        color: #334155;
        font-size: 0.9rem;
        padding: 18px 20px;
        border-bottom: 1px solid #f1f5f9;
        vertical-align: middle;
    }

    .custom-table tr:last-child td {
        border-bottom: 0;
    }

    /* Kustomisasi Khusus Tombol Aksi Moderasi */
    .btn-action-preview {
        background-color: #e2e8f0;
        color: #334155;
        font-weight: 600;
        font-size: 0.8rem;
        border: 1px solid #cbd5e1;
        padding: 6px 14px;
        transition: all 0.2s ease;
    }
    .btn-action-preview:hover {
        background-color: #94a3b8;
        color: #ffffff;
        border-color: #94a3b8;
    }

    .btn-action-acc {
        background-color: #d1fae5;
        color: #065f46;
        font-weight: 600;
        font-size: 0.8rem;
        border: 1px solid #a7f3d0;
        padding: 6px 14px;
        transition: all 0.2s ease;
    }
    .btn-action-acc:hover {
        background-color: #10b981;
        color: #ffffff;
        border-color: #10b981;
    }

    .btn-action-reject {
        background-color: #fee2e2;
        color: #991b1b;
        font-weight: 600;
        font-size: 0.8rem;
        border: 1px solid #fecaca;
        padding: 6px 14px;
        transition: all 0.2s ease;
    }
    .btn-action-reject:hover {
        background-color: #ef4444;
        color: #ffffff;
        border-color: #ef4444;
    }

    .activity-log-item {
        position: relative;
        padding-left: 28px;
        padding-bottom: 20px;
    }

    .activity-log-item:last-child {
        padding-bottom: 0;
    }

    .activity-log-item::before {
        content: '';
        position: absolute;
        left: 6px;
        top: 22px;
        bottom: 0;
        width: 2px;
        background: #e2e8f0;
    }

    .activity-log-item:last-child::before {
        display: none;
    }

    .activity-icon-wrapper {
        position: absolute;
        left: 0;
        top: 2px;
        width: 14px;
        height: 14px;
        border-radius: 50%;
        background: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 10px;
        z-index: 2;
    }

    /* Memastikan dropdown bersih total */
    .admin-dropdown .dropdown-toggle::after {
        display: none !important;
    }
    .admin-dropdown .dropdown-menu {
        border: 1px solid #e2e8f0;
        box-shadow: 0 10px 25px -5px rgba(0,0,0,0.1);
        border-radius: 12px;
        padding: 6px;
        min-width: 160px;
        right: 0 !important; 
        left: auto !important;
    }
    .admin-dropdown .dropdown-item {
        border-radius: 8px;
        padding: 10px 14px;
        font-size: 0.9rem;
        color: #334155;
    }
    .admin-dropdown .dropdown-item:hover {
        background-color: #f1f5f9;
        color: #0f172a;
    }
    .admin-dropdown .dropdown-item.text-danger:hover {
        background-color: #fef2f2;
        color: #dc2626;
    }

    /* Kustomisasi Desain Modal Preview */
    .custom-modal .modal-content {
        border: 0;
        border-radius: 16px;
        box-shadow: 0 15px 35px rgba(15, 23, 42, 0.15);
    }
    .custom-modal .modal-header {
        border-bottom: 1px solid #f1f5f9;
        padding: 20px 24px;
    }
    .custom-modal .modal-body {
        padding: 24px;
        color: #334155;
    }
    .custom-modal .modal-footer {
        border-top: 1px solid #f1f5f9;
        padding: 16px 24px;
        background-color: #f8fafc;
        border-bottom-left-radius: 16px;
        border-bottom-right-radius: 16px;
    }
</style>

<div class="container-fluid px-4 pt-3 pb-4 dashboard-container">

    <!-- Header Panel Atas Bersih & Presisi -->
    <div class="d-flex justify-content-between align-items-center mb-4 mt-2">
        <div>
            <h2 class="dashboard-title m-0">Control Center Admin</h2>
            <p class="text-muted small m-0 mt-1 d-none d-sm-block">Ringkasan analitik data, manajemen konten, persetujuan artikel, dan kuis sistem.</p>
        </div>
   
        <div>
            <ul class="dropdown-menu dropdown-menu-end mt-2 shadow list-unstyled" aria-labelledby="adminAccountDropdown">
                <li>
                    <a class="dropdown-item text-danger fw-semibold d-flex align-items-center justify-content-center gap-2" href="#" 
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt"></i> Keluar / Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    </div>

    <!-- Hero Card Menyambut Admin -->
    <div class="card admin-hero-card mb-4">
        <div class="card-body p-4 p-md-5 position-relative" style="z-index: 2;">
            <div class="row align-items-center h-100">
                <div class="col-lg-9 text-start">
                    <span class="badge bg-white bg-opacity-10 text-white px-3 py-1.5 mb-3 rounded-pill fw-medium tracking-wide small">
                        <i class="fas fa-user-shield me-2 text-warning"></i>SYSTEM OVERVIEW
                    </span>
                    <h2 class="fw-bold mb-2 text-white tracking-tight">Selamat Datang Kembali, {{ auth()->user()->name ?? 'Administrator' }}!</h2>
                    <p class="mb-4 text-white text-opacity-75 fs-6 fw-light" style="max-width: 720px; line-height: 1.6;">
                        Seluruh infrastruktur sistem saat ini berjalan dengan normal. Anda memiliki beberapa konten baru dari para pengajar yang memerlukan moderasi sebelum diterbitkan ke publik.
                    </p>
                    <div class="d-flex flex-wrap gap-2">
                        <a href="#" class="btn btn-white btn-light px-4 py-2 rounded-3 fw-semibold small shadow-sm">
                            <i class="fas fa-check-double me-2 text-success"></i>Moderasi Sistem
                        </a>
                        <a href="#" class="btn btn-outline-light px-4 py-2 rounded-3 fw-semibold small">
                            <i class="fas fa-users me-2"></i>Kelola Pengguna
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 text-end d-none d-lg-block opacity-25">
                    <i class="fas fa-server text-white" style="font-size: 120px;"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Grid (4 Kolom) -->
    <div class="row g-3 mb-4">
        <!-- Total Guru -->
        <div class="col-sm-6 col-xl-3">
            <div class="card stat-card h-100">
                <div class="card-body p-4 d-flex flex-column justify-content-between">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <span class="text-muted small fw-semibold text-uppercase tracking-wider d-block mb-1" style="font-size: 0.75rem;">Total Guru</span>
                            <h3 class="fw-bold m-0 text-slate" style="color: #0f172a; font-size: 1.75rem;">24</h3>
                        </div>
                        <div class="stat-icon bg-primary shadow-sm">
                            <i class="fas fa-chalkboard-teacher"></i>
                        </div>
                    </div>
                    <div class="pt-3 border-top border-light-subtle">
                        <span class="text-muted small"><i class="fas fa-user-plus text-success me-1"></i> +2 Pengajar baru bulan ini</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Siswa Terdaftar -->
        <div class="col-sm-6 col-xl-3">
            <div class="card stat-card h-100">
                <div class="card-body p-4 d-flex flex-column justify-content-between">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <span class="text-muted small fw-semibold text-uppercase tracking-wider d-block mb-1" style="font-size: 0.75rem;">Total Siswa</span>
                            <h3 class="fw-bold m-0 text-slate" style="color: #0f172a; font-size: 1.75rem;">1,420</h3>
                        </div>
                        <div class="stat-icon bg-info shadow-sm">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                    </div>
                    <div class="pt-3 border-top border-light-subtle">
                        <span class="text-muted small"><i class="fas fa-chart-line text-info me-1"></i> 85 Akun aktif hari ini</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Menunggu Validasi ACC -->
        <div class="col-sm-6 col-xl-3">
            <div class="card stat-card h-100 border-start border-warning border-3">
                <div class="card-body p-4 d-flex flex-column justify-content-between">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <span class="text-warning small fw-bold text-uppercase tracking-wider d-block mb-1" style="font-size: 0.75rem;">Menunggu ACC</span>
                            <h3 class="fw-bold m-0 text-slate" style="color: #0f172a; font-size: 1.75rem;">6</h3>
                        </div>
                        <div class="stat-icon bg-warning shadow-sm">
                            <i class="fas fa-hourglass-half"></i>
                        </div>
                    </div>
                    <div class="pt-3 border-top border-light-subtle">
                        <span class="text-danger small fw-semibold"><i class="fas fa-exclamation-circle me-1"></i> 3 Artikel & 3 Kuis baru</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Kuis Terbit -->
        <div class="col-sm-6 col-xl-3">
            <div class="card stat-card h-100">
                <div class="card-body p-4 d-flex flex-column justify-content-between">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <span class="text-muted small fw-semibold text-uppercase tracking-wider d-block mb-1" style="font-size: 0.75rem;">Total Quiz Aktif</span>
                            <h3 class="fw-bold m-0 text-slate" style="color: #0f172a; font-size: 1.75rem;">56</h3>
                        </div>
                        <div class="stat-icon bg-success shadow-sm">
                            <i class="fas fa-vial"></i>
                        </div>
                    </div>
                    <div class="pt-3 border-top border-light-subtle">
                        <span class="text-muted small"><i class="fas fa-check text-success me-1"></i> Tersebar di semua materi</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Section Grid Panel Split -->
    <div class="row g-4 mb-4">
        <!-- Kolom Kiri: Tabel Antrean Konten (Artikel & Kuis) -->
        <div class="col-lg-8 d-flex flex-column gap-4">
            
            <!-- TABEL 1: ANTREAN ARTIKEL -->
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="card-header bg-white border-0 pt-4 px-4 pb-2 d-flex justify-content-between align-items-center">
                    <h5 class="fw-bold mb-0 text-dark" style="font-size: 1.1rem;">
                        <i class="fas fa-file-invoice text-warning me-2"></i>Antrean Persetujuan Artikel
                    </h5>
                </div>
                <div class="table-responsive">
                    <table class="table custom-table align-middle">
                        <thead>
                            <tr>
                                <th>Judul Artikel</th>
                                <th>Penulis (Guru)</th>
                                <th>Kategori</th>
                                <th class="text-end" style="width: 260px;">Aksi Operasional</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="fw-semibold text-dark text-wrap" style="max-width: 240px;">Tutorial Implementasi Middleware Laravel 11</td>
                                <td class="text-secondary small">Budi Sudarsono, S.Kom</td>
                                <td><span class="badge bg-light border text-dark px-2.5 py-1.5 rounded fw-medium">Backend</span></td>
                                <td class="text-end">
                                    <div class="d-inline-flex gap-2">
                                        <button class="btn btn-sm btn-action-preview rounded-3" data-toggle="modal" data-target="#previewArtikelModal1"><i class="fas fa-eye me-1"></i> Preview</button>
                                        <button class="btn btn-sm btn-action-acc rounded-3"><i class="fas fa-check me-1"></i> ACC</button>
                                        <button class="btn btn-sm btn-action-reject rounded-3"><i class="fas fa-times me-1"></i> Tolak</button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-semibold text-dark text-wrap" style="max-width: 240px;">Panduan Sederhana UI Layouting Menggunakan CSS Flexbox</td>
                                <td class="text-secondary small">Siti Rahma, S.Pd</td>
                                <td><span class="badge bg-light border text-dark px-2.5 py-1.5 rounded fw-medium">Frontend</span></td>
                                <td class="text-end">
                                    <div class="d-inline-flex gap-2">
                                        <button class="btn btn-sm btn-action-preview rounded-3" data-toggle="modal" data-target="#previewArtikelModal2"><i class="fas fa-eye me-1"></i> Preview</button>
                                        <button class="btn btn-sm btn-action-acc rounded-3"><i class="fas fa-check me-1"></i> ACC</button>
                                        <button class="btn btn-sm btn-action-reject rounded-3"><i class="fas fa-times me-1"></i> Tolak</button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-semibold text-dark text-wrap" style="max-width: 240px;">Mengenal Konsep Relasi Database PostgreSQL</td>
                                <td class="text-secondary small">Ahmad Fauzi, M.T</td>
                                <td><span class="badge bg-light border text-dark px-2.5 py-1.5 rounded fw-medium">Database</span></td>
                                <td class="text-end">
                                    <div class="d-inline-flex gap-2">
                                        <button class="btn btn-sm btn-action-preview rounded-3" data-toggle="modal" data-target="#previewArtikelModal3"><i class="fas fa-eye me-1"></i> Preview</button>
                                        <button class="btn btn-sm btn-action-acc rounded-3"><i class="fas fa-check me-1"></i> ACC</button>
                                        <button class="btn btn-sm btn-action-reject rounded-3"><i class="fas fa-times me-1"></i> Tolak</button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- TABEL 2: ANTREAN KUIS BARU -->
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="card-header bg-white border-0 pt-4 px-4 pb-2 d-flex justify-content-between align-items-center">
                    <h5 class="fw-bold mb-0 text-dark" style="font-size: 1.1rem;">
                        <i class="fas fa-vial text-success me-2"></i>Antrean Persetujuan Kuis Baru
                    </h5>
                </div>
                <div class="table-responsive">
                    <table class="table custom-table align-middle">
                        <thead>
                            <tr>
                                <th>Nama Kuis / Evaluasi</th>
                                <th>Dibuat Oleh (Guru)</th>
                                <th>Jumlah Soal</th>
                                <th class="text-end" style="width: 260px;">Aksi Operasional</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="fw-semibold text-dark text-wrap" style="max-width: 240px;">Kuis Harian - Dasar Pemrograman Objek (OOP)</td>
                                <td class="text-secondary small">Budi Sudarsono, S.Kom</td>
                                <td><span class="badge bg-light border text-dark px-2.5 py-1.5 rounded fw-medium">15 Soal</span></td>
                                <td class="text-end">
                                    <div class="d-inline-flex gap-2">
                                        <button class="btn btn-sm btn-action-preview rounded-3" data-toggle="modal" data-target="#previewKuisModal1"><i class="fas fa-eye me-1"></i> Preview</button>
                                        <button class="btn btn-sm btn-action-acc rounded-3"><i class="fas fa-check me-1"></i> ACC</button>
                                        <button class="btn btn-sm btn-action-reject rounded-3"><i class="fas fa-times me-1"></i> Tolak</button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-semibold text-dark text-wrap" style="max-width: 240px;">Ujian Tengah Bab - Responsive Web Design</td>
                                <td class="text-secondary small">Siti Rahma, S.Pd</td>
                                <td><span class="badge bg-light border text-dark px-2.5 py-1.5 rounded fw-medium">20 Soal</span></td>
                                <td class="text-end">
                                    <div class="d-inline-flex gap-2">
                                        <button class="btn btn-sm btn-action-preview rounded-3" data-toggle="modal" data-target="#previewKuisModal2"><i class="fas fa-eye me-1"></i> Preview</button>
                                        <button class="btn btn-sm btn-action-acc rounded-3"><i class="fas fa-check me-1"></i> ACC</button>
                                        <button class="btn btn-sm btn-action-reject rounded-3"><i class="fas fa-times me-1"></i> Tolak</button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-semibold text-dark text-wrap" style="max-width: 240px;">Evaluasi Akhir - Query Tuning & Indexing SQL</td>
                                <td class="text-secondary small">Ahmad Fauzi, M.T</td>
                                <td><span class="badge bg-light border text-dark px-2.5 py-1.5 rounded fw-medium">10 Soal</span></td>
                                <td class="text-end">
                                    <div class="d-inline-flex gap-2">
                                        <button class="btn btn-sm btn-action-preview rounded-3" data-toggle="modal" data-target="#previewKuisModal3"><i class="fas fa-eye me-1"></i> Preview</button>
                                        <button class="btn btn-sm btn-action-acc rounded-3"><i class="fas fa-check me-1"></i> ACC</button>
                                        <button class="btn btn-sm btn-action-reject rounded-3"><i class="fas fa-times me-1"></i> Tolak</button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

        <!-- Kolom Kanan: Log Aktivitas & Memo -->
        <div class="col-lg-4 d-flex flex-column gap-4">
            <!-- Panel Logs Aktivitas -->
            <div class="card border-0 shadow-sm rounded-4 p-4 flex-grow-1">
                <h5 class="fw-bold mb-3 text-dark" style="font-size: 1.1rem;">
                    <i class="fas fa-history text-secondary me-2"></i>Aktivitas Sistem Terbaru
                </h5>
                <div class="mt-2">
                    <div class="activity-log-item">
                        <div class="activity-icon-wrapper text-primary">
                            <i class="fas fa-circle" style="font-size: 8px;"></i>
                        </div>
                        <span class="d-block small text-dark fw-semibold">Pendaftaran Pengajar Baru</span>
                        <p class="text-muted m-0" style="font-size: 0.8rem; line-height: 1.4;">Akun Guru "Roni Setiawan" telah divalidasi sistem otomatis.</p>
                        <span class="text-secondary d-block mt-1" style="font-size: 11px;"><i class="far fa-clock me-1"></i>5 menit yang lalu</span>
                    </div>

                    <div class="activity-log-item">
                        <div class="activity-icon-wrapper text-danger">
                            <i class="fas fa-circle" style="font-size: 8px;"></i>
                        </div>
                        <span class="d-block small text-dark fw-semibold">Percobaan Akses Gagal</span>
                        <p class="text-muted m-0" style="font-size: 0.8rem; line-height: 1.4;">IP 192.168.1.50 mencoba login paksa halaman admin root.</p>
                        <span class="text-secondary d-block mt-1" style="font-size: 11px;"><i class="far fa-clock me-1"></i>42 menit yang lalu</span>
                    </div>

                    <div class="activity-log-item">
                        <div class="activity-icon-wrapper text-success">
                            <i class="fas fa-circle" style="font-size: 8px;"></i>
                        </div>
                        <span class="d-block small text-dark fw-semibold">Quiz Baru Diterbitkan</span>
                        <p class="text-muted m-0" style="font-size: 0.8rem; line-height: 1.4;">Guru Siti Rahma menerbitkan kuis baru "Evaluasi Bootstrap".</p>
                        <span class="text-secondary d-block mt-1" style="font-size: 11px;"><i class="far fa-clock me-1"></i>1 jam yang lalu</span>
                    </div>
                </div>
            </div>

            <!-- Memo Internal -->
            <div class="card border-0 shadow-sm rounded-4 p-4">
                <h5 class="fw-bold mb-3 text-dark" style="font-size: 1.1rem;">
                    <i class="fas fa-bullhorn text-muted me-2"></i>Memo Internal Admin
                </h5>
                <div class="p-3 bg-light rounded-3 border-start border-danger border-3">
                    <span class="fw-bold d-block small text-dark mb-1"><i class="fas fa-tools text-warning me-1"></i> Server Maintenance Scheduled</span>
                    <p class="text-secondary m-0" style="font-size: 12px; line-height: 1.5;">
                        Pembbersihan berkala database log dan pembaruan dependensi repositori dijadwalkan pada hari Sabtu pukul 01.00 WIB.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Space -->
    <div class="card border-0 shadow-sm rounded-4 mt-4">
        <div class="card-body px-4 py-3">
            <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center gap-2">
                <div class="text-center text-sm-start">
                    <span class="fw-bold text-dark small d-block">EduLearn Core Administrator System</span>
                    <span class="text-secondary" style="font-size: 11px;">Gunakan hak akses panel kontrol ini secara bijak demi stabilitas platform.</span>
                </div>
                <div class="text-center text-sm-end">
                    <span class="text-muted" style="font-size: 11px;">&copy; {{ date('Y') }} EduLearn Core. Infrastructure Admin Node.</span>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- ========================================== -->
<!-- SECTION MODAL PREVIEW CONTENT (POPUP) -->
<!-- ========================================== -->

<!-- Modal Preview Artikel 1 -->
<div class="modal fade custom-modal" id="previewArtikelModal1" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div>
                    <span class="badge bg-primary text-white mb-1">Backend</span>
                    <h5 class="modal-title fw-bold text-dark">Tutorial Implementasi Middleware Laravel 11</h5>
                </div>
                <button type="text" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="d-flex gap-3 mb-3 text-muted small border-bottom pb-2">
                    <div class="mr-3"><i class="fas fa-user mr-1"></i> Budi Sudarsono, S.Kom</div>
                    <div><i class="fas fa-calendar-alt mr-1"></i> Baru Saja Ditulis</div>
                </div>
                <h6><strong>Ringkasan Konten:</strong></h6>
                <p class="text-justify text-secondary">
                    Artikel ini membahas langkah-langkah detail penulisan custom middleware pada framework Laravel 11, mulai dari instalasi via artisan, registrasi di file konfigurasi bootstrap baru (<code class="p-1 bg-light rounded">bootstrap/app.php</code>), hingga skenario pengamanan route multi-level autentikasi user.
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm rounded-3 px-3" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Preview Artikel 2 -->
<div class="modal fade custom-modal" id="previewArtikelModal2" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div>
                    <span class="badge bg-info text-white mb-1">Frontend</span>
                    <h5 class="modal-title fw-bold text-dark">Panduan Sederhana UI Layouting Menggunakan CSS Flexbox</h5>
                </div>
                <button type="text" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="d-flex gap-3 mb-3 text-muted small border-bottom pb-2">
                    <div class="mr-3"><i class="fas fa-user mr-1"></i> Siti Rahma, S.Pd</div>
                    <div><i class="fas fa-calendar-alt mr-1"></i> Baru Saja Ditulis</div>
                </div>
                <h6><strong>Ringkasan Konten:</strong></h6>
                <p class="text-justify text-secondary">
                    Panduan visual fundamental mengenai tata letak modern. Menjelaskan properti utama seperti <code class="p-1 bg-light rounded">flex-direction</code>, <code class="p-1 bg-light rounded">justify-content</code>, dan <code class="p-1 bg-light rounded">align-items</code> dengan ilustrasi studi kasus pembuatan navigasi bar responsif.
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm rounded-3 px-3" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Preview Artikel 3 -->
<div class="modal fade custom-modal" id="previewArtikelModal3" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div>
                    <span class="badge bg-success text-white mb-1">Database</span>
                    <h5 class="modal-title fw-bold text-dark">Mengenal Konsep Relasi Database PostgreSQL</h5>
                </div>
                <button type="text" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="d-flex gap-3 mb-3 text-muted small border-bottom pb-2">
                    <div class="mr-3"><i class="fas fa-user mr-1"></i> Ahmad Fauzi, M.T</div>
                    <div><i class="fas fa-calendar-alt mr-1"></i> Baru Saja Ditulis</div>
                </div>
                <h6><strong>Ringkasan Konten:</strong></h6>
                <p class="text-justify text-secondary">
                    Membahas arsitektur penyimpanan relasional PostgreSQL. Fokus pada penanganan foreign key constraint, efisiensi index join data, dan integrasi tipe data JSONB di dalam tabel relasional konvensional.
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm rounded-3 px-3" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Preview Kuis 1 -->
<div class="modal fade custom-modal" id="previewKuisModal1" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-0 bg-light">
                <h5 class="modal-title fw-bold text-dark"><i class="fas fa-vial text-success mr-2"></i> Pratinjau Struktur Kuis</h5>
                <button type="text" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="text-muted small d-block mb-0">Nama Kuis / Evaluasi</label>
                    <span class="fw-bold text-dark fs-6">Kuis Harian - Dasar Pemrograman Objek (OOP)</span>
                </div>
                <div class="row border-top pt-2">
                    <div class="col-6">
                        <label class="text-muted small d-block mb-0">Pembuat</label>
                        <span class="text-dark small fw-semibold">Budi Sudarsono, S.Kom</span>
                    </div>
                    <div class="col-6">
                        <label class="text-muted small d-block mb-0">Struktur Ujian</label>
                        <span class="badge bg-light text-dark border font-weight-normal">15 Soal Pilihan Ganda</span>
                    </div>
                </div>
                <div class="alert alert-info small mt-3 border-0 rounded-3 mb-0">
                    <i class="fas fa-info-circle mr-1"></i> Bobot Penilaian Nilai Kuis Otomatis: Kriteria kelulusan minimal passing grade di-set pada skor 75%.
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm rounded-3 px-3" data-dismiss="modal">Kembali</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Preview Kuis 2 -->
<div class="modal fade custom-modal" id="previewKuisModal2" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-0 bg-light">
                <h5 class="modal-title fw-bold text-dark"><i class="fas fa-vial text-success mr-2"></i> Pratinjau Struktur Kuis</h5>
                <button type="text" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="text-muted small d-block mb-0">Nama Kuis / Evaluasi</label>
                    <span class="fw-bold text-dark fs-6">Ujian Tengah Bab - Responsive Web Design</span>
                </div>
                <div class="row border-top pt-2">
                    <div class="col-6">
                        <label class="text-muted small d-block mb-0">Pembuat</label>
                        <span class="text-dark small fw-semibold">Siti Rahma, S.Pd</span>
                    </div>
                    <div class="col-6">
                        <label class="text-muted small d-block mb-0">Struktur Ujian</label>
                        <span class="badge bg-light text-dark border font-weight-normal">20 Soal (Pilihan Ganda + Esai)</span>
                    </div>
                </div>
                <div class="alert alert-info small mt-3 border-0 rounded-3 mb-0">
                    <i class="fas fa-info-circle mr-1"></i> Membutuhkan koreksi manual admin/guru untuk komponen soal esai terlampir.
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm rounded-3 px-3" data-dismiss="modal">Kembali</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Preview Kuis 3 -->
<div class="modal fade custom-modal" id="previewKuisModal3" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-0 bg-light">
                <h5 class="modal-title fw-bold text-dark"><i class="fas fa-vial text-success mr-2"></i> Pratinjau Struktur Kuis</h5>
                <button type="text" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="text-muted small d-block mb-0">Nama Kuis / Evaluasi</label>
                    <span class="fw-bold text-dark fs-6">Evaluasi Akhir - Query Tuning & Indexing SQL</span>
                </div>
                <div class="row border-top pt-2">
                    <div class="col-6">
                        <label class="text-muted small d-block mb-0">Pembuat</label>
                        <span class="text-dark small fw-semibold">Ahmad Fauzi, M.T</span>
                    </div>
                    <div class="col-6">
                        <label class="text-muted small d-block mb-0">Struktur Ujian</label>
                        <span class="badge bg-light text-dark border font-weight-normal">10 Soal Praktek</span>
                    </div>
                </div>
                <div class="alert alert-info small mt-3 border-0 rounded-3 mb-0">
                    <i class="fas fa-info-circle mr-1"></i> Akses pengerjaan kuis menggunakan environment terisolasi / sandbox terminal SQL.
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm rounded-3 px-3" data-dismiss="modal">Kembali</button>
            </div>
        </div>
    </div>
</div>

@endsection