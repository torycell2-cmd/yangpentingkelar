@extends('layouts.layouts')

@section('content')

<div class="container">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">💬 Forum Diskusi</h2>
            <p class="text-muted mb-0">
                Tempat berdiskusi, bertanya, dan berbagi pengetahuan.
            </p>
        </div>

        <a href="{{ route('forum.create') }}" class="btn btn-primary px-4">
            <i class="bi bi-plus-circle"></i> Buat Topik
        </a>
    </div>

    {{-- Statistik --}}
    <div class="row g-3 mb-4">

        <div class="col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <small class="text-muted">Total Topik</small>
                        <h2 class="fw-bold text-primary mb-0">
                            {{ $totalForum }}
                        </h2>
                    </div>

                    <div class="fs-1">
                        💬
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <small class="text-muted">Total Komentar</small>
                        <h2 class="fw-bold text-success mb-0">
                            {{ $totalComment }}
                        </h2>
                    </div>

                    <div class="fs-1">
                        📝
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- Daftar Forum --}}
    <div class="card border-0 shadow-sm">

        <div class="card-header bg-white py-3">
            <h5 class="mb-0 fw-semibold">
                Daftar Topik Diskusi
            </h5>
        </div>

        <div class="card-body p-0">

            @forelse($forums as $forum)

            <div class="border-bottom p-4">

                <div class="d-flex justify-content-between">

                    <div>

                        <h5 class="fw-bold mb-1">
                            {{ $forum->title }}
                        </h5>

                        <small class="text-muted">
                            👤 {{ $forum->author }}
                        </small>

                        <div class="mt-3">

                            <a href="{{ route('forum.show',$forum->id) }}"
                               class="btn btn-outline-primary btn-sm">
                                Detail
                            </a>

                            <a href="{{ route('forum.edit',$forum->id) }}"
                               class="btn btn-outline-warning btn-sm">
                                Edit
                            </a>

                            <form action="{{ route('forum.destroy',$forum->id) }}"
                                  method="POST"
                                  class="d-inline">

                                @csrf
                                @method('DELETE')

                                <button class="btn btn-outline-danger btn-sm"
                                    onclick="return confirm('Hapus topik ini?')">
                                    Hapus
                                </button>

                            </form>

                        </div>

                    </div>

                    <div class="text-end text-muted">

                        <div class="badge bg-light text-dark mb-2">
                            ID #{{ $forum->id }}
                        </div>

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