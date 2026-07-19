@extends('adminlte::page')

@section('content')
<!-- Google Fonts & FontAwesome -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    .dk-wrapper {
        font-family: 'Inter', sans-serif;
        background: #f4f8fc !important;
        min-height: calc(100vh - 60px);
        padding: 24px 12px;
    }
    .dk-card {
        border: none !important;
        border-radius: 12px !important;
        background: #ffffff;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.015) !important;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .dk-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 25px rgba(0, 0, 0, 0.03) !important;
    }
    .text-dk-muted {
        color: #9fa2b4;
        font-size: 13px;
        font-weight: 500;
        letter-spacing: 0.3px;
    }
    .stat-value {
        font-size: 30px;
        font-weight: 700;
        letter-spacing: -0.5px;
        line-height: 1;
    }
    .stat-subtext {
        margin-top: 10px;
        font-size: 13px;
        display: block;
    }

    /* Aksen Warna Premium */
    .bg-dk-blue-light { background-color: rgba(0, 102, 204, 0.08) !important; }
    .text-dk-blue { color: #0066cc !important; }
    .bg-dk-green-light { background-color: rgba(19, 136, 19, 0.08) !important; }
    .text-dk-green { color: #138813 !important; }
    .bg-dk-yellow-light { background-color: rgba(230, 184, 0, 0.08) !important; }
    .text-dk-yellow { color: #e6b800 !important; }
    
    .icon-shape {
        width: 48px;
        height: 48px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
    }

    /* Lebar Badge Status Guru Rata & Konsisten */
    .status-badge-fixed {
        display: inline-block;
        width: 90px;
        text-align: center;
        padding: 6px 0;
        font-size: 11.5px;
        font-weight: 600;
        border-radius: 6px;
    }

    /* Style Komponen Aktivitas Terbaru (Log Timeline) */
    .activity-feed {
        padding-left: 12px;
        list-style: none;
        margin-bottom: 0;
    }
    .activity-item {
        position: relative;
        padding-bottom: 18px;
        padding-left: 20px;
        border-left: 2px solid #edf2f9;
    }
    .activity-item:last-child {
        padding-bottom: 0;
        border-left: 2px solid transparent;
    }
    .activity-item::before {
        content: '';
        position: absolute;
        left: -6px;
        top: 4px;
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background: #0066cc;
    }
    .activity-item.success::before { background: #138813; }
    .activity-item.warning::before { background: #e6b800; }
</style>

<div class="container-fluid dk-wrapper">

    <!-- BARIS 1: Grid Card Statistik Atas -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4 mb-xl-0">
            <div class="card dk-card p-4">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <span class="text-dk-muted">TOTAL SISWA</span>
                    <div class="icon-shape bg-dk-blue-light text-dk-blue">
                        <i class="fa-solid fa-users"></i>
                    </div>
                </div>
                <div>
                    <span class="stat-value text-dark">1,250</span>
                    <span class="stat-subtext text-success fw-bold"><i class="fa-solid fa-arrow-up me-1"></i> +4.2% bulan ini</span>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4 mb-xl-0">
            <div class="card dk-card p-4">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <span class="text-dk-muted">SISWA BARU</span>
                    <div class="icon-shape bg-dk-blue-light text-dk-blue">
                        <i class="fa-solid fa-user-plus"></i>
                    </div>
                </div>
                <div>
                    <span class="stat-value text-dk-blue">+45</span>
                    <span class="stat-subtext text-muted">Akun baru terdaftar</span>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4 mb-md-0">
            <div class="card dk-card p-4">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <span class="text-dk-muted">GURU AKTIF</span>
                    <div class="icon-shape bg-dk-green-light text-dk-green">
                        <i class="fa-solid fa-chalkboard-user"></i>
                    </div>
                </div>
                <div>
                    <span class="stat-value text-dk-green">84</span>
                    <span class="stat-subtext text-muted fw-medium"><i class="fa-solid fa-circle text-success" style="font-size: 8px; vertical-align: middle;"></i> Staf mengajar aktif</span>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card dk-card p-4">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <span class="text-dk-muted">GURU KELUAR</span>
                    <div class="icon-shape bg-dk-yellow-light text-dk-yellow">
                        <i class="fa-solid fa-user-slash"></i>
                    </div>
                </div>
                <div>
                    <span class="stat-value text-dark">3</span>
                    <span class="stat-subtext text-danger fw-medium">Dinonaktifkan semester ini</span>
                </div>
            </div>
        </div>
    </div>

    <!-- BARIS 2: Grafik Analitik Tren Utama -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card dk-card p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h6 class="fw-bold text-dark mb-1" style="font-size: 16px;">Tren Registrasi Akun Baru</h6>
                        <span class="text-dk-muted small">Perbandingan pendaftaran Guru dan Siswa per bulan</span>
                    </div>
                </div>
                <div style="height: 300px; width: 100%;">
                    <canvas id="analyticsChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- BARIS 3: Tabel Manajemen Guru (Kiri) & Aktivitas + Statistik Sistem (Kanan) -->
    <div class="row mb-5">
        <!-- Bagian Tabel Akun Guru Terbaru -->
        <div class="col-lg-7 mb-4 mb-lg-0">
            <div class="card dk-card p-4 h-100">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="fw-bold text-dark mb-0" style="font-size: 16px;">Manajemen Akun Guru Terbaru</h6>
                    <button class="btn btn-sm btn-light text-dk-blue fw-semibold">Lihat Semua</button>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0" style="font-size: 13.5px;">
                        <thead>
                            <tr class="text-dk-muted border-bottom" style="font-size: 11px; letter-spacing: 0.5px;">
                                <th class="pb-3 ps-0">NAMA GURU</th>
                                <th class="pb-3 text-center">TANGGAL BERGABUNG</th>
                                <th class="pb-3 text-end" style="padding-right: 20px;">STATUS AKUN</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-bottom border-light">
                                <td class="py-3 ps-0">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-light rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px;">
                                            <i class="fa-solid fa-user text-secondary" style="font-size: 12px;"></i>
                                        </div>
                                        <span class="fw-semibold text-dark">Rian Hidayat, S.Pd</span>
                                    </div>
                                </td>
                                <td class="py-3 text-muted text-center">18 Juli 2026</td>
                                <td class="py-3 text-end">
                                    <span class="status-badge-fixed bg-success-subtle text-success border border-success-subtle">Aktif</span>
                                </td>
                            </tr>
                            <tr class="border-bottom border-light">
                                <td class="py-3 ps-0">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-light rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px;">
                                            <i class="fa-solid fa-user text-secondary" style="font-size: 12px;"></i>
                                        </div>
                                        <span class="fw-semibold text-dark">Siti Aminah, M.Pd</span>
                                    </div>
                                </td>
                                <td class="py-3 text-muted text-center">15 Juli 2026</td>
                                <td class="py-3 text-end">
                                    <span class="status-badge-fixed bg-success-subtle text-success border border-success-subtle">Aktif</span>
                                </td>
                            </tr>
                            <tr class="border-bottom border-light">
                                <td class="py-3 ps-0">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-light rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px;">
                                            <i class="fa-solid fa-user text-secondary" style="font-size: 12px;"></i>
                                        </div>
                                        <span class="fw-semibold text-dark">Ahmad Fauzi, S.T</span>
                                    </div>
                                </td>
                                <td class="py-3 text-muted text-center">22 Juni 2026</td>
                                <td class="py-3 text-end">
                                    <span class="status-badge-fixed bg-success-subtle text-success border border-success-subtle">Aktif</span>
                                </td>
                            </tr>
                            <tr class="border-bottom border-light">
                                <td class="py-3 ps-0">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-light rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px;">
                                            <i class="fa-solid fa-user text-secondary" style="font-size: 12px;"></i>
                                        </div>
                                        <span class="fw-semibold text-dark">Rizky Amelia, S.Pd</span>
                                    </div>
                                </td>
                                <td class="py-3 text-muted text-center">14 Juni 2026</td>
                                <td class="py-3 text-end">
                                    <span class="status-badge-fixed bg-success-subtle text-success border border-success-subtle">Aktif</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="py-3 ps-0">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-light rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px;">
                                            <i class="fa-solid fa-user text-secondary" style="font-size: 12px;"></i>
                                        </div>
                                        <span class="fw-semibold text-dark">Deni Kusuma, S.Kom</span>
                                    </div>
                                </td>
                                <td class="py-3 text-muted text-center">10 Juni 2026</td>
                                <td class="py-3 text-end">
                                    <span class="status-badge-fixed bg-danger-subtle text-danger border border-danger-subtle">Non-Aktif</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Bagian Komponen Aktivitas & Statistik Sistem -->
        <div class="col-lg-5">
            <div class="card dk-card p-4 h-100 d-flex flex-column justify-content-between">
                <div>
                    <h6 class="fw-bold text-dark mb-3" style="font-size: 16px;">Aktivitas Sistem Terbaru</h6>
                    
                    <!-- Feed Log Aktivitas Real-Time -->
                    <ul class="activity-feed">
                        <li class="activity-item success">
                            <div class="d-flex justify-content-between small">
                                <span class="fw-semibold text-dark">Siswa Baru Terdaftar</span>
                                <span class="text-muted" style="font-size: 11px;">2 menit lalu</span>
                            </div>
                            <span class="text-muted small">Akun siswa baru atas nama dimas prasetio telah diverifikasi.</span>
                        </li>
                        <li class="activity-item">
                            <div class="d-flex justify-content-between small">
                                <span class="fw-semibold text-dark">Modul Kuis Ditambahkan</span>
                                <span class="text-muted" style="font-size: 11px;">1 jam lalu</span>
                            </div>
                            <span class="text-muted small">Siti Aminah, M.Pd merilis kuis baru pada kelas Matematika.</span>
                        </li>
                        <li class="activity-item warning">
                            <div class="d-flex justify-content-between small">
                                <span class="fw-semibold text-dark">Perubahan Status Akun</span>
                                <span class="text-muted" style="font-size: 11px;">Kemarin</span>
                            </div>
                            <span class="text-muted small">Admin menonaktifkan hak akses mengajar Deni Kusuma, S.Kom.</span>
                        </li>
                    </ul>
                </div>

                <!-- Pemantauan Ringkas Statistik Kesehatan Sistem -->
                <div class="pt-3 border-top mt-4">
                    <h6 class="fw-bold text-dark mb-2" style="font-size: 13.5px;">Kesehatan & Status Sistem</h6>
                    <div class="d-flex gap-4 align-items-center justify-content-between text-center mt-2">
                        <div class="w-100 bg-light p-2 rounded">
                            <span class="text-dk-muted d-block mb-1" style="font-size: 11px;">DATABASE</span>
                            <span class="badge bg-success-subtle text-success small fw-bold"><i class="fa-solid fa-circle-check"></i> Normal</span>
                        </div>
                        <div class="w-100 bg-light p-2 rounded">
                            <span class="text-dk-muted d-block mb-1" style="font-size: 11px;">RESPONS TIME</span>
                            <span class="text-dark fw-bold small">148 ms</span>
                        </div>
                        <div class="w-100 bg-light p-2 rounded">
                            <span class="text-dk-muted d-block mb-1" style="font-size: 11px;">STORAGE</span>
                            <span class="text-dark fw-bold small">24.5 GB</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- BARIS 4: Footer Bersih & Minimalis (Satu Baris Penuh) -->
    <div class="card dk-card border-0 shadow-sm mt-5">
        <div class="card-body py-3 px-4">
            <div class="row align-items-center justify-content-between text-center text-md-start">
                <div class="col-md-6">
                    <small class="text-muted fw-medium">
                        <i class="fa-solid fa-graduation-cap text-dk-blue me-1"></i> Panel Administrasi 
                    </small>
                </div>
                <div class="col-md-6 text-md-end mt-2 mt-md-0">
                    <small class="text-dk-muted" style="font-size: 12px;">© {{ date('Y') }} EduLearn. All rights reserved.</small>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Load Chart.js Library via CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Teks Judul di Navbar Putih bawaan AdminLTE
        var navbarLeft = document.querySelector('.main-header .navbar-nav:first-child');
        if (navbarLeft) {
            var titleLi = document.createElement('li');
            titleLi.className = 'nav-item d-flex align-items-center ms-3';
            titleLi.innerHTML = '<span class="fw-bold text-dark" style="font-family:\'Inter\', sans-serif; font-size: 18px; letter-spacing: -0.3px;">Dashboard</span>';
            navbarLeft.appendChild(titleLi);
        }

        // Grafik Analitik Menggunakan Chart.js
        const ctxAnalytics = document.getElementById('analyticsChart').getContext('2d');
        new Chart(ctxAnalytics, {
            type: 'bar',
            data: {
                labels: ['Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul'],
                datasets: [
                    {
                        type: 'line',
                        label: 'Pendaftaran Siswa',
                        data: [30, 45, 38, 70, 58, 85],
                        borderColor: '#0066cc',
                        borderWidth: 2.5,
                        backgroundColor: 'rgba(0, 102, 204, 0.05)',
                        fill: true,
                        tension: 0.35
                    },
                    {
                        label: 'Pendaftaran Guru',
                        data: [12, 18, 10, 25, 14, 28],
                        backgroundColor: 'rgba(19, 136, 19, 0.85)',
                        borderRadius: 4,
                        barThickness: 18
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: true, position: 'top', labels: { boxWidth: 12, font: { family: 'Inter', size: 12 } } }
                },
                scales: {
                    x: { grid: { display: false }, ticks: { font: { family: 'Inter' } } },
                    y: { grid: { color: '#f1f1f1' }, ticks: { font: { family: 'Inter' } } }
                }
            }
        });
    });
</script>
@endsection