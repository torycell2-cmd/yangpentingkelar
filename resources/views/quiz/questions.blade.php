@extends('adminlte::page')

@section('title','Tambah Soal')

@section('content')

<div class="container">

    <div class="card">

        <div class="card-header">
            <h3>Tambah Soal</h3>
            <h5>{{ $quiz->judul }}</h5>
        </div>

        <div class="card-body">

            <div class="alert alert-info">

                <h5>
                    Soal ke-{{ $nomor }} dari {{ $quiz->jumlah_soal }}
                </h5>

                @php
                    $persen = (($nomor - 1) / $quiz->jumlah_soal) * 100;
                @endphp

                <div class="progress mb-3">
                    <div class="progress-bar bg-success"
                         role="progressbar"
                         style="width: {{ $persen }}%">
                        {{ round($persen) }}%
                    </div>
                </div>

            </div>

            <form action="{{ route('questions.store',$quiz->id) }}" method="POST">

                @csrf

                <div class="form-group">
                    <label>Pertanyaan</label>
                    <textarea name="pertanyaan" class="form-control" required></textarea>
                </div>

                <div class="form-group">
                    <label>Pilihan A</label>
                    <input type="text" name="pilihan_a" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Pilihan B</label>
                    <input type="text" name="pilihan_b" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Pilihan C</label>
                    <input type="text" name="pilihan_c" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Pilihan D</label>
                    <input type="text" name="pilihan_d" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Jawaban Benar</label>

                    <select name="jawaban" class="form-control">
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                        <option value="D">D</option>
                    </select>

                </div>

                <button type="submit" class="btn btn-success">
                    Simpan Soal
                </button>

            </form>

        </div>

    </div>

</div>

@endsection