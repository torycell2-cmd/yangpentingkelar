@extends('layouts.layouts')

@section('content')
<div class="container-fluid py-4" style="background:#f4f8fc; min-height:100vh;">

    <!-- Welcome -->
    <div class="card border-0 shadow-sm mb-4" style="border-radius:15px;">
        <div class="card-body d-flex justify-content-between align-items-center">
            <div>
                <h3 class="fw-bold text-primary">
                    Selamat Datang, {{ Auth::user()->name ?? 'User' }} 👋
                </h3>
                <p class="text-muted mb-0">
                    Kelola Artikel, Forum, Quiz, dan AI Tutor dengan mudah.
                </p>
            </div>

            <div>
                <button class="btn btn-primary">
                    <i class="fas fa-plus"></i> Tambah Artikel
                </button>
            </div>
        </div>
    </div>

    <!-- Statistik -->
    <div class="row">

        <div class="col-md-3 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center">
                    <i class="fas fa-newspaper fa-3x text-primary mb-3"></i>
                    <h3 class="fw-bold">25</h3>
                    <p class="text-muted">Total Artikel</p>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center">
                    <i class="fas fa-comments fa-3x text-success mb-3"></i>
                    <h3 class="fw-bold">12</h3>
                    <p class="text-muted">Forum Aktif</p>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center">
                    <i class="fas fa-question-circle fa-3x text-warning mb-3"></i>
                    <h3 class="fw-bold">8</h3>
                    <p class="text-muted">Quiz</p>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center">
                    <i class="fas fa-robot fa-3x text-info mb-3"></i>
                    <h3 class="fw-bold text-success">Aktif</h3>
                    <p class="text-muted">AI Tutor</p>
                </div>
            </div>
        </div>

    </div>

    <!-- Aktivitas -->
    <div class="row">

        <div class="col-lg-8 mb-4">

            <div class="card border-0 shadow-sm">
                <div class="card-header bg-primary text-white">
                    Aktivitas Terbaru
                </div>

                <div class="card-body">

                    <ul class="list-group list-group-flush">

                        <li class="list-group-item">
                            ✅ Artikel Laravel berhasil ditambahkan
                        </li>

                        <li class="list-group-item">
                            💬 Forum mendapat komentar baru
                        </li>

                        <li class="list-group-item">
                            📝 Quiz PHP berhasil diperbarui
                        </li>

                        <li class="list-group-item">
                            🤖 AI Tutor menjawab 10 pertanyaan
                        </li>

                    </ul>

                </div>

            </div>

        </div>

        <div class="col-lg-4 mb-4">

            <div class="card border-0 shadow-sm">

                <div class="card-header bg-primary text-white">
                    Quick Menu
                </div>

                <div class="card-body d-grid gap-3">

                    <a href="#" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Tambah Artikel
                    </a>

                    <a href="#" class="btn btn-success">
                        <i class="fas fa-comments"></i> Forum
                    </a>

                    <a href="#" class="btn btn-warning text-white">
                        <i class="fas fa-question-circle"></i> Buat Quiz
                    </a>

                    <a href="#" class="btn btn-info text-white">
                        <i class="fas fa-robot"></i> AI Tutor
                    </a>

                </div>

            </div>

        </div>

    </div>

    <!-- Progress -->
    <div class="card border-0 shadow-sm">

        <div class="card-header bg-primary text-white">
            Statistik Sistem
        </div>

        <div class="card-body">

            <label>Artikel</label>
            <div class="progress mb-3">
                <div class="progress-bar bg-primary" style="width:80%">
                    80%
                </div>
            </div>

            <label>Forum</label>
            <div class="progress mb-3">
                <div class="progress-bar bg-success" style="width:65%">
                    65%
                </div>
            </div>

            <label>Quiz</label>
            <div class="progress mb-3">
                <div class="progress-bar bg-warning" style="width:55%">
                    55%
                </div>
            </div>

            <label>AI Tutor</label>
            <div class="progress">
                <div class="progress-bar bg-info" style="width:95%">
                    95%
                </div>
            </div>

        </div>

    </div>

</div>
@endsection