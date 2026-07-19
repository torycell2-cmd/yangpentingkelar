<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>EduLearn | Log in</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    
    <style>
        /* Sedikit sentuhan custom agar lebih mulus */
        body.login-page {
            background-color: #f4f6f9;
        }
        .login-box {
            width: 400px;
        }
        .card-primary.card-outline {
            border-top: 3px solid #007bff;
        }
        .btn-primary {
            transition: all 0.3s;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,123,255,0.3);
        }
    </style>
</head>
<body class="hold-transition login-page">
<div class="login-box">
    
    <div class="card card-outline card-primary shadow-lg" style="border-radius: 15px;">
        <div class="card-header text-center pt-4 pb-3 border-bottom-0">
            <a href="/" class="h1 text-dark text-decoration-none"><b>Edu</b>Learn</a>
        </div>
        <div class="card-body pb-4">
            <p class="login-box-msg text-muted">Silakan masuk untuk memulai sesi Anda</p>

           @if(request()->query('message') == 'login_dulu')
                <div class="alert alert-warning text-sm mb-3 text-center">
                    <i class="fas fa-exclamation-triangle mr-1"></i> Anda harus login terlebih dahulu untuk membuat artikel.
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST">
                @csrf
                
                <div class="input-group mb-3">
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email Address" value="{{ old('email') }}" required autofocus>
                    <div class="input-group-append">
                        <div class="input-group-text bg-white">
                            <span class="fas fa-envelope text-muted"></span>
                        </div>
                    </div>
                    @error('email')
                        <span class="invalid-feedback font-weight-bold" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div class="input-group mb-3">
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" required>
                    <div class="input-group-append">
                        <div class="input-group-text bg-white">
                            <span class="fas fa-lock text-muted"></span>
                        </div>
                    </div>
                    @error('password')
                        <span class="invalid-feedback font-weight-bold" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div class="row mt-4 align-items-center">
                    <div class="col-7">
                        <div class="icheck-primary">
                            <input type="checkbox" id="remember" name="remember">
                            <label for="remember" class="font-weight-normal text-muted" style="cursor: pointer;">
                                Ingat Saya
                            </label>
                        </div>
                    </div>
                    <div class="col-5">
                        <button type="submit" class="btn btn-primary btn-block rounded-pill font-weight-bold">Masuk</button>
                    </div>
                </div>
            </form>

            <div class="mt-4 mb-2 text-center">
                <a href="{{ route('password.request') }}" class="text-sm text-decoration-none">Lupa password Anda?</a>
            </div>
            <div class="mb-0 text-center">
                <span class="text-sm text-muted">Belum punya akun? <a href="#" data-toggle="modal" data-target="#roleModal" class="text-decoration-none font-weight-bold">Daftar sekarang</a></span>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="roleModal" tabindex="-1" aria-labelledby="roleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 20px; border: none; box-shadow: 0 15px 35px rgba(0,0,0,0.2);">
            <div class="modal-header border-0 flex-column text-center pb-0">
                <h5 class="modal-title font-weight-bold w-100 mt-2">Pilih Peran Anda</h5>
                <button type="button" class="close position-absolute" style="right: 20px; top: 15px;" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-4 text-center">
                <p class="text-muted small mb-4">Pilih jenis akun untuk melanjutkan pendaftaran</p>
    
                <div class="row">
                    <div class="col-6 pr-2">
                        <a href="{{ route('register') }}?role=guru" class="btn btn-primary rounded-pill py-2 shadow-sm w-100">
                            <i class="fas fa-chalkboard-teacher mr-2"></i> Guru
                        </a>
                    </div>
                    <div class="col-6 pl-2">
                        <a href="{{ route('register') }}?role=siswa" class="btn btn-success rounded-pill py-2 shadow-sm w-100">
                            <i class="fas fa-user-graduate mr-2"></i> Siswa
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
</body>
</html>