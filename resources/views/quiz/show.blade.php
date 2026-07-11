@extends('layouts.layouts')

@section('content')

<div class="container py-4">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 class="fw-bold">Quiz Laravel Dasar</h2>
            <p class="text-muted mb-0">
                Jawablah seluruh pertanyaan dengan benar.
            </p>
        </div>

        <div class="card border-0 shadow-sm rounded-4 px-4 py-3">

            <h6 class="text-muted mb-1">
                Sisa Waktu
            </h6>

            <h3 class="fw-bold text-danger mb-0">
                14 : 59
            </h3>

        </div>

    </div>

    {{-- Progress --}}
    <div class="card border-0 shadow-sm rounded-4 mb-4">

        <div class="card-body">

            <div class="d-flex justify-content-between mb-2">

                <span class="fw-semibold">
                    Soal 3 dari 10
                </span>

                <span class="text-primary fw-bold">
                    30%
                </span>

            </div>

            <div class="progress" style="height:10px;">

                <div
                    class="progress-bar"
                    style="width:30%">
                </div>

            </div>

        </div>

    </div>

    {{-- Soal --}}
    <div class="card border-0 shadow rounded-4">

        <div class="card-body p-4">

            <h4 class="fw-bold mb-4">

                3. Apa fungsi Route pada Laravel?

            </h4>

            <div class="list-group">

                <label class="list-group-item border rounded-4 mb-3 shadow-sm">

                    <input
                        class="form-check-input me-2"
                        type="radio"
                        name="jawaban">

                    Mengatur URL aplikasi

                </label>

                <label class="list-group-item border rounded-4 mb-3 shadow-sm">

                    <input
                        class="form-check-input me-2"
                        type="radio"
                        name="jawaban">

                    Mengatur CSS Website

                </label>

                <label class="list-group-item border rounded-4 mb-3 shadow-sm">

                    <input
                        class="form-check-input me-2"
                        type="radio"
                        name="jawaban">

                    Mengatur Database

                </label>

                <label class="list-group-item border rounded-4 shadow-sm">

                    <input
                        class="form-check-input me-2"
                        type="radio"
                        name="jawaban">

                    Mengatur Session

                </label>

            </div>

        </div>

    </div>

    {{-- Navigasi --}}
    <div class="d-flex justify-content-between mt-4">

        <button
            class="btn btn-outline-secondary rounded-pill px-4">

            ← Sebelumnya

        </button>

        <button
            class="btn btn-primary rounded-pill px-4">

            Selanjutnya →

        </button>

    </div>

</div>

@endsection