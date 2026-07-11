@extends('layouts.layouts')

@section('content')

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-lg-8">

            <div class="card border-0 shadow rounded-4">

                <div class="card-body p-5 text-center">

                    {{-- Icon --}}
                    <div class="mb-4">

                        <div class="rounded-circle bg-success bg-opacity-25 d-inline-flex justify-content-center align-items-center"
                             style="width:120px;height:120px;">

                            <span style="font-size:55px;">
                                🎉
                            </span>

                        </div>

                    </div>

                    <h2 class="fw-bold mb-2">
                        Quiz Selesai!
                    </h2>

                    <p class="text-muted mb-4">
                        Selamat! Kamu telah menyelesaikan quiz.
                    </p>

                    {{-- Nilai --}}
                    <div class="card border-0 bg-light rounded-4 mb-4">

                        <div class="card-body">

                            <h6 class="text-muted">
                                Nilai Akhir
                            </h6>

                            <h1 class="display-3 fw-bold text-primary">
                                90
                            </h1>

                            <span class="badge bg-success rounded-pill px-4 py-2 fs-6">
                                LULUS
                            </span>

                        </div>

                    </div>

                    {{-- Statistik --}}
                    <div class="row text-center mb-4">

                        <div class="col-md-4 mb-3">

                            <div class="card border-0 shadow-sm rounded-4">

                                <div class="card-body">

                                    <h3 class="text-success fw-bold">
                                        9
                                    </h3>

                                    <p class="text-muted mb-0">
                                        Jawaban Benar
                                    </p>

                                </div>

                            </div>

                        </div>

                        <div class="col-md-4 mb-3">

                            <div class="card border-0 shadow-sm rounded-4">

                                <div class="card-body">

                                    <h3 class="text-danger fw-bold">
                                        1
                                    </h3>

                                    <p class="text-muted mb-0">
                                        Jawaban Salah
                                    </p>

                                </div>

                            </div>

                        </div>

                        <div class="col-md-4 mb-3">

                            <div class="card border-0 shadow-sm rounded-4">

                                <div class="card-body">

                                    <h3 class="text-primary fw-bold">
                                        10
                                    </h3>

                                    <p class="text-muted mb-0">
                                        Total Soal
                                    </p>

                                </div>

                            </div>

                        </div>

                    </div>

                    {{-- Motivasi --}}
                    <div class="alert alert-success rounded-4 border-0">

                        <h5 class="fw-bold">
                            Kerja Bagus! 👏
                        </h5>

                        <p class="mb-0">
                            Kamu berhasil memahami materi dengan sangat baik.
                            Terus tingkatkan kemampuanmu dengan mencoba quiz lainnya.
                        </p>

                    </div>

                    {{-- Tombol --}}
                    <div class="d-flex justify-content-center gap-3 mt-4">

                        <a href="#" class="btn btn-primary rounded-pill px-4">

                            Kembali ke Daftar Quiz

                        </a>

                        <a href="#" class="btn btn-outline-success rounded-pill px-4">

                            Kerjakan Lagi

                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection