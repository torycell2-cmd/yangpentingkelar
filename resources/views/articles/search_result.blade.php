@extends('adminlte::page')

@section('content')
<div class="card mt-4">
    <div class="card-header">
        <h5>Hasil pencarian untuk: "{{ $keyword }}"</h5>
    </div>
    <div class="card-body">
        @if($articles->count() > 0)
            <ul>
                @foreach($articles as $article)
                    <li><a href="{{ route('articles.show', $article->id) }}">{{ $article->title }}</a></li>
                @endforeach
            </ul>
        @else
            <p>Tidak ada artikel yang ditemukan.</p>
        @endif
        <a href="{{ route('articles.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
</div>
@stop