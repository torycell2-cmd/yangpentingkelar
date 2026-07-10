@extends('layouts.layouts')

@section('content')
<div class="container-fluid pt-4">
    <h1 class="mb-4">➕ Tambah Artikel</h1>

    <div class="card shadow-sm">
        <div class="card-body">

            <form action="{{ route('articles.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Judul Artikel</label>
                    <input type="text" name="title" class="form-control" placeholder="Masukkan judul materi" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Author</label>
                    <input type="text" name="author" class="form-control" value="{{ auth()->user()->name }}" required readonly>
                </div>

                <div class="mb-3">
                    <label class="form-label">Kategori</label>
                    <input type="text" name="category" class="form-control" placeholder="Contoh: Pemrograman, Jaringan" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Konten Artikel</label>
                    <textarea name="content" rows="6" class="form-control" placeholder="Tuliskan isi materi edukasi di sini..." required></textarea>
                </div>

                <button type="submit" class="btn btn-success">
                    💾 Simpan Artikel
                </button>

                <a href="{{ route('articles.index') }}" class="btn btn-secondary">
                    Kembali
                </a>

            </form>

        </div>
    </div>
</div>
@endsection