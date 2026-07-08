@extends('adminlte::page')

@section('content')
<div class="container-fluid pt-4">
    <!-- Navbar Seragam -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white mb-4 shadow-sm rounded-lg py-2">
        <div class="navbar-brand font-weight-bold text-primary ml-2">Daftar Quiz</div>
        <div class="ml-auto">
            <button class="btn btn-primary rounded-pill px-4 shadow-sm">
                <i class="fas fa-plus mr-2"></i> Buat Quiz
            </button>
        </div>
    </nav>

    <!-- Header Section -->
    <div class="mb-4">
        <h2 class="font-weight-bold text-dark">Eksplorasi Quiz</h2>
        <p class="text-muted">Uji kemampuanmu dengan berbagai materi yang tersedia.</p>
    </div>

    <!-- Search Section Modern -->
    <div class="card border-0 shadow-sm rounded-lg mb-4">
        <div class="card-body">
            <form action="#" method="GET" class="d-flex">
                <input type="text" name="search" class="form-control bg-light border-0 rounded-pill px-4" placeholder="Cari judul quiz...">
                <button type="submit" class="btn btn-primary rounded-pill px-4 ml-2 shadow-sm">Cari</button>
            </form>
        </div>
    </div>

    <!-- Quiz Grid -->
    <div class="row">
        @php
            $quizzes = [
                ['title' => 'Dasar Laravel', 'cat' => 'Pemrograman Web', 'color' => 'bg-primary', 'count' => '10 Soal'],
                ['title' => 'MySQL Dasar', 'cat' => 'Basis Data', 'color' => 'bg-info', 'count' => '15 Soal'],
                ['title' => 'Struktur Data', 'cat' => 'Algoritma', 'color' => 'bg-success', 'count' => '20 Soal']
            ];
        @endphp

        @foreach($quizzes as $q)
        <div class="col-lg-4 mb-4">
            <div class="card border-0 shadow-sm rounded-lg h-100">
                <div class="card-body">
                    <span class="badge {{ $q['color'] }} text-white px-3 py-2 rounded-pill mb-3">{{ $q['cat'] }}</span>
                    <h5 class="font-weight-bold">{{ $q['title'] }}</h5>
                    <p class="text-muted small mb-0">{{ $q['count'] }} Pilihan Ganda</p>
                    <small class="text-secondary">Dibuat oleh: Instruktur</small>
                    <button class="btn btn-outline-dark btn-block rounded-pill mt-3">Kerjakan Quiz</button>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Riwayat Table Modern -->
    <div class="card border-0 shadow-sm rounded-lg mt-2">
        <div class="card-header bg-white border-0 pt-4">
            <h5 class="font-weight-bold text-dark">Riwayat Quiz</h5>
        </div>
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="thead-light">
                    <tr>
                        <th class="border-0 pl-4">Quiz</th>
                        <th class="border-0">Nilai</th>
                        <th class="border-0">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="pl-4 font-weight-bold">Dasar Laravel</td>
                        <td>90</td>
                        <td><span class="badge badge-success px-3 rounded-pill">Lulus</span></td>
                    </tr>
                    <tr>
                        <td class="pl-4 font-weight-bold">MySQL Dasar</td>
                        <td>75</td>
                        <td><span class="badge badge-warning px-3 rounded-pill text-dark">Remedial</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop