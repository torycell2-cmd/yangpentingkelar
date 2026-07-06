@extends('adminlte::page')

@section('title', 'Portal Artikel')

@section('content')
<div class="container-fluid pt-4">
    
    <div class="row mb-4">
        <div class="col-md-12">
            <form action="{{ route('articles.index') }}" method="GET">
                <div class="input-group input-group-lg">
                    <input type="text" name="query" class="form-control" placeholder="Cari artikel edukasi di sini..." value="{{ $keyword ?? '' }}">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Cari</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h3 class="card-title font-weight-bold">Artikel Terbaru</h3>
                    @if(auth()->user()->role === 'guru' || auth()->user()->role === 'admin')
                        <a href="{{ route('articles.create') }}" class="btn btn-sm btn-success ml-auto"><i class="fas fa-plus"></i> Tulis Artikel Baru</a>
                    @endif
                </div>
                <div class="card-body">
                    @forelse($articles as $article)
                        <div class="border-bottom mb-4 pb-3">
                            <h4 class="text-primary font-weight-bold">{{ $article->title }}</h4>
                            <p class="text-muted small">Penulis: {{ $article->author }} | Kategori: {{ $article->category }} | {{ $article->created_at->diffForHumans() }}</p>
                            <p>{{ Str::limit($article->content, 180) }}</p>
                            <a href="{{ route('articles.show', $article->id) }}" class="btn btn-sm btn-outline-primary">Baca Selengkapnya</a>
                        </div>
                    @empty
                        <p class="text-center text-muted py-4">Tidak ada artikel yang ditemukan.</p>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card card-outline card-danger">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-fire mr-1 text-danger"></i> Artikel Trending</h3>
                </div>
                <div class="card-body p-0">
                    <ul class="products-list product-list-in-card pl-2 pr-2">
                        @forelse($trendingArticles as $trend)
                            <li class="item py-2 border-bottom">
                                <div class="product-info ml-2">
                                    <a href="{{ route('articles.show', $trend->id) }}" class="product-title font-weight-bold text-dark">{{ $trend->title }}</a>
                                    <span class="badge badge-warning float-right">{{ $trend->views ?? 0 }} Views</span>
                                    <span class="product-description small text-muted">Oleh: {{ $trend->author }}</span>
                                </div>
                            </li>
                        @empty
                            <li class="item p-3 text-center text-muted">Belum ada materi populer.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection