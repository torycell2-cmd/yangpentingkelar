@extends('adminlte::page')

@section('title','Hasil Quiz')

@section('content')

<div class="container-fluid">

    <div class="card">

        <div class="card-header">
            <h3>Hasil Quiz Siswa</h3>
        </div>

        <div class="card-body">

            <table class="table table-bordered table-striped">

                <thead>

                    <tr>
                        <th>No</th>
                        <th>Nama Siswa</th>
                        <th>Quiz</th>
                        <th>Nilai</th>
                        <th>Status</th>
                    </tr>

                </thead>

                <tbody>

                @forelse($results as $hasil)

                    <tr>

                        <td>{{ $loop->iteration }}</td>

                        <td>{{ $hasil->user->name }}</td>

                        <td>{{ $hasil->quiz->judul }}</td>

                        <td>{{ $hasil->nilai }}</td>

                        <td>

                            @if($hasil->status=='Lulus')

                                <span class="badge badge-success">
                                    Lulus
                                </span>

                            @else

                                <span class="badge badge-danger">
                                    Remedial
                                </span>

                            @endif

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="5" class="text-center">
                            Belum ada hasil quiz.
                        </td>
                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection