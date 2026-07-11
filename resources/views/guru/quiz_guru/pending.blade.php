@extends('adminlte::page')

@section('content')

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-lg-8">

            <div class="card border-0 shadow rounded-4">

                <div class="card-body text-center p-5">

                    {{-- Icon --}}
                    <div class="mb-4">
                        <div class="rounded-circle bg-warning bg-opacity-25 d-inline-flex justify-content-center align-items-center"
                             style="width:120px;height:120px;">
                            <span style="font-size:55px;">📝</span>
                        </div>
                    </div>

                    {{-- Judul --}}
                    <h2 class="fw-bold mb-3">
                        Quiz Berhasil Dikirim
                    </h2>

                    <p class="text-muted fs-5">
                        Quiz yang Anda buat telah berhasil dikirim dan sedang menunggu proses
                        verifikasi dari Admin.
                    </p>

                    {{-- Status --}}
                    <div class="alert alert-warning rounded-4 border-0 mt-4">

                        <h5 class="fw-bold mb-2">
                            Status Saat Ini
                        </h5>

                        <span class="badge bg-warning text-dark px-4 py-2 rounded-pill fs-6">
                            Menunggu Persetujuan Admin
                        </span>

                    </div>

                    {{-- Timeline --}}
                    <div class="card border-0 bg-light rounded-4 mt-4">

                        <div class="card-body">

                            <h5 class="fw-bold mb-3">
                                Proses Selanjutnya
                            </h5>

                            <div class="text-start">

                                <p class="mb-2">
                                    ✅ Quiz berhasil dibuat
                                </p>

                                <p class="mb-2">
                                    🟡 Menunggu verifikasi Admin
                                </p>

                                <p class="mb-2">
                                    📢 Admin akan melakukan pengecekan isi quiz
                                </p>

                                <p class="mb-0">
                                    🚀 Setelah disetujui, quiz akan otomatis tampil untuk siswa.
                                </p>

                            </div>

                        </div>

                    </div>

                    {{-- Info --}}
                    <div class="alert alert-info rounded-4 border-0 mt-4">

                        <strong>Catatan</strong><br>

                        Jika terdapat revisi, Admin akan memberikan catatan sehingga Anda dapat
                        memperbaiki quiz sebelum diterbitkan.

                    </div>

                    {{-- Tombol --}}
                    <div class="mt-4 d-flex justify-content-center gap-3">

                        <a href="#" class="btn btn-primary rounded-pill px-4">
                            Kembali ke Quiz Saya
                        </a>

                        <a href="#" class="btn btn-outline-secondary rounded-pill px-4">
                            Buat Quiz Lagi
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection