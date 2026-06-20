@extends('layouts.layouts')

@section('content')
    <h2 class="mb-4">Selamat Datang</h2>
    <div class="row g-3">
        <div class="col-md-3"><div class="p-4 bg-white rounded shadow-sm border"><h5>Artikel</h5><p>0</p></div></div>
        <div class="col-md-3"><div class="p-4 bg-white rounded shadow-sm border"><h5>Nilai</h5><p>85</p></div></div>
    </div>
@endsection

@push('input-box')
    <div class="mx-auto" style="max-width: 800px;">
        <div class="input-group shadow-sm rounded-pill border overflow-hidden">
            <input type="text" id="articleInput" class="form-control border-0 px-4" placeholder="Buat artikel baru...">
            <button class="btn btn-primary px-4" id="sendBtn">Kirim</button>
        </div>
    </div>

    <div class="modal fade" id="loginModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-body text-center p-4">
                    <p>Silakan login atau buat akun untuk menulis artikel.</p>
                    <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('sendBtn').addEventListener('click', function() {
            @auth
                window.location.href = "{{ route('articles.create') }}";
            @else
                new bootstrap.Modal(document.getElementById('loginModal')).show();
            @endauth
        });
    </script>
@endpush