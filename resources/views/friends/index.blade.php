@extends('adminlte::page')

@section('content')
<div class="container py-4">
    <h2 class="fw-bold mb-4">Daftar Teman Saya</h2>
    
    <div class="row">
        @forelse($friends as $friend)
            <div class="col-md-4">
                <div class="card p-3 shadow-sm rounded-4">
                    <div class="d-flex align-items-center">
                        <div class="avatar-circle bg-primary">{{ strtoupper(substr($friend->name, 0, 1)) }}</div>
                        <div class="ml-3">
                            <h6 class="m-0 fw-bold">{{ $friend->name }}</h6>
                            <small class="text-muted">{{ $friend->email }}</small>
                        </div>
                        <div class="ml-auto">
                            <form action="{{ route('friend.unfriend', $friend->id) }}" method="POST">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill">Unfriend</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center text-muted">Belum punya teman. Yuk cari teman di dashboard!</p>
        @endforelse
    </div>
</div>
@endsection