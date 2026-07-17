@extends('adminlte::page')

@section('title', 'Detail Artikel')

@section('content')

<div class="container-fluid pt-4">

    <div class="card card-primary">

        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-book-open"></i>
                {{ $article->title }}
            </h3>
        </div>

        <div class="card-body">

            <div class="mb-3">

                <span class="badge badge-primary">
                    {{ $article->category }}
                </span>

            </div>

            <p class="text-muted">

                <i class="fas fa-user"></i>
                {{ $article->author }}

                &nbsp;&nbsp;

                <i class="fas fa-calendar"></i>
                {{ $article->created_at->format('d M Y') }}

                &nbsp;&nbsp;

                <i class="fas fa-eye"></i>
                {{ $article->views }} kali dibaca

            </p>

            <hr>

            <div style="line-height:1.9;font-size:16px">

                {!! nl2br(e($article->content)) !!}

            </div>

        </div>

        <div class="card-footer">

            <a href="{{ route('articles.index') }}"
               class="btn btn-secondary">

                <i class="fas fa-arrow-left"></i>

                Kembali

            </a>

            @if(in_array(strtolower(auth()->user()->role), ['admin','guru']))

                <a href="{{ route('articles.edit',$article->id) }}"
                   class="btn btn-warning">

                    <i class="fas fa-edit"></i>

                    Edit

                </a>

            @endif

        </div>

    </div>

</div>

@endsection