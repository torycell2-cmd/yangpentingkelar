@extends('adminlte::page')

@section('content')

<div class="container-fluid">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 class="fw-bold mb-1">Eksplorasi Quiz</h2>
            <p class="text-muted mb-0">
                Kerjakan quiz untuk menguji kemampuanmu.
            </p>
        </div>

        <span class="badge bg-primary fs-6 px-4 py-3 rounded-pill shadow">
            12 Quiz Tersedia
        </span>

    </div>

    {{-- Statistik --}}
    <div class="row g-4 mb-4">

        <div class="col-md-4">

            <div class="card border-0 shadow rounded-4">

                <div class="card-body text-center py-4">

                    <h2 class="fw-bold text-primary">12</h2>

                    <p class="text-muted mb-0">
                        Quiz Tersedia
                    </p>

                </div>

            </div>

        </div>

        <div class="col-md-4">

            <div class="card border-0 shadow rounded-4">

                <div class="card-body text-center py-4">

                    <h2 class="fw-bold text-success">5</h2>

                    <p class="text-muted mb-0">
                        Sudah Dikerjakan
                    </p>

                </div>

            </div>

        </div>

        <div class="col-md-4">

            <div class="card border-0 shadow rounded-4">

                <div class="card-body text-center py-4">

                    <h2 class="fw-bold text-warning">87</h2>

                    <p class="text-muted mb-0">
                        Nilai Rata-rata
                    </p>

                </div>

            </div>

        </div>

    </div>

    {{-- Search --}}
    <div class="card border-0 shadow rounded-4 mb-5">

        <div class="card-body">

            <div class="row g-3">

                <div class="col-md-8">

                    <input
                        type="text"
                        class="form-control rounded-pill"
                        placeholder="Cari quiz...">

                </div>

                <div class="col-md-2">

                    <select class="form-select rounded-pill">

                        <option>Semua</option>
                        <option>Pemrograman Web</option>
                        <option>Basis Data</option>
                        <option>Algoritma</option>

                    </select>

                </div>

                <div class="col-md-2">

                    <button class="btn btn-primary w-100 rounded-pill">

                        Cari

                    </button>

                </div>

            </div>

        </div>

    </div>

    {{-- Quiz --}}
    <div class="row g-4">

        <div class="col-lg-4">

            <div class="card border-0 shadow rounded-4 h-100">

                <div class="card-body">

                    <span class="badge bg-primary rounded-pill mb-3">

                        Pemrograman Web

                    </span>

                    <h4 class="fw-bold">

                        Dasar Laravel

                    </h4>

                    <p class="text-muted">

                        Pelajari dasar Laravel melalui 10 soal pilihan ganda.

                    </p>

                    <hr>

                    <p class="mb-2">
                        ⭐ Level : Mudah
                    </p>

                    <p class="mb-2">
                        ⏱️ Durasi : 20 Menit
                    </p>

                    <p>
                        👨‍🏫 Pak Maulana
                    </p>

                </div>

                <div class="card-footer bg-white border-0">

                    <a href="#" class="btn btn-primary rounded-pill w-100">

                        Kerjakan Quiz

                    </a>

                </div>

            </div>

        </div>

        <div class="col-lg-4">

            <div class="card border-0 shadow rounded-4 h-100">

                <div class="card-body">

                    <span class="badge bg-success rounded-pill mb-3">

                        Basis Data

                    </span>

                    <h4 class="fw-bold">

                        MySQL Dasar

                    </h4>

                    <p class="text-muted">

                        Uji pemahaman SQL dan database.

                    </p>

                    <hr>

                    <p class="mb-2">
                        ⭐ Level : Sedang
                    </p>

                    <p class="mb-2">
                        ⏱️ Durasi : 30 Menit
                    </p>

                    <p>
                        👩‍🏫 Bu Sinta
                    </p>

                </div>

                <div class="card-footer bg-white border-0">

                    <a href="#" class="btn btn-success rounded-pill w-100">

                        Kerjakan Quiz

                    </a>

                </div>

            </div>

        </div>

        <div class="col-lg-4">

            <div class="card border-0 shadow rounded-4 h-100">

                <div class="card-body">

                    <span class="badge bg-warning text-dark rounded-pill mb-3">

                        Algoritma

                    </span>

                    <h4 class="fw-bold">

                        Struktur Data

                    </h4>

                    <p class="text-muted">

                        Latih logika algoritma dan struktur data.

                    </p>

                    <hr>

                    <p class="mb-2">
                        ⭐ Level : Sulit
                    </p>

                    <p class="mb-2">
                        ⏱️ Durasi : 40 Menit
                    </p>

                    <p>
                        👨‍🏫 Pak Andi
                    </p>

                </div>

                <div class="card-footer bg-white border-0">

                    <a href="#" class="btn btn-warning text-dark rounded-pill w-100">

                        Kerjakan Quiz

                    </a>

                </div>

            </div>

        </div>

    </div>

    {{-- Riwayat --}}
    <div class="card border-0 shadow rounded-4 mt-5">

        <div class="card-header bg-white border-0">

            <h5 class="fw-bold mb-0">

                Riwayat Quiz

            </h5>

        </div>

        <div class="card-body p-0">

            <table class="table table-hover mb-0">

                <thead>

                    <tr>

                        <th>Quiz</th>

                        <th>Nilai</th>

                        <th>Status</th>

                        <th>Tanggal</th>

                    </tr>

                </thead>

                <tbody>

                    <tr>

                        <td>Dasar Laravel</td>

                        <td>90</td>

                        <td>
                            <span class="badge bg-success">
                                Lulus
                            </span>
                        </td>

                        <td>10 Juli 2026</td>

                    </tr>

                    <tr>

                        <td>MySQL Dasar</td>

                        <td>75</td>

                        <td>
                            <span class="badge bg-warning text-dark">
                                Remedial
                            </span>
                        </td>

                        <td>8 Juli 2026</td>

                    </tr>

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection