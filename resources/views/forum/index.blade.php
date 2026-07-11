@extends('adminlte::page')

@section('title','Forum Diskusi')

@section('content')

<style>

.hero{
background:linear-gradient(135deg,#2563eb,#3b82f6,#60a5fa);
border-radius:20px;
padding:35px;
color:white;
margin-bottom:25px;
}

.hero h2{
font-weight:bold;
}

.forum-card{
border:none;
border-radius:20px;
transition:.3s;
overflow:hidden;
}

.forum-card:hover{
transform:translateY(-8px);
box-shadow:0 20px 40px rgba(0,0,0,.15);
}

.avatar{
width:55px;
height:55px;
border-radius:50%;
background:#2563eb;
color:white;
display:flex;
align-items:center;
justify-content:center;
font-size:22px;
font-weight:bold;
}

.badge-category{
background:#2563eb;
color:white;
padding:7px 14px;
border-radius:30px;
}

.info{
font-size:13px;
color:#777;
}

.search-box input{
border-radius:30px;
}

</style>

<div class="container-fluid py-4">

<div class="hero">

<div class="row align-items-center">

<div class="col-md-8">

<h2>💬 Forum Diskusi</h2>

<p class="mb-0">
Diskusikan materi bersama guru dan teman-temanmu.
</p>

</div>

<div class="col-md-4 text-right">

<a href="#" class="btn btn-light rounded-pill px-4">

<i class="fas fa-plus"></i>

Buat Diskusi

</a>

</div>

</div>

</div>

<div class="card border-0 shadow mb-4">

<div class="card-body">

<form>

<div class="input-group">

<input
type="text"
class="form-control"
placeholder="Cari topik diskusi...">

<div class="input-group-append">

<button class="btn btn-primary rounded-pill px-4">

Cari

</button>

</div>

</div>

</form>

</div>

</div>

@php

$forum=[

[
'nama'=>'Andi',
'judul'=>'Bagaimana cara menggunakan Laravel Migration?',
'isi'=>'Saya masih bingung cara migrate database di Laravel.',
'kategori'=>'Laravel',
'komentar'=>12,
'like'=>24,
'lihat'=>150
],

[
'nama'=>'Sinta',
'judul'=>'Apa itu Normalisasi Database?',
'isi'=>'Mohon penjelasan mengenai normalisasi hingga 3NF.',
'kategori'=>'Basis Data',
'komentar'=>18,
'like'=>31,
'lihat'=>210
],

[
'nama'=>'Budi',
'judul'=>'Cara membuat Login Laravel',
'isi'=>'Bagaimana cara membuat login menggunakan Laravel Breeze?',
'kategori'=>'Authentication',
'komentar'=>9,
'like'=>20,
'lihat'=>120
]

];

@endphp

@foreach($forum as $f)

<div class="card forum-card shadow mb-4">

<div class="card-body">

<div class="d-flex">

<div class="avatar">

{{ substr($f['nama'],0,1) }}

</div>

<div class="ml-3 w-100">

<div class="d-flex justify-content-between">

<div>

<h5 class="font-weight-bold">

{{ $f['judul'] }}

</h5>

<div class="info">

<i class="fas fa-user"></i>

{{ $f['nama'] }}

</div>

</div>

<span class="badge-category">

{{ $f['kategori'] }}

</span>

</div>

<p class="mt-3 text-muted">

{{ $f['isi'] }}

</p>

<hr>

<div class="d-flex justify-content-between">

<div>

<span class="mr-3">

❤️ {{ $f['like'] }}

</span>

<span class="mr-3">

💬 {{ $f['komentar'] }}

</span>

<span>

👁 {{ $f['lihat'] }}

</span>

</div>

<div>

<button class="btn btn-primary rounded-pill">

<i class="fas fa-comments"></i>

Lihat Diskusi

</button>

</div>

</div>

</div>

</div>

</div>

</div>

@endforeach

</div>

@endsection