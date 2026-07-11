@extends('adminlte::page')

@section('content')

<div class="container py-4">

    {{-- Header --}}
    <div class="mb-4">
        <h2 class="fw-bold">Buat Quiz Baru</h2>
        <p class="text-muted">
            Lengkapi informasi quiz dan tambahkan soal yang akan diberikan kepada siswa.
        </p>
    </div>

    <form>

        {{-- Informasi Quiz --}}
        <div class="card border-0 shadow-sm rounded-4 mb-4">

            <div class="card-header bg-white border-0 pt-4">
                <h5 class="fw-bold mb-0">
                    Informasi Quiz
                </h5>
            </div>

            <div class="card-body">

                <div class="mb-3">
                    <label class="form-label fw-semibold">
                        Judul Quiz
                    </label>

                    <input
                        type="text"
                        class="form-control"
                        placeholder="Contoh: Quiz Laravel Dasar">
                </div>

                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label class="form-label fw-semibold">
                            Mata Pelajaran
                        </label>

                        <select class="form-select">
                            <option>Pemrograman Web</option>
                            <option>Basis Data</option>
                            <option>Algoritma</option>
                            <option>Jaringan Komputer</option>
                        </select>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label fw-semibold">
                            Tingkat Kesulitan
                        </label>

                        <select class="form-select">
                            <option>Mudah</option>
                            <option>Sedang</option>
                            <option>Sulit</option>
                        </select>

                    </div>

                </div>

                <div class="mb-3">

                    <label class="form-label fw-semibold">
                        Deskripsi Quiz
                    </label>

                    <textarea
                        rows="4"
                        class="form-control"
                        placeholder="Masukkan deskripsi quiz"></textarea>

                </div>

            </div>

        </div>

        {{-- Soal --}}
        <div class="card border-0 shadow-sm rounded-4 mb-4">

            <div class="card-header bg-white border-0 pt-4 d-flex justify-content-between">

                <h5 class="fw-bold">
                    Soal Quiz
                </h5>

                <button
                    type="button"
                    class="btn btn-outline-primary rounded-pill">
                    + Tambah Soal
                </button>

            </div>

            <div class="card-body">

                <div class="border rounded-4 p-4">

                    <h6 class="fw-bold mb-3">
                        Soal 1
                    </h6>

                    <div class="mb-3">

                        <label class="form-label">
                            Pertanyaan
                        </label>

                        <textarea
                            class="form-control"
                            rows="3"
                            placeholder="Masukkan pertanyaan"></textarea>

                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <input class="form-control" placeholder="Pilihan A">
                        </div>

                        <div class="col-md-6 mb-3">
                            <input class="form-control" placeholder="Pilihan B">
                        </div>

                        <div class="col-md-6 mb-3">
                            <input class="form-control" placeholder="Pilihan C">
                        </div>

                        <div class="col-md-6 mb-3">
                            <input class="form-control" placeholder="Pilihan D">
                        </div>

                    </div>

                    <div class="mb-3">

                        <label class="form-label">
                            Jawaban Benar
                        </label>

                        <select class="form-select">
                            <option>A</option>
                            <option>B</option>
                            <option>C</option>
                            <option>D</option>
                        </select>

                    </div>

                </div>

            </div>

        </div>

        {{-- Tombol --}}
        <div class="d-flex justify-content-end gap-2">

            <button
                type="reset"
                class="btn btn-outline-secondary rounded-pill px-4">
                Reset
            </button>

            <button
                type="submit"
                class="btn btn-primary rounded-pill px-4">
                Simpan Quiz
            </button>

        </div>

    </form>

</div>

@endsection