@extends('adminlte::page')

@section('title', 'Edit Komentar')

@section('content')

<style>
body{
    background:#f4f7fb;
}

.edit-card{
    border:none;
    border-radius:20px;
    overflow:hidden;
    box-shadow:0 10px 25px rgba(0,0,0,.08);
}

.edit-header{
    background:linear-gradient(135deg,#2563eb,#60a5fa);
    color:white;
    padding:25px 30px;
}

.edit-header h3{
    margin:0;
    font-weight:bold;
}

.edit-header small{
    opacity:.9;
}

.form-control{
    border-radius:12px;
}

.form-control:focus{
    border-color:#2563eb;
    box-shadow:0 0 0 .2rem rgba(37,99,235,.15);
}

textarea.form-control{
    resize:none;
}

.btn{
    border-radius:30px;
    padding:10px 22px;
    font-weight:600;
}

label{
    font-weight:600;
    color:#374151;
}
</style>

<div class="container-fluid py-4">

    <div class="row justify-content-center">

        <div class="col-lg-8">

            <div class="card edit-card">

                <div class="edit-header">

                    <h3>
                        <i class="fas fa-edit mr-2"></i>
                        Edit Komentar
                    </h3>

                    <small>Perbarui komentar yang telah dibuat.</small>

                </div>

                <div class="card-body p-4">

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

                            <label>
                                <i class="fas fa-user text-primary mr-1"></i>
                                Author
                            </label>

                           <input
                                type="text"
                                name="author"
                                class="form-control"
                                value="{{ $comment->author }}"
                                readonly>

                        </div>

                        <div class="form-group mt-4">

                            <label>
                                <i class="fas fa-comment-dots text-primary mr-1"></i>
                                Komentar
                            </label>

                            <textarea
                                name="comment"
                                rows="6"
                                class="form-control"
                                placeholder="Masukkan komentar..."
                                required>{{ old('comment',$comment->comment) }}</textarea>

                        </div>

                        <hr class="my-4">

                        <div class="text-right">

                            <a href="{{ route('forum.show',$comment->forum_id) }}"
                               class="btn btn-outline-secondary mr-2">

                                <i class="fas fa-arrow-left"></i>
                                Kembali

                            </a>

                            <button
                                type="submit"
                                class="btn btn-primary">

                                <i class="fas fa-save"></i>
                                Simpan Perubahan

                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection