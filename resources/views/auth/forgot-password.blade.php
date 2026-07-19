<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>EduLearn | Lupa Password</title>

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
            <p class="login-box-msg text-muted">Lupa password Anda? Tidak masalah. Masukkan email Anda di bawah ini dan kami akan mengirimkan tautan untuk mengatur ulang password Anda.</p>

            @if(session('status'))
                <div class="alert alert-success text-sm pb-2 pt-2 text-center rounded shadow-sm">
                    <i class="fas fa-check-circle mr-1"></i> {{ session('status') }}
                </div>
            @endif

            <form action="{{ route('password.email') }}" method="POST">
                @csrf
                
                <div class="input-group mb-4">
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Masukkan Email Address Anda" value="{{ old('email') }}" required autofocus>
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

                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block rounded-pill font-weight-bold">Kirim Tautan Reset Password</button>
                    </div>
                </div>
            </form>

            <div class="mt-4 text-center">
                <a href="{{ route('login') }}" class="text-sm text-decoration-none"><i class="fas fa-arrow-left mr-1"></i> Kembali ke halaman Login</a>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
</body>
</html>