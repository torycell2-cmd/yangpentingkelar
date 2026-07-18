@extends('adminlte::page')


@section('content')

<div class="container">

    <div class="card">

        <div class="card-header">
            <h3>Buat Quiz</h3>
        </div>

        <div class="card-body">

            <form action="{{ route('quiz.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label>Judul Quiz</label>
                    <input type="text" name="judul" class="form-control">
                </div>

                <div class="mb-3">
                    <label>Kategori</label>
                    <input type="text" name="kategori" class="form-control">
                </div>

                <div class="mb-3">
                    <label>Jumlah Soal</label>
                    <input type="number" name="jumlah_soal" class="form-control">
                </div>

                <!-- TAMBAHKAN BAGIAN INI -->
                <div class="mb-3">
                    <label>Durasi (Menit)</label>
                    <input
                        type="number"
                        name="durasi"
                        class="form-control"
                        value="30"
                        min="1">
                </div>

                <button class="btn btn-primary">
                    Simpan
                </button>

            </form>

        </div>

    </div>

</div>

@endsection