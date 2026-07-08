@extends('layouts.layouts')

@section('content')

<div class="container py-4">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">Quiz</h2>
            <p class="text-muted mb-0">Uji kemampuanmu dengan berbagai quiz yang tersedia.</p>
        </div>

        {{-- Tombol untuk Guru/Dosen (sementara hanya tampilan) --}}
        <button class="btn btn-primary">
            + Buat Quiz
        </button>
    </div>

    {{-- Search --}}
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <div class="row g-3">

                <div class="col-md-8">
                    <input
                        type="text"
                        class="form-control"
                        placeholder="Cari quiz...">
                </div>

                <div class="col-md-4">
                    <button class="btn btn-success w-100">
                        Cari
                    </button>
                </div>

            </div>
        </div>
    </div>

    {{-- Daftar Quiz --}}
    <div class="row">

        {{-- Quiz 1 --}}
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm h-100 border-0">

                <div class="card-body">

                    <span class="badge bg-primary mb-2">
                        Pemrograman Web
                    </span>

                    <h5 class="fw-bold">
                        Dasar Laravel
                    </h5>

                    <p class="text-muted">
                        10 Soal Pilihan Ganda
                    </p>

                    <small class="text-secondary">
                        Dibuat oleh: Pak Andi
                    </small>

                </div>

                <div class="card-footer bg-white border-0">
                    <button class="btn btn-success w-100">
                        Kerjakan Quiz
                    </button>
                </div>

            </div>
        </div>

        {{-- Quiz 2 --}}
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm h-100 border-0">

                <div class="card-body">

                    <span class="badge bg-warning text-dark mb-2">
                        Basis Data
                    </span>

                    <h5 class="fw-bold">
                        MySQL Dasar
                    </h5>

                    <p class="text-muted">
                        15 Soal Pilihan Ganda
                    </p>

                    <small class="text-secondary">
                        Dibuat oleh: Bu Rina
                    </small>

                </div>

                <div class="card-footer bg-white border-0">
                    <button class="btn btn-success w-100">
                        Kerjakan Quiz
                    </button>
                </div>

            </div>
        </div>

        {{-- Quiz 3 --}}
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm h-100 border-0">

                <div class="card-body">

                    <span class="badge bg-danger mb-2">
                        Algoritma
                    </span>

                    <h5 class="fw-bold">
                        Struktur Data
                    </h5>

                    <p class="text-muted">
                        20 Soal Pilihan Ganda
                    </p>

                    <small class="text-secondary">
                        Dibuat oleh: Pak Budi
                    </small>

                </div>

                <div class="card-footer bg-white border-0">
                    <button class="btn btn-success w-100">
                        Kerjakan Quiz
                    </button>
                </div>

            </div>
        </div>

    </div>

    {{-- Riwayat Quiz (Dummy) --}}
    <div class="card shadow-sm border-0 mt-4">

        <div class="card-header bg-primary text-white">
            Riwayat Quiz
        </div>

        <div class="card-body p-0">

            <table class="table table-hover mb-0">

                <thead class="table-light">
                    <tr>
                        <th>Quiz</th>
                        <th>Nilai</th>
                        <th>Status</th>
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
                    </tr>

                    <tr>
                        <td>MySQL Dasar</td>
                        <td>75</td>
                        <td>
                            <span class="badge bg-warning text-dark">
                                Remedial
                            </span>
                        </td>
                    </tr>

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection