@extends('adminlte::page')

@section('title', 'Buat Topik Diskusi')

@section('content')

<div class="container-fluid py-4">

    {{-- Hero --}}
    <div class="card border-0 shadow-sm mb-4 bg-primary text-white">
        <div class="card-body py-4">

            <a href="{{ route('forum.index') }}" class="btn btn-light btn-sm mb-3">
                <i class="fas fa-arrow-left"></i>
                Kembali ke Forum
            </a>

            <h2 class="font-weight-bold mb-2">
                <i class="fas fa-pen-alt mr-2"></i>
                Buat Diskusi Baru
            </h2>

            <p class="mb-0">
                Bagikan pertanyaan, pengalaman, atau informasi yang ingin didiskusikan bersama anggota forum.
            </p>

        </div>
    </div>

    {{-- Form Card --}}
    <div class="card shadow-sm border-0">

        <div class="card-header bg-white border-bottom">
            <h4 class="mb-0 text-primary">
                <i class="fas fa-comments mr-2"></i>
                Form Diskusi
            </h4>
        </div>

        <div class="card-body">

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('forum.store') }}" method="POST">

                @csrf

                <div class="form-group mb-4">
                    <label class="font-weight-bold">
                        Judul Topik
                    </label>

                    <input
                        type="text"
                        name="title"
                        class="form-control"
                        placeholder="Contoh: Bagaimana cara belajar Laravel yang efektif?"
                        value="{{ old('title') }}"
                        required>
                </div>

                <div class="form-group mb-4">
                    <label class="font-weight-bold">
                        Isi Diskusi
                    </label>

                    <textarea
                        name="content"
                        rows="8"
                        class="form-control"
                        placeholder="Tuliskan isi diskusi, pertanyaan, atau pengalamanmu di sini..."
                        required>{{ old('content') }}</textarea>
                </div>

                <div class="text-right mt-4">

                    <a href="{{ route('forum.index') }}"
                       class="btn btn-outline-secondary mr-2">
                        <i class="fas fa-times"></i>
                        Batal
                    </a>

                    <button
                        type="submit"
                        class="btn btn-success">
                        <i class="fas fa-paper-plane"></i>
                        Publikasikan
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection