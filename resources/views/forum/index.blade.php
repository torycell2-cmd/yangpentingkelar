@extends('adminlte::page')

@section('title', 'Forum Diskusi')

@section('content')

<style>

body{
    background:#f4f7fb;
}

.hero{
    background:linear-gradient(135deg,#2563eb,#60a5fa);
    color:white;
    border-radius:20px;
    padding:35px;
    margin-bottom:25px;
}

.hero h2{
    font-weight:bold;
}

.search-box{
    background:white;
    border-radius:15px;
    padding:20px;
    box-shadow:0 5px 15px rgba(0,0,0,.08);
    margin-bottom:25px;
}

.search-box input{
    border-radius:30px;
}

.forum-card{

    border:none;
    border-radius:20px;
    transition:.3s;
}

.forum-card:hover{

    transform:translateY(-8px);
    box-shadow:0 20px 40px rgba(0,0,0,.12);

}

.avatar{

    width:60px;
    height:60px;
    border-radius:50%;
    background:#2563eb;
    color:white;
    display:flex;
    justify-content:center;
    align-items:center;
    font-size:25px;
    font-weight:bold;

}

.badge-category{

    background:#2563eb;
    color:white;
    border-radius:30px;
    padding:7px 15px;

}

.action-btn{

    border-radius:30px;

}

</style>

<div class="container-fluid py-4">

<div class="hero">

<div class="row align-items-center">

<div class="col-md-8">

<h2>💬 Forum Diskusi</h2>

<p>

Diskusikan materi bersama guru dan temanmu.

</p>

</div>

<div class="col-md-4 text-right">

<button class="btn btn-light rounded-pill px-4">

<i class="fas fa-plus"></i>

Buat Diskusi

</button>

</div>

</div>

</div>

<div class="search-box">

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

@php

$forums=[

[
'nama'=>'Andi',
'judul'=>'Bagaimana cara membuat migration Laravel?',
'isi'=>'Saya masih bingung menggunakan migration di Laravel. Mohon penjelasannya.',
'kategori'=>'Laravel',
'waktu'=>'5 menit lalu',
'like'=>12,
'komen'=>8
],

[
'nama'=>'Sinta',
'judul'=>'Apa itu Normalisasi Database?',
'isi'=>'Ada yang bisa menjelaskan Normalisasi sampai 3NF?',
'kategori'=>'Database',
'waktu'=>'30 menit lalu',
'like'=>20,
'komen'=>15
],

[
'nama'=>'Budi',
'judul'=>'Perbedaan Stack dan Queue',
'isi'=>'Saya masih bingung perbedaan Stack dan Queue.',
'kategori'=>'Struktur Data',
'waktu'=>'1 jam lalu',
'like'=>16,
'komen'=>9
]

];

@endphp

@foreach($forums as $forum)

<div class="card forum-card shadow mb-4">

<div class="card-body">

<div class="d-flex">

<div class="avatar">

{{ substr($forum['nama'],0,1) }}

</div>

<div class="ml-3 flex-grow-1">

<div class="d-flex justify-content-between">

<div>

<h4 class="font-weight-bold">

{{ $forum['judul'] }}

</h4>

<small class="text-muted">

<i class="fas fa-user"></i>

{{ $forum['nama'] }}

•

<i class="fas fa-clock"></i>

{{ $forum['waktu'] }}

</small>

</div>

<span class="badge-category">

{{ $forum['kategori'] }}

</span>

</div>

<p class="mt-3 text-muted">

{{ $forum['isi'] }}

</p>

<hr>

<div class="d-flex justify-content-between align-items-center">

<div>

<span class="mr-4">

❤️ {{ $forum['like'] }}

</span>

<span>

💬 {{ $forum['komen'] }}

</span>

</div>

<div>

<button class="btn btn-outline-primary action-btn">

<i class="fas fa-thumbs-up"></i>

Like

</button>

<button class="btn btn-primary action-btn">

<i class="fas fa-comments"></i>

Balas

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