@extends('adminlte::page')

@section('title', 'Artikel')

@section('content')

<style>
.hero{
    background:linear-gradient(135deg,#2563eb,#60a5fa);
    padding:40px;
    border-radius:20px;
    color:white;
    margin-bottom:25px;
}

.article-card{
    border:none;
    border-radius:20px;
    overflow:hidden;
    transition:.3s;
}

.article-card:hover{
    transform:translateY(-8px);
    box-shadow:0 20px 40px rgba(0,0,0,.15);
}

.article-image{
    height:180px;
    background:linear-gradient(135deg,#3b82f6,#93c5fd);
    display:flex;
    justify-content:center;
    align-items:center;
    font-size:60px;
    color:white;
}

.search-box input{
    border-radius:30px;
}
</style>

<div class="container-fluid py-4">

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="hero">

        <div class="row align-items-center">

            <div class="col-md-8">

                <h2>📚 Artikel Pembelajaran</h2>

                <p>
                    Temukan berbagai artikel menarik untuk meningkatkan kemampuanmu.
                </p>

            </div>

            <div class="col-md-4 text-right">

                {{-- Tombol khusus Admin --}}
                @if(strtolower(auth()->user()->role) == 'admin')

                    <a href="{{ route('admin.articles.pending') }}"
                       class="btn btn-warning rounded-pill px-4 mr-2">

                        <i class="fas fa-clock"></i>

                        Artikel Pending

                    </a>

                @endif

                {{-- Tombol Admin & Guru --}}
                @if(in_array(strtolower(auth()->user()->role), ['admin','guru']))

                    <a href="{{ route('articles.create') }}"
                       class="btn btn-light rounded-pill px-4">

                        <i class="fas fa-plus"></i>

                        Tulis Artikel

                    </a>

                @endif

            </div>

        </div>

    </div>

    <div class="card border-0 shadow mb-4">

        <div class="card-body">

            <form method="GET"
                  action="{{ route('articles.index') }}">

                <div class="input-group">

                    <input
                        type="text"
                        name="query"
                        value="{{ request('query') }}"
                        class="form-control"
                        placeholder="Cari artikel...">

                    <div class="input-group-append">

                        <button class="btn btn-primary rounded-pill px-4">

                            Cari

                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>

    <div class="row">

        @forelse($articles as $article)

            <div class="col-lg-4 mb-4">

                <div class="card article-card shadow h-100">

                    <div class="article-image">

                        <i class="fas fa-book-open"></i>

                    </div>

                    <div class="card-body">

                        <span class="badge badge-primary mb-2">

                            {{ $article->category }}

                        </span>

                        <h4>

                            {{ $article->title }}

                        </h4>

                        <p class="text-muted">

                            <i class="fas fa-user"></i>

                            {{ $article->author }}

                            <br>

                            <i class="fas fa-calendar"></i>

                            {{ $article->created_at->format('d M Y') }}

                            <br>

                            <i class="fas fa-eye"></i>

                            {{ $article->views }} kali dibaca

                        </p>

                        <p>

                            {{ Str::limit(strip_tags($article->content),100) }}

                        </p>

                        <a href="{{ route('articles.show',$article->id) }}"
                           class="btn btn-primary btn-block rounded-pill">

                            <i class="fas fa-book-reader"></i>

                            Baca Selengkapnya

                        </a>

                        @if(in_array(strtolower(auth()->user()->role), ['admin','guru']))

                            <div class="mt-2 d-flex">

                                <a href="{{ route('articles.edit',$article->id) }}"
                                   class="btn btn-warning btn-sm flex-fill mr-1">

                                    Edit

                                </a>

                                <form
                                    action="{{ route('articles.destroy',$article->id) }}"
                                    method="POST"
                                    class="flex-fill">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        class="btn btn-danger btn-sm btn-block"
                                        onclick="return confirm('Hapus artikel ini?')">

                                        Hapus

                                    </button>

                                </form>

                            </div>

                        @endif

                    </div>

                </div>

            </div>

        @empty

            <div class="col-12">

                <div class="alert alert-info">

                    Belum ada artikel.

                </div>

            </div>

        @endforelse

    </div>

</div>

@endsection