@extends('adminlte::page')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg p-4 text-center rounded-lg border-0">
                <!-- Avatar -->
                <div class="bg-primary mx-auto mb-3 rounded-circle d-flex align-items-center justify-content-center text-white" 
                     style="width:120px; height:120px; font-size:50px; font-weight:bold;">
                    {{ substr($user->name, 0, 1) }}
                </div>
                
                <!-- Nama & Role -->
                <h3 class="font-weight-bold mb-1">{{ $user->name }}</h3>
                <p class="text-muted mb-2">{{ $user->email }}</p>
                
                <div class="mb-3">
                    <span class="badge badge-primary px-3 py-2 font-weight-normal">
                        {{ $user->role ?? 'Siswa' }}
                    </span>
                </div>

                <!-- Status Pertemanan -->
                <div class="my-3">
                    @if($isFriend)
                        <button class="btn btn-success" disabled>Teman Anda</button>
                    @elseif($isPending)
                        <button class="btn btn-warning" disabled>Menunggu...</button>
                    @else
                        <form action="{{ route('friend.add', $user->id) }}" method="POST">
                            @csrf
                            <button class="btn btn-primary">Tambah Teman</button>
                        </form>
                    @endif
                </div>
                
                <hr class="w-100">
                
                <!-- Tombol Kembali -->
                <a href="{{ url()->previous() }}" class="btn btn-outline-secondary rounded-pill px-4 mt-2">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali
                </a>
            </div>
        </div>
    </div>
</div>
@endsection