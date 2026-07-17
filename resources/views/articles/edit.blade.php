@extends('adminlte::page')

@section('title', 'Edit Artikel')

@section('content')

<div class="container-fluid pt-4">

    <div class="card card-warning">

        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-edit"></i>
                Edit Artikel
            </h3>
        </div>

        <form action="{{ route('articles.update', $article->id) }}" method="POST">

            @csrf
            @method('PUT')

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
                    <label>Judul</label>
                    <input
                        type="text"
                        name="title"
                        class="form-control"
                        value="{{ old('title', $article->title) }}"
                        required>
                </div>

                <div class="form-group">
                    <label>Author</label>
                    <input
                        type="text"
                        name="author"
                        class="form-control"
                        value="{{ old('author', $article->author) }}"
                        readonly>
                </div>

                <div class="form-group">
                    <label>Kategori</label>
                    <input
                        type="text"
                        name="category"
                        class="form-control"
                        value="{{ old('category', $article->category) }}"
                        required>
                </div>

                <div class="form-group">
                    <label>Konten Artikel</label>

                    <textarea
                        name="content"
                        rows="8"
                        class="form-control"
                        required>{{ old('content', $article->content) }}</textarea>

                </div>

            </div>

            <div class="card-footer">

                <button class="btn btn-success">
                    <i class="fas fa-save"></i>
                    Update Artikel
                </button>

                <a href="{{ route('articles.index') }}"
                   class="btn btn-secondary">

                    <i class="fas fa-arrow-left"></i>
                    Kembali

                </a>

            </div>

        </form>

    </div>

</div>

@endsection