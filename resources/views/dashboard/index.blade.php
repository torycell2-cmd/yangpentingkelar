@extends('adminlte::page')

@section('content')
    <nav class="d-flex justify-content-between align-items-center mb-4 mt-2">
        
        <div style="flex: 1;"></div>

        <form action="{{ route('articles.search') }}" method="POST" class="form-inline" style="flex: 2;">
            @csrf
            <div class="input-group w-100">
                <input type="search" name="query" 
                       class="form-control rounded-pill border-right-0" 
                       placeholder="Cari artikel..." 
                       style="height: 40px; padding-left: 20px;">
                <div class="input-group-append">
                    <button class="btn btn-navbar rounded-pill px-4" type="submit" 
                            style="background: white; border: 1px solid #ced4da; border-left: none; border-radius: 0 50px 50px 0;">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </form>

        <div class="d-flex justify-content-end" style="flex: 1;">
            @guest
                <a href="{{ route('login') }}" class="btn btn-outline-primary rounded-pill mr-2">Login</a>
                <a href="{{ route('register') }}" class="btn btn-primary rounded-pill">Register</a>
            @endguest
        </div>
    </nav>

    <div class="container-fluid">

        <h1>Selamat Datang,</h1>

        <p>Semangat belajar hari ini.</p>



        <div class="row">

            <div class="col-lg-3 col-6"><x-adminlte-info-box title="Artikel" text="0" icon="fas fa-book text-primary"/></div>

            <div class="col-lg-3 col-6"><x-adminlte-info-box title="Pertanyaan" text="0" icon="fas fa-comments text-info"/></div>

            <div class="col-lg-3 col-6"><x-adminlte-info-box title="Quiz" text="0" icon="fas fa-tasks text-success"/></div>

            <div class="col-lg-3 col-6"><x-adminlte-info-box title="Nilai" text="85" icon="fas fa-star text-warning"/></div>

        </div>



        <div class="card p-3">

            <h5><i class="fas fa-edit"></i> Buat artikel baru</h5>

        </div>

    </div>

@stop