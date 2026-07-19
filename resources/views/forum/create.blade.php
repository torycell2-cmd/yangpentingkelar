@extends('adminlte::page')

@section('title', 'Buat Topik Diskusi')

@section('content')

<div class="container-fluid py-4">

    <div class="mb-3">
        <a href="{{ route('forum.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i>
            Kembali ke Forum
        </a>
    </div>

    <div class="card shadow">

        <div class="card-header bg-primary">

            <h4 class="mb-0 text-white">

                <i class="fas fa-comments"></i>

                Buat Topik Diskusi

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

                <div class="form-group">

                    <label>
                        Judul Topik
                    </label>

                    <input
                        type="text"
                        name="title"
                        class="form-control"
                        placeholder="Masukkan judul topik diskusi"
                        value="{{ old('title') }}"
                        required>

                </div>

                <div class="form-group">

                    <label>
                        Isi Diskusi
                    </label>

                    <textarea
                        name="content"
                        rows="8"
                        class="form-control"
                        placeholder="Tuliskan isi diskusi di sini..."
                        required>{{ old('content') }}</textarea>

                </div>

                <div class="text-right">

                    <a href="{{ route('forum.index') }}"
                       class="btn btn-secondary">

                        <i class="fas fa-times"></i>

                        Batal

                    </a>

                    <button
                        type="submit"
                        class="btn btn-success">

                        <i class="fas fa-paper-plane"></i>

                        Simpan Topik

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection