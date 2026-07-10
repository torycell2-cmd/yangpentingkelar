@extends('adminlte::page')

@section('content')
<div class="container-fluid pt-4 pb-5">
    
    <div class="row mb-5 justify-content-center">
        <div class="col-md-10">
            <form action="{{ route('articles.index') }}" method="GET">
                <div class="input-group shadow-sm" style="border-radius: 50px; overflow: hidden; border: 1px solid #e0e0e0;">
                    <input type="text" name="query" class="form-control border-0 px-4" placeholder="Cari materi, tips, atau artikel edukasi di sini..." value="{{ $keyword ?? '' }}" style="height: 60px; font-size: 1.1rem; box-shadow: none;">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-primary px-5 font-weight-bold border-0" style="font-size: 1.1rem;">
                            <i class="fas fa-search mr-2"></i> Cari
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success shadow-sm rounded-lg border-0 mb-4">
            <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger shadow-sm rounded-lg border-0 mb-4">
            <i class="fas fa-exclamation-circle mr-2"></i> {{ session('error') }}
        </div>
    @endif

    <div class="row">
        <div class="col-md-8">
            <div class="card shadow-sm border-0" style="border-radius: 15px;">
                <div class="card-header bg-white border-bottom-0 pt-4 pb-2 d-flex align-items-center justify-content-between" style="border-radius: 15px 15px 0 0;">
                    <h3 class="card-title font-weight-bold mb-0" style="font-size: 1.4rem; color: #2c3e50;">
                        <i class="fas fa-newspaper text-primary mr-2"></i> Artikel Terbaru
                    </h3>
                    
                    @if(isset(auth()->user()->role) && (strtolower(auth()->user()->role) === 'guru' || strtolower(auth()->user()->role) === 'admin'))
                        <a href="{{ route('articles.create') }}" class="btn btn-primary btn-sm rounded-pill px-3 shadow-sm">
                            <i class="fas fa-plus mr-1"></i> Tulis Artikel
                        </a>
                    @endif
                </div>
                
                <div class="card-body px-4 pb-4">
                    @forelse($articles ?? [] as $article)
                        <div class="border-bottom mb-4 pb-4">
                            <h4 class="text-dark font-weight-bold mb-2">{{ $article->title }}</h4>
                            <div class="d-flex align-items-center text-muted small mb-3">
                                <span class="mr-3"><i class="fas fa-user-edit mr-1"></i> {{ $article->author }}</span>
                                <span class="mr-3"><i class="fas fa-tags mr-1"></i> {{ $article->category }}</span>
                                <span><i class="far fa-clock mr-1"></i> {{ $article->created_at->diffForHumans() }}</span>
                            </div>
                            <p class="text-secondary" style="line-height: 1.6;">{{ Str::limit($article->content, 180) }}</p>
                            <a href="{{ route('articles.show', $article->id) }}" class="btn btn-outline-primary btn-sm rounded-pill px-4 mt-2">
                                Baca Selengkapnya <i class="fas fa-arrow-right ml-1" style="font-size: 0.8rem;"></i>
                            </a>
                        </div>
                    @empty
                        <div class="text-center py-5">
                            <div class="d-inline-block bg-light rounded-circle p-4 mb-3">
                                <i class="fas fa-folder-open fa-3x text-secondary"></i>
                            </div>
                            <h5 class="font-weight-bold text-dark mb-1">Belum Ada Artikel</h5>
                            <p class="text-muted">Materi atau artikel edukasi belum tersedia saat ini.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm border-0" style="border-radius: 15px;">
                <div class="card-header bg-gradient-danger text-white border-0 py-3" style="border-radius: 15px 15px 0 0;">
                    <h3 class="card-title font-weight-bold mb-0">
                        <i class="fas fa-fire-alt mr-2"></i> Artikel Trending
                    </h3>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush" style="border-radius: 0 0 15px 15px;">
                        @forelse($trendingArticles ?? [] as $trend)
                            <li class="list-group-item py-3 px-4 border-bottom-0">
                                <a href="{{ route('articles.show', $trend->id) }}" class="font-weight-bold text-dark d-block mb-2" style="font-size: 1.1rem; transition: 0.2s;">
                                    {{ $trend->title }}
                                </a>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="small text-muted"><i class="fas fa-user-circle mr-1"></i> {{ $trend->author }}</span>
                                    <span class="badge badge-warning badge-pill px-2 py-1 shadow-sm"><i class="fas fa-eye mr-1"></i> {{ $trend->views ?? 0 }} </span>
                                </div>
                            </li>
                            <hr class="m-0 mx-3">
                        @empty
                            <div class="text-center py-5">
                                <i class="fas fa-chart-line fa-3x text-light mb-3"></i>
                                <p class="text-muted mb-0">Belum ada materi populer.</p>
                            </div>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection