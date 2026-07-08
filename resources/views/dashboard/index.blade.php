@extends('adminlte::page')

@section('content')
<div class="container-fluid pt-4">
    <!-- Navbar Modern -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white mb-4 shadow-sm rounded-lg py-2">
        <div class="mr-auto"></div> 

        <!-- Search Bar -->
        <form action="{{ route('articles.search') }}" method="POST" class="form-inline mx-3" style="width: 400px;">
            @csrf
            <div class="input-group w-100">
                <input type="search" name="query" 
                       class="form-control border-0 bg-light rounded-pill px-4" 
                       placeholder="Cari artikel...">
            </div>
        </form>

        <!-- Auth Buttons -->
        <div class="d-flex align-items-center">
            @guest
                <a href="{{ route('login') }}" class="btn btn-outline-primary rounded-pill px-4 mr-2">Login</a>
                <button type="button" class="btn btn-primary rounded-pill px-4" data-toggle="modal" data-target="#registerModal">
                    Register
                </button>
            @endguest
        </div>
    </nav>

    <!-- Header Section -->
    <div class="mb-4">
        <h2 class="font-weight-bold text-dark">Selamat Datang</h2>
        <p class="text-muted">Semangat belajar dan berkarya hari ini.</p>
    </div>

    <!-- Stats Row (DITAMBAHKAN FITUR QUIZ DI SINI) -->
    <div class="row">
        <!-- Card Artikel -->
        <div class="col-lg-3 col-6">
            <div class="info-box shadow-sm border-0 rounded-lg">
                <span class="info-box-icon bg-primary rounded-left"><i class="fas fa-book"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text text-uppercase text-muted font-weight-bold" style="font-size: 0.75rem;">Artikel</span>
                    <span class="info-box-number font-weight-bold h4 mb-0">0</span>
                </div>
            </div>
        </div>

        <!-- Card Pertanyaan -->
        <div class="col-lg-3 col-6">
            <div class="info-box shadow-sm border-0 rounded-lg">
                <span class="info-box-icon bg-info rounded-left"><i class="fas fa-comments"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text text-uppercase text-muted font-weight-bold" style="font-size: 0.75rem;">Pertanyaan</span>
                    <span class="info-box-number font-weight-bold h4 mb-0">0</span>
                </div>
            </div>
        </div>

        <!-- Card Quiz (BARU) -->
        <div class="col-lg-3 col-6">
            <div class="info-box shadow-sm border-0 rounded-lg">
                <span class="info-box-icon bg-success rounded-left"><i class="fas fa-tasks"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text text-uppercase text-muted font-weight-bold" style="font-size: 0.75rem;">Quiz</span>
                    <span class="info-box-number font-weight-bold h4 mb-0">0</span>
                </div>
            </div>
        </div>

        <!-- Card Nilai -->
        <div class="col-lg-3 col-6">
            <div class="info-box shadow-sm border-0 rounded-lg bg-primary text-white">
                <span class="info-box-icon bg-white rounded-left text-primary"><i class="fas fa-star"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text text-uppercase text-white-50 font-weight-bold" style="font-size: 0.75rem;">Nilai</span>
                    <span class="info-box-number font-weight-bold h4 mb-0">85</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Action Card -->
    <div class="card border-0 shadow-sm rounded-lg mt-3">
        <div class="card-body d-flex justify-content-between align-items-center py-4">
            <div class="media">
                <div class="align-self-center mr-3 bg-light p-3 rounded">
                    <i class="fas fa-edit fa-lg text-secondary"></i>
                </div>
                <div class="media-body">
                    <h5 class="font-weight-bold mb-1">Buat Artikel Baru</h5>
                    <p class="text-muted mb-0">Bagikan ilmu kamu ke komunitas sekarang.</p>
                </div>
            </div>
            <a href="#" class="btn btn-dark btn-lg rounded-pill px-4">
                <i class="fas fa-plus mr-2"></i> Buat Sekarang
            </a>
        </div>
    </div>
</div>

<!-- Modal Pop-up tetap sama -->
<div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="border-radius: 15px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title font-weight-bold mx-auto pt-3">Pilih Kategori Akun</h5>
            </div>
            <div class="modal-body text-center py-4">
                <p class="text-muted mb-4">Silakan pilih peran Anda untuk memulai proses pendaftaran.</p>
                <div class="d-flex justify-content-center gap-3">
                    <a href="{{ route('register') }}?role=guru" class="btn btn-lg px-4 py-3 mr-2 shadow-sm" style="background: #4e73df; color: white; border-radius: 12px;">
                        <i class="fas fa-chalkboard-teacher mr-2"></i> Saya Guru
                    </a>
                    <a href="{{ route('register') }}?role=siswa" class="btn btn-lg px-4 py-3 shadow-sm" style="background: #1cc88a; color: white; border-radius: 12px;">
                        <i class="fas fa-user-graduate mr-2"></i> Saya Siswa
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@stop