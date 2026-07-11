@extends('adminlte::page')

@section('content')

<div class="container-fluid">

    {{-- Header --}}
    <div class="mb-4">

        <h1 class="font-weight-bold">
            Forum Diskusi
        </h1>

        <p class="text-muted">
            Tempat berdiskusi, bertanya, dan berbagi pengetahuan.
        </p>

    </div>

    {{-- Statistik --}}
    <div class="row mb-4">

        <div class="col-md-6">

            <div class="small-box bg-info">

                <div class="inner">

                    <h3>{{ $totalForum }}</h3>

                    <p>Total Topik</p>

                </div>

                <div class="icon">
                    <i class="fas fa-comments"></i>
                </div>

            </div>

        </div>

        <div class="col-md-6">

            <div class="small-box bg-success">

                <div class="inner">

                    <h3>{{ $totalComment }}</h3>

                    <p>Total Komentar</p>

                </div>

                <div class="icon">
                    <i class="fas fa-comment-dots"></i>
                </div>

            </div>

        </div>

    </div>

    {{-- Tombol Buat Topik --}}
    <div class="card mb-4 shadow-sm">

        <div class="card-body d-flex justify-content-between align-items-center">

            <div>

                <h4 class="font-weight-bold mb-1">
                    Buat Topik Baru
                </h4>

                <p class="text-muted mb-0">
                    Bagikan ilmu dan pengalamanmu kepada komunitas.
                </p>

            </div>

            <a href="{{ route('forum.create') }}"
               class="btn btn-dark btn-lg px-5 rounded-pill">

                <i class="fas fa-plus mr-2"></i>

                Buat Sekarang

            </a>

        </div>

    </div>

    {{-- Daftar Forum --}}
    <div class="card shadow-sm">

        <div class="card-header">

            <h4 class="mb-0 font-weight-bold">
                Daftar Topik Diskusi
            </h4>

        </div>

        <div class="card-body p-0">

            @forelse($forums as $forum)

                <div class="border-bottom p-4">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <h5 class="font-weight-bold mb-2">
                                {{ $forum->title }}
                            </h5>

                            <p class="text-muted mb-3">
                                Dibuat oleh {{ $forum->author }}
                            </p>

                            <a href="{{ route('forum.show', $forum->id) }}"
                               class="btn btn-primary btn-sm">

                                Detail

                            </a>

                            <a href="{{ route('forum.edit', $forum->id) }}"
                               class="btn btn-warning btn-sm">

                                Edit

                            </a>

                            <form action="{{ route('forum.destroy', $forum->id) }}"
                                  method="POST"
                                  class="d-inline">

                                @csrf
                                @method('DELETE')

                                <button class="btn btn-danger btn-sm"
                                        onclick="return confirm('Hapus topik ini?')">

                                    Hapus

                                </button>

                            </form>

                        </div>

                        <div>

                            <span class="badge badge-secondary p-2">
                                ID #{{ $forum->id }}
                            </span>

                        </div>

                    </div>

                </div>

            @empty

                <div class="text-center py-5">

                    <img src="https://cdn-icons-png.flaticon.com/512/4076/4076478.png"
                        width="120"
                        class="mb-3">

                    <h5 class="fw-bold">
                        Belum Ada Diskusi
                    </h5>

                    <p class="text-muted">
                        Jadilah orang pertama yang membuat topik diskusi.
                    </p>

                    <a href="{{ route('forum.create') }}"
                    class="btn btn-primary">
                    + Buat Topik
                    </a>

                </div>

            @endforelse

        </div>

    </div>

</div>

@endsection