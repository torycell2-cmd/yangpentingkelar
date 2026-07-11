@extends('adminlte::page')

@section('content')

<div class="container py-4">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold">Edit Quiz</h2>
            <p class="text-muted mb-0">
                Perbarui informasi quiz sebelum dikirim kembali ke Admin.
            </p>
        </div>

        <span class="badge bg-warning text-dark px-3 py-2 rounded-pill shadow-sm">
            Menunggu Revisi
        </span>
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
                        value="Dasar Laravel">
                </div>

                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label class="form-label fw-semibold">
                            Mata Pelajaran
                        </label>

                        <select class="form-select">
                            <option selected>Pemrograman Web</option>
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
                            <option selected>Mudah</option>
                            <option>Sedang</option>
                            <option>Sulit</option>
                        </select>

                    </div>

                </div>

                <div class="mb-3">

                    <label class="form-label fw-semibold">
                        Deskripsi Quiz
                    </label>

                    <textarea rows="4" class="form-control">Quiz mengenai dasar framework Laravel.</textarea>

                </div>

            </div>

        </div>

        {{-- Catatan Admin --}}
        <div class="alert alert-warning border-0 shadow-sm rounded-4 mb-4">

            <h6 class="fw-bold">
                Catatan Admin
            </h6>

            <p class="mb-0">
                Perbaiki soal nomor 3 karena pilihan jawaban belum lengkap.
            </p>

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
                            rows="3">Apa fungsi Route pada Laravel?</textarea>

                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <input class="form-control" value="Mengatur URL">
                        </div>

                        <div class="col-md-6 mb-3">
                            <input class="form-control" value="Mengatur Database">
                        </div>

                        <div class="col-md-6 mb-3">
                            <input class="form-control" value="Mengatur CSS">
                        </div>

                        <div class="col-md-6 mb-3">
                            <input class="form-control" value="Mengatur Session">
                        </div>

                    </div>

                    <div class="mb-3">

                        <label class="form-label">
                            Jawaban Benar
                        </label>

                        <select class="form-select">
                            <option selected>A</option>
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
                type="button"
                class="btn btn-outline-secondary rounded-pill px-4">
                Batal
            </button>

            <button
                type="submit"
                class="btn btn-success rounded-pill px-4">
                Simpan Perubahan
            </button>

        </div>

    </form>

</div>

@endsection