@extends('adminlte::page')

@section('content')

<style>
    body { background: #f8fafc; }

    .page-title { font-weight: 700; color: #0f172a; letter-spacing: -0.02em; }

    .form-hero {
        position: relative;
        overflow: hidden;
        border: none;
        border-radius: 20px;
        background: linear-gradient(135deg, #3b82f6, #1d4ed8);
        color: #ffffff;
        box-shadow: 0 10px 30px rgba(37, 99, 235, 0.15);
    }
    .form-hero::before {
        content: '';
        position: absolute;
        width: 220px; height: 220px;
        border-radius: 50%;
        background: rgba(255,255,255,0.06);
        top: -70px; right: -50px;
    }

    .form-card { border: none; border-radius: 20px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05), 0 2px 4px -1px rgba(0,0,0,0.03); }

    .form-label-custom {
        font-weight: 600; color: #334155; font-size: 0.9rem;
        margin-bottom: 6px; display: flex; align-items: center; gap: 8px;
    }
    .form-label-custom i {
        width: 28px; height: 28px; border-radius: 8px;
        background: rgba(59,130,246,0.1); color: #3b82f6;
        display: inline-flex; align-items: center; justify-content: center; font-size: 13px;
    }

    .input-custom {
        border: 1px solid #e2e8f0; border-radius: 12px;
        padding: 12px 16px; font-size: 0.95rem;
        transition: all 0.2s ease; background: #f8fafc;
    }
    .input-custom:focus {
        border-color: #3b82f6; box-shadow: 0 0 0 3px rgba(59,130,246,0.1);
        background: #ffffff; outline: none;
    }

    .hint-text { font-size: 0.78rem; color: #94a3b8; margin-top: 4px; }

    .btn-simpan {
        background: linear-gradient(135deg, #3b82f6, #1d4ed8);
        border: none; border-radius: 12px; padding: 12px 28px;
        font-weight: 600; color: #fff;
        box-shadow: 0 4px 10px rgba(37,99,235,0.25);
        transition: all 0.2s ease;
    }
    .btn-simpan:hover { transform: translateY(-2px); box-shadow: 0 8px 15px rgba(37,99,235,0.3); color: #fff; }

    .btn-batal {
        border-radius: 12px; padding: 12px 24px; font-weight: 600;
        border: 1px solid #e2e8f0; color: #64748b; background: #fff;
        transition: all 0.2s ease;
    }
    .btn-batal:hover { background: #f8fafc; color: #334155; }
</style>

<div class="container-fluid px-4 py-3">

    <div class="mb-4">
        <h2 class="page-title m-0">Buat Quiz Baru</h2>
        <p class="text-secondary small m-0">Lengkapi detail di bawah untuk membuat quiz pembelajaran baru.</p>
    </div>

    <div class="card form-hero mb-4">
        <div class="card-body p-4 p-md-5" style="position:relative; z-index:2;">
            <span class="badge bg-white text-primary px-3 py-2 mb-3 rounded-pill fw-semibold shadow-sm">
                <i class="fas fa-file-signature me-2"></i>Quiz Builder
            </span>
            <h3 class="fw-bold mb-2 text-white">Rancang quiz yang menarik untuk siswa</h3>
            <p class="mb-0 text-white" style="opacity:0.85; max-width:600px;">
                Tentukan judul, kategori, jumlah soal, dan durasi pengerjaan sebelum menambahkan pertanyaan.
            </p>
        </div>
    </div>

    <div class="card form-card">
        <div class="card-body p-4 p-md-5">

            <form action="{{ route('quiz.store') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-md-8 mb-4">
                        <label class="form-label-custom"><i class="fas fa-heading"></i> Judul Quiz</label>
                        <input type="text" name="judul" value="{{ old('judul') }}"
                               class="form-control input-custom @error('judul') is-invalid @enderror"
                               placeholder="Contoh: Kuis Bab 1 - Aljabar" required>
                        @error('judul') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                        <div class="hint-text">Judul akan tampil di daftar quiz siswa.</div>
                    </div>

                    <div class="col-md-4 mb-4">
                        <label class="form-label-custom"><i class="fas fa-tag"></i> Kategori</label>
                        <input type="text" name="kategori" value="{{ old('kategori') }}"
                               class="form-control input-custom @error('kategori') is-invalid @enderror"
                               placeholder="Contoh: Matematika" required>
                        @error('kategori') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label class="form-label-custom"><i class="fas fa-list-ol"></i> Jumlah Soal</label>
                        <input type="number" name="jumlah_soal" value="{{ old('jumlah_soal') }}"
                               class="form-control input-custom @error('jumlah_soal') is-invalid @enderror"
                               placeholder="Contoh: 10" min="1" required>
                        @error('jumlah_soal') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                        <div class="hint-text">Minimal 1 soal.</div>
                    </div>

                    <div class="col-md-6 mb-4">
                        <label class="form-label-custom"><i class="fas fa-hourglass-half"></i> Durasi (Menit)</label>
                        <input type="number" name="durasi" value="{{ old('durasi', 30) }}"
                               class="form-control input-custom @error('durasi') is-invalid @enderror"
                               placeholder="Contoh: 30" min="1" required>
                        @error('durasi') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                        <div class="hint-text">Waktu maksimal siswa mengerjakan quiz.</div>
                    </div>
                </div>

                <hr class="my-4" style="border-color:#f1f5f9;">

                <div class="d-flex gap-2 justify-content-end">
                    <a href="{{ route('quiz.index') }}" class="btn btn-batal">
                        <i class="fas fa-arrow-left me-2"></i>Batal
                    </a>
                    <button type="submit" class="btn btn-simpan">
                        <i class="fas fa-save me-2"></i>Simpan Quiz
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>

@endsection