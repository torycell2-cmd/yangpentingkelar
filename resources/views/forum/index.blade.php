@extends('adminlte::page')

@section('title', 'Forum Diskusi')

@section('content')

<style>

body{
    background:#f4f7fb;
}

.hero{
    background:linear-gradient(135deg,#2563eb,#60a5fa);
    color:white;
    border-radius:20px;
    padding:40px;
    margin-bottom:25px;
}

.hero h2{
    font-weight:bold;
}

.stat-card{
    border:none;
    border-radius:20px;
    box-shadow:0 8px 20px rgba(0,0,0,.08);
    transition:.3s;
}

.stat-card:hover{
    transform:translateY(-5px);
}

.search-box{
    background:white;
    border-radius:20px;
    padding:20px;
    box-shadow:0 8px 20px rgba(0,0,0,.08);
    margin-bottom:25px;
}

.search-box input{
    border-radius:30px;
}

.forum-card{
    border:none;
    border-left:5px solid #2563eb;
    border-radius:20px;
    overflow:hidden;
    transition:.3s;
    box-shadow:0 8px 20px rgba(0,0,0,.08);
}

.forum-card:hover{
    transform:translateY(-5px);
    box-shadow:0 16px 30px rgba(0,0,0,.12);
}

.avatar{
    width:60px;
    height:60px;
    border-radius:50%;
    background:linear-gradient(135deg,#2563eb,#60a5fa);
    color:white;
    box-shadow:0 8px 18px rgba(37,99,235,.25);
    display:flex;
    justify-content:center;
    align-items:center;
    font-size:24px;
    font-weight:bold;
}

.badge-category{
    background:linear-gradient(135deg,#2563eb,#60a5fa);
    color:white;
    box-shadow:0 8px 18px rgba(37,99,235,.25);
    border-radius:30px;
    padding:7px 18px;
}

</style>

<div class="container-fluid py-4">

<div class="hero">

<div class="d-flex justify-content-between align-items-center">

<div>

<h2><i class="fas fa-comments mr-2"></i>Forum Diskusi</h2>

<p class="mb-0">
Diskusikan materi bersama guru dan temanmu.
</p>

</div>

<div>

@if(auth()->user()->role == 'admin' || auth()->user()->role == 'guru')

<a href="{{ route('forum.create') }}"
class="btn btn-light rounded-pill px-4">

<i class="fas fa-plus-circle"></i>

Buat Diskusi

</a>

@endif

</div>

</div>

</div>

<div class="row mb-4">

<div class="col-md-6">

<div class="card stat-card">

<div class="card-body text-center">

<h2 class="text-primary">

{{ $forums->count() }}

</h2>

<h5>Total Diskusi</h5>

</div>

</div>

</div>

<div class="col-md-6">

<div class="card stat-card">

<div class="card-body text-center">

<h2 class="text-success">

{{ $forums->sum(function($forum){ return $forum->comments->count(); }) }}

</h2>

<h5>Total Komentar</h5>

</div>

</div>

</div>

</div>

<div class="search-box">

<form action="{{ route('forum.index') }}" method="GET">

<div class="input-group">

<input
type="text"
name="search"
value="{{ request('search') }}"
class="form-control"
placeholder="Cari judul diskusi...">

<div class="input-group-append">

<button class="btn btn-primary rounded-pill px-4">

<i class="fas fa-search"></i>

Cari

</button>

</div>

</div>

</form>

</div>

@foreach($forums as $forum)

<div class="card forum-card mb-4">

    <div class="card-body">

        <div class="d-flex">

            <div class="avatar">

                {{ strtoupper(substr($forum->author ?? 'U',0,1)) }}

            </div>

            <div class="ml-3 flex-grow-1">

                <div class="d-flex justify-content-between">

                    <div>

                        <h4 class="font-weight-bold">

                            {{ $forum->title }}

                        </h4>

                        <small class="text-muted">

                            <i class="fas fa-user"></i>

                            {{ $forum->author }}

                            &nbsp;&nbsp;

                            <i class="fas fa-clock"></i>

                            {{ $forum->created_at->diffForHumans() }}

                        </small>

                    </div>

                    <span class="badge badge-primary rounded-pill px-3 py-2">

                        Forum

                    </span>

                </div>

                <hr>

                <p class="text-muted">

                    {{ Str::limit($forum->content, 250) }}

                </p>

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <span class="text-secondary">

                            <i class="fas fa-comments"></i>

                            {{ $forum->comments->count() }} Komentar

                        </span>

                    </div>

                    <div>

                        <a href="{{ route('forum.show',$forum->id) }}"
                           class="btn btn-primary rounded-pill">

                            <i class="fas fa-eye"></i>

                            Lihat Diskusi

                        </a>

                        @if(auth()->user()->role == 'admin' || auth()->id() == $forum->user_id)

                            <a href="{{ route('forum.edit',$forum->id) }}"
                               class="btn btn-warning rounded-pill">

                                <i class="fas fa-pen"></i>

                                Edit

                            </a>

                            <form
                                action="{{ route('forum.destroy',$forum->id) }}"
                                method="POST"
                                class="d-inline">

                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="btn btn-danger rounded-pill"
                                    onclick="return confirm('Yakin ingin menghapus diskusi ini?')">

                                    <i class="fas fa-trash-alt"></i>

                                    Hapus

                                </button>

                            </form>

                        @endif

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endforeach

@if($forums->isEmpty())

<div class="card border-0 shadow-sm">

    <div class="card-body text-center py-5">

        <i class="fas fa-comment-slash fa-5x text-secondary mb-4"></i>

        <h3 class="font-weight-bold text-secondary">

            Belum Ada Diskusi

        </h3>

        <p class="text-muted mb-4">

            Belum ada topik diskusi yang dibuat.

        </p>

        @if(auth()->user()->role == 'admin' || auth()->user()->role == 'guru')

            <a href="{{ route('forum.create') }}"
               class="btn btn-primary rounded-pill px-4">

                <i class="fas fa-plus-circle"></i>

                Buat Diskusi Pertama

            </a>

        @endif

    </div>

</div>

@endif

</div>

@endsection