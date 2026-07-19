@extends('adminlte::page')

@section('title', 'Detail Forum')

@section('content')

<div class="container-fluid py-4">

    <div class="mb-3">
        <a href="{{ route('forum.index') }}" class="btn btn-outline-secondary">
            <i class="fa fa-arrow-left me-1" aria-hidden="true"></i>
            Kembali ke Forum
        <a href="{{ route('forum.index') }}" class="btn btn-secondary rounded-pill px-4">
        <a href="{{ route('forum.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali ke Forum
        </a>
    </div>

    {{-- Detail Forum --}}
    <div class="card shadow border-0 mb-4">
    <div class="card border-0 shadow-lg rounded-4">

        <div class="card-header bg-primary text-white border-0">

            <h3 class="mb-0 font-weight-bold">

                <i class="fas fa-comments mr-2"></i>
    <div class="card shadow">

        <div class="card-header bg-primary text-white">

            <h3 class="mb-0">

                {{ $forum->title }}

            </h3>

        </div>

        <div class="card-body">

            <div class="mb-3 text-muted">

            <div class="d-flex align-items-center text-muted mb-3">
                <i class="fas fa-user-circle text-primary"></i>
                <i class="fas fa-user"></i>

                {{ $forum->author }}

                <span>
                    <i class="fa fa-commenting me-1" aria-hidden="true"></i>
                    {{ $forum->comments->count() }} Komentar
                </span>
                &nbsp;&nbsp;

                <i class="fas fa-calendar-alt text-success"></i>
                &nbsp;&nbsp;

                <i class="fas fa-calendar"></i>

                {{ $forum->created_at->format('d M Y H:i') }}

                &nbsp;&nbsp;

                <i class="fas fa-comment-dots text-warning"></i>
                <i class="fas fa-comments"></i>

                {{ $forum->comments->count() }} Komentar

            </div>

            <hr>

            <p class="fs-6" style="line-height: 1.8;">
            <p class="text-secondary" style="white-space: pre-line; font-size:16px; line-height:1.8;">
            <p style="white-space: pre-line">

                {{ $forum->content }}

            </p>

        </div>

    </div>

    {{-- Komentar --}}
    <div class="card shadow mt-4">

        <div class="card-header bg-success text-white">

            <h5 class="mb-0">
                <i class="fa fa-commenting me-2" aria-hidden="true"></i>
                Diskusi ({{ $forum->comments->count() }})
    <div class="card border-0 shadow-lg rounded-4 mt-4">

        <div class="card-header bg-success text-white border-0">

            <h5 class="mb-0">

                <i class="fas fa-comment-dots"></i>

                <i class="fas fa-comments"></i>

                Komentar

            </h5>

        </div>

        <div class="card-body">

            @forelse($forum->comments as $comment)

                <div class="card mb-3 border-0 shadow-sm">
                <div class="border rounded-4 p-3 mb-3 shadow-sm">
                <div class="border rounded p-3 mb-3">

                    <div class="d-flex justify-content-between">

                        <div>

                            <div>
                            <strong class="text-primary">
                            <strong>

                                {{ $comment->author }}

                            </strong>

                            <br>

                            <small class="text-muted">

                                {{ $comment->created_at->format('d M Y H:i') }}

                            </small>

                        </div>

                        @if(auth()->user()->role == 'admin' || auth()->id() == $comment->user_id)

                        <p class="mb-0">
                            {{ $comment->comment }}
                        </p>
                        <div>

                            <a href="{{ route('comment.edit',$comment->id) }}"
                               class="btn btn-warning btn-sm">

                                <i class="fas fa-pen"></i>
                                <i class="fas fa-edit"></i>

                                Edit

                            </a>

                            <form
                                action="{{ route('comment.destroy',$comment->id) }}"
                                method="POST"
                                class="d-inline">

                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('Yakin ingin menghapus komentar?')">

                                    <i class="fas fa-trash-alt"></i>
                                    <i class="fas fa-trash"></i>

                                    Hapus

                                </button>

                            </form>

                        </div>

                        @endif

                    </div>

                    <hr>

                    <p class="mb-0">

                        {{ $comment->comment }}

                    </p>

                </div>

            @empty

                <div class="text-center py-4">

                    <i class="fa fa-commenting fa-3x text-secondary mb-3" aria-hidden="true"></i>
                    <i class="fas fa-comment-slash fa-4x text-secondary mb-3"></i>
                    <i class="fas fa-comments fa-4x text-secondary mb-3"></i>

                    <h5>

                        Belum ada komentar

                    </h5>

                    <p class="text-muted">

                        Jadilah yang pertama memberikan komentar.

                    </p>

                </div>

            @endforelse

        </div>

    </div>

    {{-- Form Komentar --}}
    <div class="card shadow mt-4">

        <div class="card-header bg-info text-white">

            <h5 class="mb-0">
                <i class="fa fa-commenting me-2" aria-hidden="true"></i>
    <div class="card border-0 shadow-lg rounded-4 mt-4">

        <div class="card-header bg-info text-white border-0">

            <h5 class="mb-0">

                <i class="fas fa-paper-plane mr-1"></i>

                <i class="fas fa-paper-plane"></i>

                Tambah Komentar

            </h5>

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

            <form action="{{ route('forum.comment',$forum->id) }}" method="POST">

                @csrf

                <div class="form-group">

                    <label>Komentar</label>

                    <textarea
                        name="comment"
                        rows="5"
                        class="form-control"
                        placeholder="Tulis komentar..."
                        required></textarea>

                </div>

                <button
                    type="submit"
                    class="btn btn-primary">

                    <label class="form-label fw-semibold">
                        <i class="fa fa-commenting me-1" aria-hidden="true"></i>
                        Komentar
                    </label>
                    <textarea
                        name="comment"
                        rows="5"
                        class="form-control rounded-3"
                        placeholder="Tulis komentar..."
                        required></textarea>

                </div>

                <button
                    type="submit"
                    class="btn btn-primary rounded-pill px-4">

                    <i class="fas fa-paper-plane mr-1"></i>
                    <i class="fas fa-paper-plane"></i>

                    Kirim Komentar

                </button>

            </form>

        </div>

    </div>

</div>

@endsection