@extends('adminlte::page')

@section('title', 'Artikel Pending')

@section('content')

<div class="container-fluid pt-4">

    <div class="card">

        <div class="card-header bg-warning">
            <h3 class="card-title">
                <i class="fas fa-clock"></i>
                Artikel Menunggu Persetujuan
            </h3>
        </div>

        <div class="card-body">

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <table class="table table-bordered table-striped">

                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Author</th>
                        <th>Kategori</th>
                        <th>Status</th>
                        <th width="150">Aksi</th>
                    </tr>
                </thead>

                <tbody>

                @forelse($articles as $article)

                    <tr>

                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $article->title }}</td>
                        <td>{{ $article->author }}</td>
                        <td>{{ $article->category }}</td>

                        <td>
                            <span class="badge bg-warning">
                                {{ ucfirst($article->status) }}
                            </span>
                        </td>

                        <td>

                            <form action="{{ route('admin.articles.approve', $article->id) }}" method="POST">

                                @csrf
                                @method('PATCH')

                                <button class="btn btn-success btn-sm">
                                    <i class="fas fa-check"></i>
                                    Approve
                                </button>

                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="6" class="text-center">
                            Tidak ada artikel yang menunggu persetujuan.
                        </td>
                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection