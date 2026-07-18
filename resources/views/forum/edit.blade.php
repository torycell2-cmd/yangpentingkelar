@extends('adminlte::page')

@section('title','Edit Diskusi')

@section('content')

<div class="container-fluid py-4">

    <div class="card shadow">

        <div class="card-header bg-warning text-white">

            <h4 class="mb-0">

                <i class="fas fa-edit"></i>

                Edit Diskusi

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

            <form action="{{ route('forum.update',$forum->id) }}" method="POST">

                @csrf
                @method('PUT')

                <div class="form-group">

                    <label>Judul Diskusi</label>

                    <input
                        type="text"
                        name="title"
                        class="form-control"
                        value="{{ old('title',$forum->title) }}"
                        required>

                </div>

                <div class="form-group">

                    <label>Isi Diskusi</label>

                    <textarea
                        name="content"
                        rows="8"
                        class="form-control"
                        required>{{ old('content',$forum->content) }}</textarea>

                </div>

                <div class="text-right">

                    <a href="{{ route('forum.index') }}"
                       class="btn btn-secondary">

                        <i class="fas fa-arrow-left"></i>

                        Kembali

                    </a>

                    <button
                        type="submit"
                        class="btn btn-warning">

                        <i class="fas fa-save"></i>

                        Simpan

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection