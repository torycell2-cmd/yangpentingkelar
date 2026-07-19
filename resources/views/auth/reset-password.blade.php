<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>EduLearn | Buat Password Baru</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    
    <style>
        body.login-page { background-color: #f4f6f9; }
        .login-box { width: 400px; }
        .card-primary.card-outline { border-top: 3px solid #007bff; }
        .btn-primary { transition: all 0.3s; }
        .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 5px 15px rgba(0,123,255,0.3); }
    </style>
</head>
<body class="hold-transition login-page">
<div class="login-box">
    
    <div class="card card-outline card-primary shadow-lg" style="border-radius: 15px;">
        <div class="card-header text-center pt-4 pb-3 border-bottom-0">
            <a href="/" class="h1 text-dark text-decoration-none"><b>Edu</b>Learn</a>
        </div>
        <div class="card-body pb-4">
            <p class="login-box-msg text-muted">Hampir selesai! Silakan buat password baru Anda di bawah ini.</p>

            <form action="{{ route('password.update') }}" method="POST">
                @csrf
                
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <div class="input-group mb-3">
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $request->email) }}" readonly required>
                    <div class="input-group-append">
                        <div class="input-group-text bg-light">
                            <span class="fas fa-envelope text-muted"></span>
                        </div>
                    </div>
                    @error('email')
                        <span class="invalid-feedback font-weight-bold" role="alert">{{ $message }}</span>
                    @enderror
                </div>

                <div class="input-group mb-3">
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password Baru" required autofocus>
                    <div class="input-group-append">
                        <div class="input-group-text bg-white">
                            <span class="fas fa-lock text-muted"></span>
                        </div>
                    </div>
                    @error('password')
                        <span class="invalid-feedback font-weight-bold" role="alert">{{ $message }}</span>
                    @enderror
                </div>

                <div class="input-group mb-4">
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Konfirmasi Password Baru" required>
                    <div class="input-group-append">
                        <div class="input-group-text bg-white">
                            <span class="fas fa-check-circle text-muted"></span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block rounded-pill font-weight-bold">Simpan Password Baru</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>