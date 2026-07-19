@extends('adminlte::page')

@section('title', 'Edit Komentar')

@section('content')

<div class="container-fluid py-4">

    <div class="card shadow">

        <div class="card-header bg-warning text-white">

            <h4 class="mb-0">

                <i class="fas fa-edit"></i>

                Edit Komentar

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

            <form action="{{ route('comment.update',$comment->id) }}" method="POST">

                @csrf
                @method('PUT')

                <div class="form-group">

                    <label>Author</label>

                    <input
                        type="text"
                        class="form-control"
                        value="{{ $comment->author }}"
                        readonly>

                </div>

                <div class="form-group">

                    <label>Komentar</label>

                    <textarea
                        name="comment"
                        rows="6"
                        class="form-control"
                        required>{{ old('comment', $comment->comment) }}</textarea>

                </div>

                <div class="text-right">

                    <a href="{{ route('forum.show',$comment->forum_id) }}"
                       class="btn btn-secondary">

                        <i class="fas fa-arrow-left"></i>

                        Kembali

                    </a>

                    <button
                        type="submit"
                        class="btn btn-warning">

                        <i class="fas fa-save"></i>

                        Simpan Perubahan

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection