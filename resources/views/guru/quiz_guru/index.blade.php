@extends('adminlte::page')

@section('content')

<div class="container py-4">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 class="fw-bold mb-1">Quiz Saya</h2>
            <p class="text-muted mb-0">
                Kelola quiz yang telah dibuat sebelum diterbitkan oleh Admin.
            </p>
        </div>

        <a href="#" class="btn btn-primary px-4 py-2 rounded-pill shadow-sm">
            <i class="bi bi-plus-circle"></i> + Buat Quiz
        </a>

    </div>

    {{-- Statistik --}}
    <div class="row mb-4">

        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body text-center">
                    <h2 class="fw-bold text-primary">8</h2>
                    <p class="text-muted mb-0">Total Quiz</p>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body text-center">
                    <h2 class="fw-bold text-warning">2</h2>
                    <p class="text-muted mb-0">Menunggu ACC</p>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body text-center">
                    <h2 class="fw-bold text-success">5</h2>
                    <p class="text-muted mb-0">Disetujui</p>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body text-center">
                    <h2 class="fw-bold text-danger">1</h2>
                    <p class="text-muted mb-0">Ditolak</p>
                </div>
            </div>
        </div>

    </div>

    {{-- Daftar Quiz --}}
    <div class="row">

        {{-- Quiz 1 --}}
        <div class="col-lg-6 mb-4">

            <div class="card border-0 shadow rounded-4 h-100">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-start">

                        <div>

                            <span class="badge bg-primary rounded-pill mb-2">
                                Pemrograman Web
                            </span>

                            <h4 class="fw-bold">
                                Dasar Laravel
                            </h4>

                            <p class="text-muted mb-2">
                                10 Soal Pilihan Ganda
                            </p>

                        </div>

                        <span class="badge bg-warning text-dark rounded-pill">
                            Menunggu ACC
                        </span>

                    </div>

                    <hr>

                    <div class="d-flex justify-content-between">

                        <small class="text-secondary">
                            Dibuat : 09 Juli 2026
                        </small>

                        <small class="text-secondary">
                            Terakhir diubah : Hari ini
                        </small>

                    </div>

                </div>

                <div class="card-footer bg-white border-0 pb-4">

                    <button class="btn btn-outline-primary rounded-pill">
                        Edit
                    </button>

                    <button class="btn btn-outline-secondary rounded-pill">
                        Detail
                    </button>

                </div>

            </div>

        </div>

        {{-- Quiz 2 --}}
        <div class="col-lg-6 mb-4">

            <div class="card border-0 shadow rounded-4 h-100">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-start">

                        <div>

                            <span class="badge bg-success rounded-pill mb-2">
                                Basis Data
                            </span>

                            <h4 class="fw-bold">
                                MySQL Dasar
                            </h4>

                            <p class="text-muted mb-2">
                                15 Soal Pilihan Ganda
                            </p>

                        </div>

                        <span class="badge bg-success rounded-pill">
                            Disetujui
                        </span>

                    </div>

                    <hr>

                    <div class="d-flex justify-content-between">

                        <small class="text-secondary">
                            Dibuat : 08 Juli 2026
                        </small>

                        <small class="text-secondary">
                            Terbit : 09 Juli 2026
                        </small>

                    </div>

                </div>

                <div class="card-footer bg-white border-0 pb-4">

                    <button class="btn btn-outline-primary rounded-pill">
                        Edit
                    </button>

                    <button class="btn btn-outline-success rounded-pill">
                        Lihat Quiz
                    </button>

                </div>

            </div>

        </div>

        {{-- Quiz 3 --}}
        <div class="col-lg-6 mb-4">

            <div class="card border-0 shadow rounded-4 h-100">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-start">

                        <div>

                            <span class="badge bg-danger rounded-pill mb-2">
                                Algoritma
                            </span>

                            <h4 class="fw-bold">
                                Struktur Data
                            </h4>

                            <p class="text-muted mb-2">
                                20 Soal Pilihan Ganda
                            </p>

                        </div>

                        <span class="badge bg-danger rounded-pill">
                            Ditolak
                        </span>

                    </div>

                    <hr>

                    <div class="alert alert-danger rounded-3 mb-0">

                        <strong>Catatan Admin</strong><br>

                        Perbaiki soal nomor 4 karena pilihan jawaban belum lengkap.

                    </div>

                </div>

                <div class="card-footer bg-white border-0 pb-4">

                    <button class="btn btn-outline-danger rounded-pill">
                        Perbaiki Quiz
                    </button>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection