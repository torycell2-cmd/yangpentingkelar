<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>EduLearn | Daftar Akun</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    
    <style>
        body.register-page { background-color: #f4f6f9; }
        .register-box { width: 400px; }
        .card-outline.card-success { border-top: 3px solid #28a745; }
        .btn-success { transition: all 0.3s; }
        .btn-success:hover { transform: translateY(-2px); box-shadow: 0 5px 15px rgba(40,167,69,0.3); }
    </style>
</head>
<body class="hold-transition register-page">
<div class="register-box">
    
    <div class="card card-outline card-success shadow-lg" style="border-radius: 15px;">
        <div class="card-header text-center pt-4 pb-3 border-bottom-0">
            <a href="/" class="h1 text-dark text-decoration-none"><b>Edu</b>Learn</a>
        </div>
        <div class="card-body pb-4">
@php
    $role = ucfirst(request()->query('role', 'siswa'));
@endphp

        <p class="login-box-msg text-muted">
            Daftar akun baru sebagai
            <b>{{ $role }}</b>
        </p>
            <form action="{{ route('register') }}" method="POST">
                @csrf
                <input type="hidden" name="role" value="{{ request()->query('role', 'siswa') }}">

                <div class="input-group mb-3">
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Nama Lengkap" value="{{ old('name') }}" required>
                    <div class="input-group-append">
                        <div class="input-group-text bg-white"><span class="fas fa-user text-muted"></span></div>
                    </div>
                    @error('name') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>

                <div class="input-group mb-3">
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email Address" value="{{ old('email') }}" required>
                    <div class="input-group-append">
                        <div class="input-group-text bg-white"><span class="fas fa-envelope text-muted"></span></div>
                    </div>
                    @error('email') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>

                <div class="input-group mb-3">
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" required>
                    <div class="input-group-append">
                        <div class="input-group-text bg-white"><span class="fas fa-lock text-muted"></span></div>
                    </div>
                    @error('password') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>

                <div class="input-group mb-4">
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Konfirmasi Password" required>
                    <div class="input-group-append">
                        <div class="input-group-text bg-white"><span class="fas fa-check-circle text-muted"></span></div>
                    </div>
                </div>

                <button type="submit" class="btn btn-success btn-block rounded-pill font-weight-bold">Daftar Akun</button>
            </form>

            <div class="mt-4 text-center text-sm">
                Sudah punya akun? <a href="{{ route('login') }}" class="text-decoration-none font-weight-bold">Masuk di sini</a>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
</body>
</html>