@extends('adminlte::page')

@section('title', 'Quiz')

@section('content')

<style>

.hero{
    background:linear-gradient(135deg,#2563eb,#3b82f6,#60a5fa);
    color:white;
    border-radius:20px;
    padding:35px;
    margin-bottom:25px;
}

.hero h2{
    font-weight:bold;
}

.stat-card{
    border:none;
    border-radius:18px;
    transition:.3s;
}

.stat-card:hover{
    transform:translateY(-6px);
    box-shadow:0 15px 25px rgba(0,0,0,.15);
}

.quiz-card{
    border:none;
    border-radius:20px;
    overflow:hidden;
    transition:.3s;
}

.quiz-card:hover{
    transform:translateY(-8px);
    box-shadow:0 20px 35px rgba(0,0,0,.15);
}

.quiz-header{
    height:120px;
    background:linear-gradient(135deg,#2563eb,#60a5fa);
    display:flex;
    justify-content:center;
    align-items:center;
    color:white;
    font-size:55px;
}

.search-box input{
    border-radius:30px;
}

.progress{
    height:10px;
    border-radius:20px;
}

</style>

<div class="container-fluid py-4">

    {{-- HERO --}}

    <div class="hero">

        <div class="row align-items-center">

            <div class="col-md-8">

                <h2>👋 Selamat Datang</h2>

                <p class="mb-0">

                    Uji kemampuanmu melalui Quiz yang telah disediakan.

                </p>

            </div>

            <div class="col-md-4 text-right">

                @if(in_array(strtolower(auth()->user()->role),['admin','guru']))

                    <a
                        href="{{ route('quiz.create') }}"
                        class="btn btn-light rounded-pill px-4">

                        <i class="fas fa-plus"></i>

                        Buat Quiz

                    </a>

                @endif

            </div>

        </div>

    </div>

    {{-- STATISTIK --}}

    <div class="row mb-4">

        <div class="col-md-4">

            <div class="card stat-card shadow">

                <div class="card-body text-center">

                    <i class="fas fa-book fa-2x text-primary mb-3"></i>

                    <h3>{{ $quizzes->count() }}</h3>

                    <p>Total Quiz</p>

                </div>

            </div>

        </div>

        <div class="col-md-4">

            <div class="card stat-card shadow">

                <div class="card-body text-center">

                    <i class="fas fa-check-circle fa-2x text-success mb-3"></i>

                    <h3>

                        {{ $quizzes->where('status','approved')->count() }}

                    </h3>

                    <p>Quiz Approved</p>

                </div>

            </div>

        </div>

        <div class="col-md-4">

            <div class="card stat-card shadow">

                <div class="card-body text-center">

                    <i class="fas fa-user-graduate fa-2x text-warning mb-3"></i>

                    <h3>

                        {{ $results->count() }}

                    </h3>

                    <p>Quiz Selesai</p>

                </div>

            </div>

        </div>

    </div>

    {{-- SEARCH --}}

    <div class="card border-0 shadow mb-4">

        <div class="card-body">

            <form
                action="{{ route('quiz.index') }}"
                method="GET"
                class="search-box">

                <div class="input-group">

                    <input
                        type="text"
                        name="query"
                        class="form-control"
                        value="{{ request('query') }}"
                        placeholder="Cari Quiz...">

                    <div class="input-group-append">

                        <button
                            class="btn btn-primary rounded-pill px-4">

                            Cari

                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>

    {{-- LIST QUIZ --}}

    <div class="row">

    @forelse($quizzes as $quiz)

@php

    switch(strtolower($quiz->kategori)){

        case 'pemrograman web':
            $color='primary';
            $icon='fas fa-code';
            break;

        case 'basis data':
            $color='success';
            $icon='fas fa-database';
            break;

        case 'algoritma':
            $color='warning';
            $icon='fas fa-project-diagram';
            break;

        case 'matematika':
            $color='danger';
            $icon='fas fa-square-root-alt';
            break;

        default:
            $color='info';
            $icon='fas fa-book';

    }

@endphp

<div class="col-lg-4 mb-4">

    <div class="card quiz-card shadow h-100">

        <div class="quiz-header bg-{{ $color }}">

            <i class="{{ $icon }}"></i>

        </div>

        <div class="card-body d-flex flex-column">

            <span class="badge badge-{{ $color }} mb-2">

                {{ $quiz->kategori }}

            </span>

            <h4 class="font-weight-bold">

                {{ $quiz->judul }}

            </h4>

            <p class="text-muted mb-1">

                {{ $quiz->jumlah_soal }} Soal

            </p>

            <p class="text-muted mb-3">

                ⏰ {{ $quiz->durasi }} Menit

            </p>

            <small class="text-secondary">

                Dibuat oleh :
                <strong>{{ $quiz->pembuat }}</strong>

            </small>

            <hr>

            @if($quiz->status=='approved')

                <span class="badge badge-success mb-3">

                    Approved

                </span>

            @else

                <span class="badge badge-warning mb-3">

                    Pending

                </span>

            @endif

            {{-- ================= ADMIN ================= --}}

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

@endif


{{-- ================= GURU ================= --}}

@if(strtolower(auth()->user()->role)=='guru')

    @if($quiz->status=='approved')

        <a
            href="{{ route('questions.index',$quiz->id) }}"
            class="btn btn-primary btn-block">

            <i class="fas fa-edit"></i>

            Tambah Soal

        </a>

    @else

        <button
            class="btn btn-warning btn-block"
            disabled>

            Menunggu ACC Admin

        </button>

    @endif

@endif


{{-- ================= SISWA ================= --}}

@if(strtolower(auth()->user()->role)=='siswa')

    @php

        $hasil = $results->where('quiz_id',$quiz->id)->first();

    @endphp

    @if($quiz->status=='approved')

        @if(!$hasil)

            <a
                href="{{ route('questions.play',$quiz->id) }}"
                class="btn btn-primary btn-block">

                <i class="fas fa-play"></i>

                Kerjakan Quiz

            </a>

        @elseif($hasil->status=='Remedial')

            <a
                href="{{ route('questions.play',$quiz->id) }}"
                class="btn btn-warning btn-block">

                <i class="fas fa-redo"></i>

                Kerjakan Remedial

            </a>

        @else

            <button
                class="btn btn-success btn-block"
                disabled>

                <i class="fas fa-check-circle"></i>

                Sudah Lulus

            </button>

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

{{-- ================= RIWAYAT QUIZ ================= --}}

@if(strtolower(auth()->user()->role)=='siswa')

<div class="card shadow border-0 mt-4">

    <div class="card-header bg-white">

        <div class="d-flex justify-content-between align-items-center">

            <h4 class="mb-0">

                <i class="fas fa-history text-primary"></i>

                Riwayat Quiz

            </h4>

        </div>

    </div>

    <div class="card-body p-0">

        <table class="table table-hover mb-0">

            <thead class="thead-light">

                <tr>

                    <th>Judul Quiz</th>

                    <th>Nilai</th>

                    <th>Status</th>

                </tr>

            </thead>

            <tbody>

            @forelse($results as $result)

                <tr>

                    <td>

                        {{ $result->quiz->judul }}

                    </td>

                    <td>

                        <strong>

                            {{ $result->nilai }}

                        </strong>

                    </td>

                    <td>

                        @if($result->status=='Lulus')

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

                        Belum pernah mengerjakan quiz.

                    </td>

                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

</div>

@endif

{{-- ================= ADMIN / GURU ================= --}}

@if(in_array(strtolower(auth()->user()->role),['admin','guru']))

<div class="text-right mt-4">

    <a

        href="{{ route('quiz.results') }}"

        class="btn btn-success">

        <i class="fas fa-chart-bar"></i>

        Lihat Hasil Quiz

    </a>

</div>

@endif

</div>

@endsection