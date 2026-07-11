@extends('adminlte::page')

@section('title', 'Quiz')

@section('content')

<div class="container-fluid pt-4">

    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg navbar-light bg-white mb-4 shadow-sm rounded-lg py-2">
        <div class="navbar-brand font-weight-bold text-primary ml-2">
            Daftar Quiz
        </div>

        <div class="ml-auto">

        @if(in_array(strtolower(auth()->user()->role), ['admin','guru']))

            <a href="{{ route('quiz.results') }}"
            class="btn btn-success mr-2">
                <i class="fas fa-chart-bar"></i>
                Hasil Quiz
            </a>

            <a href="{{ route('quiz.create') }}"
            class="btn btn-primary">
                <i class="fas fa-plus"></i>
                Buat Quiz
            </a>

        @endif

        </div>
    </nav>

    {{-- Header --}}
    <div class="mb-4">
        <h2 class="font-weight-bold text-dark">
            Eksplorasi Quiz
        </h2>

        <p class="text-muted">
            Uji kemampuanmu dengan berbagai materi yang tersedia.
        </p>
    </div>

    {{-- Alert --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    {{-- Search --}}
    <div class="card border-0 shadow-sm rounded-lg mb-4">
        <div class="card-body">

            <form action="{{ route('quiz.index') }}" method="GET" class="d-flex">

                <input
                    type="text"
                    name="query"
                    value="{{ request('query') }}"
                    class="form-control bg-light border-0 rounded-pill px-4"
                    placeholder="Cari judul quiz...">

                <button class="btn btn-primary rounded-pill px-4 ml-2">
                    Cari
                </button>

            </form>

        </div>
    </div>

    {{-- Quiz --}}
    <div class="row">

        @forelse($quizzes as $quiz)

        <div class="col-lg-4 mb-4">

            <div class="card border-0 shadow-sm rounded-lg h-100">

                <div class="card-body">

                    @php

                        switch($quiz->kategori){

                            case 'Pemrograman Web':
                                $color='bg-primary';
                                break;

                            case 'Basis Data':
                                $color='bg-info';
                                break;

                            case 'Algoritma':
                                $color='bg-success';
                                break;

                            default:
                                $color='bg-secondary';

                        }

                    @endphp

                    <span class="badge {{ $color }} text-white px-3 py-2 rounded-pill mb-3">

                        {{ $quiz->kategori }}

                    </span>

                    <h5 class="font-weight-bold">

                        {{ $quiz->judul }}

                    </h5>

                    <p class="text-muted small mb-1">

                        {{ $quiz->jumlah_soal }} Soal Pilihan Ganda

                    </p>

                    <small class="text-secondary">

                        Dibuat oleh :
                        {{ $quiz->pembuat }}

                    </small>

                    <br><br>

                    @if($quiz->status=='pending')

                        <span class="badge badge-warning">

                            Pending

                        </span>

                    @else

                        <span class="badge badge-success">

                            Approved

                        </span>

                    @endif

                    <hr>

                    {{-- ADMIN --}}
                    @if(strtolower(auth()->user()->role)=='admin')

                        @if($quiz->status=='pending')

                        <form
                            action="{{ route('quiz.approve',$quiz->id) }}"
                            method="POST">

                            @csrf
                            @method('PATCH')

                            <button class="btn btn-success btn-block">

                                <i class="fas fa-check"></i>

                                ACC Quiz

                            </button>

                        </form>

                        @else

                            <button
                                class="btn btn-secondary btn-block"
                                disabled>

                                Sudah Di-ACC

                            </button>

                        @endif

                    @else

                        {{-- Guru --}}
                        @if(strtolower(auth()->user()->role)=='guru')

                            @if($quiz->status=='pending')

                                <button
                                    class="btn btn-warning btn-block"
                                    disabled>

                                    Menunggu ACC Admin

                                </button>

                            @else

                                <a href="{{ route('questions.index', $quiz->id) }}"
                                class="btn btn-primary btn-block">
                                    Tambah Soal
                                </a>

                            @endif

                        @endif

                        {{-- Siswa --}}
                        @if(strtolower(auth()->user()->role)=='siswa')

                            @if($quiz->status=='approved')

                                <a href="{{ route('questions.play', $quiz->id) }}"
                                class="btn btn-primary btn-block">
                                    Kerjakan Quiz
                                </a>
  
                            @endif

                        @endif

                    @endif

                </div>

            </div>

        </div>

        @empty

        <div class="col-12">

            <div class="alert alert-info text-center">

                Belum ada quiz.

            </div>

        </div>

        @endforelse

    </div>

    {{-- Riwayat Quiz --}}
    <div class="card border-0 shadow-sm rounded-lg mt-2">

        <div class="card-header bg-white border-0">

            <h5 class="font-weight-bold">

                Riwayat Quiz

            </h5>

        </div>

        <div class="card-body">

            <table class="table table-hover">

                <thead>

                <tr>

                    <th>Quiz</th>

                    <th>Nilai</th>

                    <th>Status</th>

                </tr>

                </thead>

                <tbody>

                    @forelse($results as $result)

                    <tr>

                        <td>{{ $result->quiz->judul }}</td>

                        <td>{{ $result->nilai }}</td>

                        <td>

                            @if($result->status == 'Lulus')

                                <span class="badge badge-success">
                                    Lulus
                                </span>

                            @else

                                <span class="badge badge-warning">
                                    Remedial
                                </span>

                            @endif

                        </td>

                    </tr>

                    @empty

                    <tr>

                    <td colspan="3" class="text-center text-muted">

                    Belum ada riwayat quiz.

                    </td>

                    </tr>

                    @endforelse

                    </tbody>

            </table>

        </div>

    </div>

</div>

@endsection