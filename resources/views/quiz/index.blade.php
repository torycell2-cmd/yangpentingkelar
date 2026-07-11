@extends('adminlte::page')

@section('title', 'Quiz')

@section('content')

<style>
.hero{
    background: linear-gradient(135deg,#2563eb,#3b82f6,#60a5fa);
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
    height:130px;
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
    height:12px;
    border-radius:20px;
}

.table{
    border-radius:15px;
    overflow:hidden;
}
</style>

<div class="container-fluid py-4">

    {{-- Banner --}}
    <div class="hero">

        <div class="row align-items-center">

            <div class="col-md-8">

                <h2>👋 Selamat Datang!</h2>

                <p class="mb-0">
                    Yuk kerjakan quiz dan tingkatkan kemampuanmu setiap hari 🚀
                </p>

            </div>

            <div class="col-md-4 text-right">

                <button class="btn btn-light rounded-pill px-4">
                    <i class="fas fa-plus"></i>
                    Buat Quiz
                </button>

            </div>

        </div>

    </div>

    {{-- Statistik --}}
    <div class="row mb-4">

        <div class="col-md-4">

            <div class="card stat-card shadow">

                <div class="card-body text-center">

                    <i class="fas fa-book fa-2x text-primary mb-3"></i>

                    <h3>12</h3>

                    <p>Total Quiz</p>

                </div>

            </div>

        </div>

        <div class="col-md-4">

            <div class="card stat-card shadow">

                <div class="card-body text-center">

                    <i class="fas fa-trophy fa-2x text-warning mb-3"></i>

                    <h3>90</h3>

                    <p>Nilai Tertinggi</p>

                </div>

            </div>

        </div>

        <div class="col-md-4">

            <div class="card stat-card shadow">

                <div class="card-body text-center">

                    <i class="fas fa-check-circle fa-2x text-success mb-3"></i>

                    <h3>5</h3>

                    <p>Quiz Selesai</p>

                </div>

            </div>

        </div>

    </div>

    {{-- Search --}}
    <div class="card border-0 shadow mb-4">

        <div class="card-body">

            <form class="search-box">

                <div class="input-group">

                    <input
                        type="text"
                        class="form-control"
                        placeholder="Cari quiz...">

                    <div class="input-group-append">

                        <button class="btn btn-primary rounded-pill px-4">

                            Cari

                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>

    {{-- Quiz --}}
    <div class="row">

        @php
            $quizzes=[
            ['title'=>'Laravel Dasar','cat'=>'Pemrograman Web','soal'=>10],
            ['title'=>'MySQL Dasar','cat'=>'Basis Data','soal'=>15],
            ['title'=>'Struktur Data','cat'=>'Algoritma','soal'=>20],
            ];
        @endphp

        @foreach($quizzes as $quiz)

        <div class="col-lg-4 mb-4">

            <div class="card quiz-card shadow">

                <div class="quiz-header">

                    <i class="fas fa-laptop-code"></i>

                </div>

                <div class="card-body">

                    <span class="badge badge-primary mb-2">

                        {{ $quiz['cat'] }}

                    </span>

                    <h4 class="font-weight-bold">

                        {{ $quiz['title'] }}

                    </h4>

                    <p class="text-muted">

                        {{ $quiz['soal'] }} Soal • 20 Menit

                    </p>

                    <div class="progress mb-3">

                        <div
                            class="progress-bar bg-success"
                            style="width:65%">
                        </div>

                    </div>

                    <button class="btn btn-primary btn-block rounded-pill">

                        <i class="fas fa-play-circle"></i>

                        Kerjakan Quiz

                    </button>

                </div>

            </div>

        </div>

        @endforeach

    </div>

    {{-- Riwayat --}}
    <div class="card shadow border-0">

        <div class="card-header bg-white">

            <h4 class="font-weight-bold">

                📈 Riwayat Quiz

            </h4>

        </div>

        <div class="card-body p-0">

            <table class="table table-hover">

                <thead>

                <tr>

                    <th>Quiz</th>

                    <th>Nilai</th>

                    <th>Status</th>

                </tr>

                </thead>

                <tbody>

                <tr>

                    <td>Laravel Dasar</td>

                    <td>95</td>

                    <td>

                        <span class="badge badge-success">

                            Lulus

                        </span>

                    </td>

                </tr>

                <tr>

                    <td>MySQL Dasar</td>

                    <td>80</td>

                    <td>

                        <span class="badge badge-warning">

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