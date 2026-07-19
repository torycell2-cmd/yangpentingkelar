@extends('layouts.layouts')

@section('content')

<div class="container py-4">

    {{-- Tombol Kembali --}}
    <div class="mb-3">
        <a href="{{ route('forum.index') }}" class="btn btn-outline-secondary">
            <i class="fa fa-arrow-left me-1" aria-hidden="true"></i>
            Kembali ke Forum
        <a href="{{ route('forum.index') }}" class="btn btn-secondary rounded-pill px-4">
            <i class="fas fa-arrow-left"></i> Kembali ke Forum
        </a>
    </div>

    {{-- Detail Forum --}}
    <div class="card shadow border-0 mb-4">
    <div class="card border-0 shadow-lg rounded-4">

        <div class="card-header bg-primary text-white border-0">

            <h3 class="mb-0 font-weight-bold">

                <i class="fas fa-comments mr-2"></i>

                {{ $forum->title }}

            </h3>

        </div>

        <div class="card-body">

            <h2 class="fw-bold mb-3">
                {{ $forum->title }}
            </h2>

            <div class="d-flex align-items-center text-muted mb-3">
                <i class="fas fa-user-circle text-primary"></i>

                <span class="me-4">
                    <i class="fa fa-user-o me-1" aria-hidden="true"></i>
                    {{ $forum->author }}
                </span>

                <span>
                    <i class="fa fa-commenting me-1" aria-hidden="true"></i>
                    {{ $forum->comments->count() }} Komentar
                </span>
                &nbsp;&nbsp;

                <i class="fas fa-calendar-alt text-success"></i>

                {{ $forum->created_at->format('d M Y H:i') }}

                &nbsp;&nbsp;

                <i class="fas fa-comment-dots text-warning"></i>

                {{ $forum->comments->count() }} Komentar

            </div>

            <hr>

            <p class="fs-6" style="line-height: 1.8;">
            <p class="text-secondary" style="white-space: pre-line; font-size:16px; line-height:1.8;">

                {{ $forum->content }}
            </p>

        </div>

    </div>

    {{-- Komentar --}}
    <div class="card shadow border-0 mb-4">

        <div class="card-header bg-primary text-white">

            <h5 class="mb-0">
                <i class="fa fa-commenting me-2" aria-hidden="true"></i>
                Diskusi ({{ $forum->comments->count() }})
    <div class="card border-0 shadow-lg rounded-4 mt-4">

        <div class="card-header bg-success text-white border-0">

            <h5 class="mb-0">

                <i class="fas fa-comment-dots"></i>

                Komentar

            </h5>

        </div>

        <div class="card-body">

            @forelse($forum->comments as $comment)

                <div class="card mb-3 border-0 shadow-sm">
                <div class="border rounded-4 p-3 mb-3 shadow-sm">

                    <div class="card-body">

                        <div class="d-flex justify-content-between">

                            <div>
                            <strong class="text-primary">

                                <h6 class="mb-1 fw-bold">
                                    <i class="fa fa-user-o me-1" aria-hidden="true"></i>
                                    {{ $comment->author }}
                                </h6>

                                <small class="text-muted">
                                    {{ $comment->created_at->format('d M Y H:i') }}
                                </small>

                            </div>

                            <div>

                                <a href="{{ route('comment.edit',$comment->id) }}"
                                   class="btn btn-warning btn-sm">
                                    Edit
                                </a>

                                <form action="{{ route('comment.destroy',$comment->id) }}"
                                      method="POST"
                                      class="d-inline">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('Yakin hapus komentar?')">
                                        Hapus
                                    </button>

                                </form>

                            </div>

                        </div>

                        <hr>

                        <p class="mb-0">
                            {{ $comment->comment }}
                        </p>
                        <div>

                            <a href="{{ route('comment.edit',$comment->id) }}"
                               class="btn btn-warning btn-sm">

                                <i class="fas fa-pen"></i>

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

                                    Hapus

                                </button>

                            </form>

                        </div>

                        @endif

                    </div>

                </div>

            @empty

                <div class="text-center py-4">

                    <i class="fa fa-commenting fa-3x text-secondary mb-3" aria-hidden="true"></i>
                    <i class="fas fa-comment-slash fa-4x text-secondary mb-3"></i>

                    <h5>

                    <h5 class="text-muted">
                        Belum ada komentar
                    </h5>

                    <small class="text-secondary">
                        Jadilah yang pertama memberikan komentar.
                    </small>

                </div>

            @endforelse

        </div>

    </div>

    {{-- Form Komentar --}}
    <div class="card shadow border-0">

        <div class="card-header bg-success text-white">

            <h5 class="mb-0">
                <i class="fa fa-commenting me-2" aria-hidden="true"></i>
    <div class="card border-0 shadow-lg rounded-4 mt-4">

        <div class="card-header bg-info text-white border-0">

            <h5 class="mb-0">

                <i class="fas fa-paper-plane mr-1"></i>

                Tambah Komentar
            </h5>

        </div>

        <div class="card-body">

            <form action="{{ route('forum.comment',$forum->id) }}"
                  method="POST">

                @csrf

                <div class="mb-3">

                    <label class="form-label fw-semibold">
                        <i class="fa fa-user-o me-1" aria-hidden="true"></i>
                        Nama
                    </label>

                    <input type="text"
                           name="author"
                           class="form-control"
                           placeholder="Masukkan nama">

                </div>

                <div class="mb-3">

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

                    <textarea name="comment"
                              class="form-control"
                              rows="5"
                              placeholder="Tulis komentar..."></textarea>

                </div>

                <button class="btn btn-primary px-4">
                    <i class="fa fa-paper-plane me-1" aria-hidden="true"></i>
                    Kirim Komentar
                </button>

            </form>

        </div>

    </div>

</div>

@endsection