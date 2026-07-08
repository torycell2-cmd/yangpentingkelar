@extends('layouts.layouts')

@section('content')

<div class="container py-4">

    {{-- Tombol Kembali --}}
    <div class="mb-3">
        <a href="{{ route('forum.index') }}" class="btn btn-outline-secondary">
            <i class="fa fa-arrow-left me-1" aria-hidden="true"></i>
            Kembali ke Forum
        </a>
    </div>

    <div class="card shadow border-0">

        <div class="card-header bg-primary text-white">

            <h4 class="mb-0">
                <i class="fa fa-commenting me-2" aria-hidden="true"></i>
                Buat Topik Diskusi
            </h4>

        </div>

        <div class="card-body">

            <form action="{{ route('forum.store') }}" method="POST">

                @csrf

                <div class="mb-3">

                    <label class="form-label fw-semibold">
                        Judul Topik
                    </label>

                    <input
                        type="text"
                        name="title"
                        class="form-control"
                        placeholder="Masukkan judul topik diskusi">

                </div>

                <div class="mb-3">

                    <label class="form-label fw-semibold">
                        <i class="fa fa-user-o me-1" aria-hidden="true"></i>
                        Nama Author
                    </label>

                    <input
                        type="text"
                        name="author"
                        class="form-control"
                        placeholder="Masukkan nama">

                </div>

                <div class="mb-4">

                    <label class="form-label fw-semibold">
                        <i class="fa fa-commenting me-1" aria-hidden="true"></i>
                        Isi Diskusi
                    </label>

                    <textarea
                        name="content"
                        rows="6"
                        class="form-control"
                        placeholder="Tuliskan isi diskusi di sini..."></textarea>

                </div>

                <div class="d-flex justify-content-end">

                    <a href="{{ route('forum.index') }}"
                       class="btn btn-outline-secondary me-2">
                        Batal
                    </a>

                    <button class="btn btn-success">
                        <i class="fa fa-paper-plane me-1" aria-hidden="true"></i>
                        Simpan Topik
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection