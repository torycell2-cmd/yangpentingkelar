@extends('adminlte::page')

@section('title', 'Tambah Artikel')

@section('content')

<div class="container-fluid pt-4">

    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">➕ Tambah Artikel</h3>
        </div>

        <form action="{{ route('articles.store') }}" method="POST">
            @csrf

            <div class="card-body">

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="form-group">
                    <label>Judul Artikel</label>
                    <input
                        type="text"
                        name="title"
                        class="form-control"
                        value="{{ old('title') }}"
                        placeholder="Masukkan judul artikel"
                        required>
                </div>

                <div class="form-group">
                    <label>Author</label>
                    <input
                        type="text"
                        name="author"
                        class="form-control"
                        value="{{ auth()->user()->name }}"
                        readonly>
                </div>

                <div class="form-group">
                    <label>Kategori</label>
                    <input
                        type="text"
                        name="category"
                        class="form-control"
                        value="{{ old('category') }}"
                        placeholder="Contoh : Pemrograman Web"
                        required>
                </div>

                <div class="form-group">
                    <label>Konten Artikel</label>
                    <textarea
                        name="content"
                        rows="8"
                        class="form-control"
                        placeholder="Tulis isi artikel di sini..."
                        required>{{ old('content') }}</textarea>
                </div>

            </div>

            <div class="card-footer">

                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save"></i> Simpan Artikel
                </button>

                <a href="{{ route('articles.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>

            </div>

        </form>

    </div>

</div>

@endsection