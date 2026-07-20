@extends('adminlte::page')

@section('title', 'Profil Pengguna')

@section('content_header')
    <h1>Profil Pengguna</h1>
@stop

@section('content')
    <div class="row">
        {{-- Kolom Kiri: Foto & Info Ringkas --}}
        <div class="col-md-4">
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div class="text-center">
                        @php
                            $foto_profil = $user->foto ? asset('storage/' . $user->foto) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=random';
                        @endphp

                        <img class="profile-user-img img-fluid img-circle"
                             src="{{ $foto_profil }}"
                             alt="User profile picture"
                             style="width: 100px; height: 100px; object-fit: cover;">
                    </div>

                    <h3 class="profile-username text-center mt-2">{{ $user->name }}</h3>
                    <p class="text-muted text-center mb-1">{{ $user->email }}</p>
                    
                    <div class="text-center mb-3">
                        <span class="badge badge-info text-uppercase">{{ $user->role ?? 'Pengguna' }}</span>
                    </div>

                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <b>Bergabung sejak</b> 
                            <a class="float-right">{{ $user->created_at ? $user->created_at->format('d M Y') : '-' }}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        {{-- Kolom Kanan: Detail Profil & Pengaturan --}}
        <div class="col-md-8">
            <div class="card card-primary card-outline card-tabs">
                <div class="card-header p-0 pt-1 border-bottom-0">
                    <ul class="nav nav-tabs" id="profile-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="overview-tab" data-toggle="pill" href="#overview" role="tab">
                                <i class="fas fa-user mr-1"></i> Profil Saya
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="settings-tab" data-toggle="pill" href="#settings" role="tab">
                                <i class="fas fa-cog mr-1"></i> Pengaturan Profil
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="card-body">
                    {{-- Pesan Notifikasi Sukses --}}
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="icon fas fa-check"></i> {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    {{-- Pesan Error Validasi --}}
                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <h5><i class="icon fas fa-ban"></i> Terjadi Kesalahan!</h5>
                            <ul class="mb-0 pl-3">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <div class="tab-content" id="profile-tab-content">
                        
                        {{-- TAB 1: HASIL PROFIL (OVERVIEW / RESULT) --}}
                        <div class="tab-pane fade show active" id="overview" role="tabpanel">
                            <div class="table-responsive">
                                <table class="table table-borderless">
                                    <tr>
                                        <th style="width: 30%">Nama Lengkap</th>
                                        <td>: {{ $user->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Alamat Email</th>
                                        <td>: {{ $user->email }}</td>
                                    </tr>
                                    <tr>
                                        <th>No. HP / WhatsApp</th>
                                        <td>: {{ $user->phone ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Peran (Role)</th>
                                        <td>: <span class="badge badge-secondary text-uppercase">{{ $user->role ?? 'Pengguna' }}</span></td>
                                    </tr>
                                </table>
                            </div>

                            <hr>

                            {{-- Tombol untuk pindah ke Pengaturan Profil --}}
                            <button type="button" class="btn btn-primary" onclick="$('#settings-tab').click()">
                                <i class="fas fa-cog mr-1"></i> Pengaturan Profil
                            </button>
                        </div>

                        {{-- TAB 2: PENGATURAN PROFIL (DI DALAMNYA ADA SUB-TAB EDIT, FOTO, PASSWORD) --}}
                        <div class="tab-pane fade" id="settings" role="tabpanel">
                            
                            {{-- Sub-Navigasi Dalam Pengaturan --}}
                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="pills-data-tab" data-toggle="pill" href="#pills-data" role="tab">
                                        <i class="fas fa-edit mr-1"></i> Data Profil
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-foto-tab" data-toggle="pill" href="#pills-foto" role="tab">
                                        <i class="fas fa-image mr-1"></i> Upload Foto
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-security-tab" data-toggle="pill" href="#pills-security" role="tab">
                                        <i class="fas fa-lock mr-1"></i> Keamanan & Password
                                    </a>
                                </li>
                            </ul>

                            <div class="tab-content border p-3 rounded" id="pills-tabContent">
                                
                                {{-- SUB-TAB 1: EDIT DATA PROFIL --}}
                                <div class="tab-pane fade show active" id="pills-data" role="tabpanel">
                                    <form action="{{ route('profile.update') }}" method="POST">
                                        @csrf
                                        @method('PUT')

                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Nama Lengkap</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Alamat Email</label>
                                            <div class="col-sm-9">
                                                <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                                                <small class="form-text text-muted">Email ini digunakan untuk login dan menerima notifikasi.</small>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">No. HP / WhatsApp</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="phone" class="form-control" value="{{ old('phone', $user->phone ?? '') }}" placeholder="Contoh: 081234567890">
                                            </div>
                                        </div>

                                        <div class="form-group row mb-0">
                                            <div class="offset-sm-3 col-sm-9">
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="fas fa-save mr-1"></i> Simpan Perubahan Profil
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                {{-- SUB-TAB 2: UPLOAD FOTO --}}
                                <div class="tab-pane fade" id="pills-foto" role="tabpanel">
                                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')

                                        <div class="form-group row">
                                            <label for="foto" class="col-sm-3 col-form-label">Pilih Foto</label>
                                            <div class="col-sm-9">
                                                <input type="file" class="form-control-file mt-2" id="foto" name="foto" accept="image/*" required> 
                                                <small class="form-text text-muted">Format yang diizinkan: JPG, JPEG, PNG, GIF, SVG, WEBP. Maksimal: 2MB.</small>
                                            </div>
                                        </div>

                                        <div class="form-group row mb-0">
                                            <div class="offset-sm-3 col-sm-9">
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="fas fa-upload mr-1"></i> Simpan Foto
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                {{-- SUB-TAB 3: UBAH PASSWORD --}}
                                <div class="tab-pane fade" id="pills-security" role="tabpanel">
                                    <form action="{{ route('profile.update') }}" method="POST">
                                        @csrf
                                        @method('PUT')

                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Password Saat Ini</label>
                                            <div class="col-sm-8">
                                                <input type="password" name="current_password" class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Password Baru</label>
                                            <div class="col-sm-8">
                                                <input type="password" name="password" class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Konfirmasi Password Baru</label>
                                            <div class="col-sm-8">
                                                <input type="password" name="password_confirmation" class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-group row mb-0">
                                            <div class="offset-sm-4 col-sm-8">
                                                <button type="submit" class="btn btn-danger">
                                                    <i class="fas fa-key mr-1"></i> Perbarui Password
                                                </button>
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
    </div>
@stop