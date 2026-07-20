@extends('adminlte::page')

@section('content')
<div class="container-fluid py-4">
    <!-- Header Pencarian -->
    <div class="text-center mb-5">
        <h2 class="font-weight-bolder">Cari Teman Baru</h2>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="{{ route('friends.index') }}" method="GET">
                    <div class="input-group shadow-sm rounded-pill overflow-hidden">
                        <input type="text" name="search" class="form-control border-0 py-3" placeholder="Masukkan nama teman...">
                        <button type="submit" class="btn btn-primary px-4">Cari</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- 1. TEMAN SAYA -->
    <h5 class="mb-3 font-weight-bold"><i class="fas fa-user-friends text-success mr-2"></i>Teman Saya</h5>
    <div class="row mb-5">
        @forelse($friends as $friend)
            <div class="col-6 col-md-3 col-lg-2">
                <div class="card shadow-sm p-3 text-center rounded-lg h-100">
                    <div class="bg-success text-white mx-auto mb-2 rounded-circle d-flex align-items-center justify-content-center" style="width:50px;height:50px">{{ substr($friend->name,0,1) }}</div>
                    
                    <a href="{{ route('profile.show', $friend->id) }}" style="text-decoration:none; color:inherit;">
                        <h6 class="font-weight-bold">{{ $friend->name }}</h6>
                    </a>
                    
                    <span class="badge badge-light text-muted mb-2">{{ $friend->role ?? 'Siswa' }}</span>
                </div>
            </div>
        @empty
            <div class="col-12 text-muted px-3">Belum ada koneksi teman saat ini.</div>
        @endforelse
    </div>

    <!-- 2. SEDANG MENINJAU -->
    @if($pendingRequests->isNotEmpty())
    <h5 class="mb-3 font-weight-bold"><i class="fas fa-clock text-warning mr-2"></i>Sedang Meninjau</h5>
    <div class="row mb-5">
        @foreach($pendingRequests as $p)
            <div class="col-6 col-md-3 col-lg-2">
                <div class="card shadow-sm p-3 text-center rounded-lg bg-light h-100">
                    <div class="bg-secondary text-white mx-auto mb-2 rounded-circle d-flex align-items-center justify-content-center" style="width:50px;height:50px">{{ substr($p->name,0,1) }}</div>
                    
                    <a href="{{ route('profile.show', $p->id) }}" style="text-decoration:none; color:inherit;">
                        <h6 class="font-weight-bold">{{ $p->name }}</h6>
                    </a>

                    @if($p->pivot->user_id == auth()->id())
                        <button class="btn btn-sm btn-secondary btn-block rounded-pill" disabled>Menunggu...</button>
                    @else
                        <form action="{{ route('friend.accept', $p->id) }}" method="POST">
                            @csrf
                            <button class="btn btn-sm btn-success btn-block rounded-pill">Terima</button>
                        </form>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
    @endif

    <!-- 3. SARAN TEMAN -->
    <h5 class="mb-3 font-weight-bold"><i class="fas fa-user-plus text-primary mr-2"></i>Saran Teman</h5>
    <div class="row">
        @forelse($suggestedUsers as $s)
            <div class="col-6 col-md-3 col-lg-2">
                <div class="card shadow-sm p-3 text-center rounded-lg h-100">
                    <div class="bg-primary text-white mx-auto mb-2 rounded-circle d-flex align-items-center justify-content-center" style="width:50px;height:50px">{{ substr($s->name,0,1) }}</div>
                    
                    <a href="{{ route('profile.show', $s->id) }}" style="text-decoration:none; color:inherit;">
                        <h6 class="font-weight-bold">{{ $s->name }}</h6>
                    </a>

                    <form action="{{ route('friend.add', $s->id) }}" method="POST">
                        @csrf
                        <button class="btn btn-sm btn-primary btn-block rounded-pill">Tambah</button>
                    </form>
                </div>
            </div>
        @empty
            <div class="col-12 text-muted px-3">Belum ada saran teman baru.</div>
        @endforelse
    </div>
</div>
@endsection