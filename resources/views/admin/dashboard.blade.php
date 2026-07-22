@extends('adminlte::page')

@push('css')
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

        /* Accent Colors */
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

        /* Status Badge */
        .status-badge-fixed {
            display: inline-block;
            width: 90px;
            text-align: center;
            padding: 6px 0;
            font-size: 11.5px;
            font-weight: 600;
            border-radius: 6px;
            transition: all 0.2s ease;
        }
        .status-badge-fixed:hover {
            opacity: 0.85;
            transform: scale(1.03);
        }

        /* Activity Timeline */
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
@endpush

@section('content')
<div class="container-fluid dk-wrapper">

    <!-- Flash Message Notifikasi Success -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4 border-0 shadow-sm" role="alert">
            <i class="fa-solid fa-circle-check me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

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
                    <span class="stat-value text-dark" id="stat-total-siswa">0</span>
                    <span class="stat-subtext text-success fw-bold"><i class="fa-solid fa-arrow-up me-1"></i> Terdaftar di sistem</span>
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
                    <span class="stat-value text-dk-blue" id="stat-siswa-baru">+0</span>
                    <span class="stat-subtext text-muted">Akun baru bulan ini</span>
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
                    <span class="stat-value text-dk-green" id="stat-guru-aktif">0</span>
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
                    <span class="stat-value text-dark" id="stat-guru-keluar">0</span>
                    <span class="stat-subtext text-danger fw-medium">Dinonaktifkan / Keluar</span>
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

    <!-- BARIS 3: Tabel Manajemen Guru, Tabel Siswa & Aktivitas Sistem -->
    <div class="row mb-5">
        <!-- Kolom Tabel Manajemen Guru & Siswa -->
        <div class="col-lg-7 mb-4 mb-lg-0 d-flex flex-column gap-4">
            <!-- Table 1: Guru -->
            <div class="card dk-card p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="fw-bold text-dark mb-0" style="font-size: 16px;">Manajemen Akun Guru Terbaru</h6>
                    <a href="#" class="btn btn-sm btn-light text-dk-blue fw-semibold">Lihat Semua</a>
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
                            @forelse($recentGurus as $guru)
                                <tr class="border-bottom border-light">
                                    <td class="py-3 ps-0">
                                        <div class="d-flex align-items-center">
                                            <div class="bg-light rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px;">
                                                <i class="fa-solid fa-user text-secondary" style="font-size: 12px;"></i>
                                            </div>
                                            <span class="fw-semibold text-dark">{{ $guru->name }}</span>
                                        </div>
                                    </td>
                                    <td class="py-3 text-muted text-center">
                                        {{ $guru->created_at ? $guru->created_at->format('d M Y') : '-' }}
                                    </td>
                                    <td class="py-3 text-end">
                                        <form action="{{ route('admin.users.toggle-status', $guru->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn p-0 border-0 bg-transparent" onclick="return confirm('Apakah Anda yakin ingin mengubah status akun guru ini?')">
                                                @if(strtolower($guru->status ?? 'aktif') === 'aktif')
                                                    <span class="status-badge-fixed bg-success-subtle text-success border border-success-subtle" title="Klik untuk menonaktifkan">
                                                        <i class="fa-solid fa-check me-1"></i> Aktif
                                                    </span>
                                                @else
                                                    <span class="status-badge-fixed bg-danger-subtle text-danger border border-danger-subtle" title="Klik untuk mengaktifkan">
                                                        <i class="fa-solid fa-xmark me-1"></i> Non-Aktif
                                                    </span>
                                                @endif
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center py-4 text-muted">
                                        <i class="fa-solid fa-user-slash d-block mb-2" style="font-size: 24px;"></i>
                                        Belum ada data akun guru terdaftar.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Table 2: Siswa (BARU DITAMBAHKAN) -->
            <div class="card dk-card p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="fw-bold text-dark mb-0" style="font-size: 16px;">Manajemen Akun Siswa Terbaru</h6>
                    <a href="#" class="btn btn-sm btn-light text-dk-blue fw-semibold">Lihat Semua</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0" style="font-size: 13.5px;">
                        <thead>
                            <tr class="text-dk-muted border-bottom" style="font-size: 11px; letter-spacing: 0.5px;">
                                <th class="pb-3 ps-0">NAMA SISWA</th>
                                <th class="pb-3 text-center">TANGGAL TERDAFTAR</th>
                                <th class="pb-3 text-end" style="padding-right: 20px;">STATUS AKUN</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentSiswas ?? [] as $siswa)
                                <tr class="border-bottom border-light">
                                    <td class="py-3 ps-0">
                                        <div class="d-flex align-items-center">
                                            <div class="bg-light rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px;">
                                                <i class="fa-solid fa-graduation-cap text-dk-blue" style="font-size: 12px;"></i>
                                            </div>
                                            <span class="fw-semibold text-dark">{{ $siswa->name }}</span>
                                        </div>
                                    </td>
                                    <td class="py-3 text-muted text-center">
                                        {{ $siswa->created_at ? $siswa->created_at->format('d M Y') : '-' }}
                                    </td>
                                    <td class="py-3 text-end">
                                        <form action="{{ route('admin.users.toggle-status', $siswa->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn p-0 border-0 bg-transparent" onclick="return confirm('Apakah Anda yakin ingin mengubah status akun siswa ini?')">
                                                @if(strtolower($siswa->status ?? 'aktif') === 'aktif')
                                                    <span class="status-badge-fixed bg-success-subtle text-success border border-success-subtle" title="Klik untuk menonaktifkan">
                                                        <i class="fa-solid fa-check me-1"></i> Aktif
                                                    </span>
                                                @else
                                                    <span class="status-badge-fixed bg-danger-subtle text-danger border border-danger-subtle" title="Klik untuk mengaktifkan">
                                                        <i class="fa-solid fa-xmark me-1"></i> Non-Aktif
                                                    </span>
                                                @endif
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center py-4 text-muted">
                                        <i class="fa-solid fa-user-graduate d-block mb-2" style="font-size: 24px;"></i>
                                        Belum ada data akun siswa terdaftar.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Kolom Aktivitas Sistem Terbaru (DINAMIS DARI CONTROLLER) -->
        <div class="col-lg-5">
            <div class="card dk-card p-4 h-100 d-flex flex-column justify-content-between">
                <div>
                    <h6 class="fw-bold text-dark mb-3" style="font-size: 16px;">Aktivitas Sistem Terbaru</h6>
                    
                    <ul class="activity-feed">
                        @forelse($recentActivities as $activity)
                            <li class="activity-item {{ $activity['type'] ?? '' }}">
                                <div class="d-flex justify-content-between small">
                                    <span class="fw-semibold text-dark">{{ $activity['title'] }}</span>
                                    <span class="text-muted" style="font-size: 11px;">{{ $activity['time'] }}</span>
                                </div>
                                <span class="text-muted small">{{ $activity['description'] }}</span>
                            </li>
                        @empty
                            <li class="text-center py-4 text-muted small">
                                <i class="fa-solid fa-clock-rotate-left d-block mb-2" style="font-size: 20px;"></i>
                                Belum ada aktivitas terbaru.
                            </li>
                        @endforelse
                    </ul>
                </div>

                <!-- Informasi Kesehatan Sistem Nyata -->
                <div class="pt-3 border-top mt-4">
                    <h6 class="fw-bold text-dark mb-2" style="font-size: 13.5px;">Kesehatan & Status Sistem</h6>
                    <div class="d-flex gap-4 align-items-center justify-content-between text-center mt-2">
                        <div class="w-100 bg-light p-2 rounded">
                            <span class="text-dk-muted d-block mb-1" style="font-size: 11px;">DATABASE</span>
                            <span class="badge bg-success-subtle text-success small fw-bold"><i class="fa-solid fa-circle-check"></i> Connected</span>
                        </div>
                        <div class="w-100 bg-light p-2 rounded">
                            <span class="text-dk-muted d-block mb-1" style="font-size: 11px;">ENVIRONMENT</span>
                            <span class="text-dark fw-bold small">{{ strtoupper(app()->environment()) }}</span>
                        </div>
                        <div class="w-100 bg-light p-2 rounded">
                            <span class="text-dk-muted d-block mb-1" style="font-size: 11px;">PHP VERSION</span>
                            <span class="text-dark fw-bold small">v{{ PHP_MAJOR_VERSION . '.' . PHP_MINOR_VERSION }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- BARIS 4: Footer -->
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
@endsection

@push('js')
<!-- Load Chart.js Library via CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Dynamic Navbar Title
        var navbarLeft = document.querySelector('.main-header .navbar-nav:first-child');
        if (navbarLeft) {
            var titleLi = document.createElement('li');
            titleLi.className = 'nav-item d-flex align-items-center ms-3';
            titleLi.innerHTML = '<span class="fw-bold text-dark" style="font-family:\'Inter\', sans-serif; font-size: 18px; letter-spacing: -0.3px;">Dashboard</span>';
            navbarLeft.appendChild(titleLi);
        }

        // Analytics Chart Setup
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

        // Polling Real-time Stats
        let isFetching = false;
        function updateAdminStats() {
            if (isFetching) return;
            isFetching = true;

            fetch("{{ route('admin.stats') }}")
                .then(response => {
                    if (!response.ok) throw new Error('Gagal mengambil data statistik');
                    return response.json();
                })
                .then(data => {
                    const elements = {
                        'stat-total-siswa': Number(data.total_siswa).toLocaleString(),
                        'stat-siswa-baru': '+' + Number(data.siswa_baru).toLocaleString(),
                        'stat-guru-aktif': Number(data.guru_aktif).toLocaleString(),
                        'stat-guru-keluar': Number(data.guru_keluar).toLocaleString()
                    };

                    Object.keys(elements).forEach(id => {
                        const el = document.getElementById(id);
                        if (el) el.innerText = elements[id];
                    });
                })
                .catch(error => console.error('Error Polling Stats:', error))
                .finally(() => {
                    isFetching = false;
                });
        }

        updateAdminStats();
        setInterval(updateAdminStats, 5000);
    });
</script>
@endpush