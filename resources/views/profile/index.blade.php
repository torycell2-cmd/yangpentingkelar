@extends('adminlte::page')

@section('title', 'Profil Pengguna')

@section('content_header')
    <h1>Profil Pengguna</h1>
@stop

@section('content')
    <div class="row">
        {{-- Kolom Kiri: Foto & Info Singkat --}}
        <div class="col-md-4">
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div class="text-center">
                        @php
                            // Cek apakah user punya foto di database. 
                            // Jika tidak ada, pakai API pembuat avatar otomatis berdasarkan nama.
                            $foto_profil = $user->foto ? asset('storage/' . $user->foto) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=random';
                        @endphp

                        <img class="profile-user-img img-fluid img-circle"
                             src="{{ $foto_profil }}"
                             alt="User profile picture"
                             style="width: 100px; height: 100px; object-fit: cover;">
                    </div>

                    <h3 class="profile-username text-center">{{ $user->name }}</h3>
                    <p class="text-muted text-center">{{ $user->email }}</p>

                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <b>Bergabung sejak</b> <a class="float-right">{{ $user->created_at->format('d M Y') }}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        {{-- Kolom Kanan: Pengaturan / Update Data --}}
        <div class="col-md-8">
            <div class="card">
                <div class="card-header p-2">
                    <ul class="nav nav-pills">
                        <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">Pengaturan Profil</a></li>
                    </ul>
                </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <<div class="active tab-pane" id="settings">
    
                         {{-- Tampilkan pesan sukses jika ada --}}
                                @if(session('success'))
                                    <div class="alert alert-success alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                            <h5><i class="icon fas fa-check"></i> Berhasil!</h5>
                                            {{ session('success') }}
                                    </div>
                                @endif

                            {{-- Tampilkan pesan error validasi jika file terlalu besar/bukan gambar --}}
                                @if($errors->any())
                                    <div class="alert alert-danger alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <h5><i class="icon fas fa-ban"></i> Gagal!</h5>
                                        Gagal mengupload foto. Pastikan format gambar benar dan ukuran maksimal 2MB.
                                    </div>
                                @endif

                                {{-- Form Upload --}}
                                    <form class="form-horizontal" method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                                    @csrf
        
                                    <div class="form-group row">
                                        <label for="foto" class="col-sm-2 col-form-label">Upload Foto</label>
                                        <div class="col-sm-10">
                                            <input type="file" class="form-control-file mt-2" id="foto" name="foto" required>
                                            <small class="text-muted">Format yang diizinkan: JPG, JPEG, PNG. Ukuran maksimal: 2MB.</small>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="offset-sm-2 col-sm-10">
                                            <button type="submit" class="btn btn-primary">Simpan Foto</button>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop