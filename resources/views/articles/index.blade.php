@extends('adminlte::page')

@section('title','Artikel')

@section('content')

<style>

.hero{
background:linear-gradient(135deg,#2563eb,#60a5fa);
padding:40px;
border-radius:20px;
color:white;
margin-bottom:25px;
}

.hero h2{
font-weight:bold;
}

.article-card{
border:none;
border-radius:20px;
overflow:hidden;
transition:.3s;
}

.article-card:hover{
transform:translateY(-8px);
box-shadow:0 20px 40px rgba(0,0,0,.15);
}

.article-image{
height:180px;
background:linear-gradient(135deg,#3b82f6,#93c5fd);
display:flex;
justify-content:center;
align-items:center;
font-size:60px;
color:white;
}

.search-box input{
border-radius:30px;
}

</style>

<div class="container-fluid py-4">

<div class="hero">

<div class="row align-items-center">

<div class="col-md-8">

<h2>📚 Artikel Pembelajaran</h2>

<p>
Temukan berbagai artikel menarik untuk meningkatkan kemampuanmu.
</p>

</div>

<div class="col-md-4 text-right">

<a href="#" class="btn btn-light rounded-pill px-4">

<i class="fas fa-plus"></i>

Tulis Artikel

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
placeholder="Cari artikel...">

<div class="input-group-append">

<button class="btn btn-primary rounded-pill px-4">

Cari

</button>

</div>

</div>

</form>

</div>

</div>

<div class="row">

@php

$articles=[

[
'title'=>'Belajar Laravel 12',
'kategori'=>'Pemrograman Web',
'penulis'=>'Admin',
'tanggal'=>'11 Juli 2026'
],

[
'title'=>'Dasar MySQL',
'kategori'=>'Basis Data',
'penulis'=>'Admin',
'tanggal'=>'10 Juli 2026'
],

[
'title'=>'Algoritma dan Struktur Data',
'kategori'=>'Algoritma',
'penulis'=>'Guru',
'tanggal'=>'9 Juli 2026'
]

];

@endphp

@foreach($articles as $a)

<div class="col-lg-4 mb-4">

<div class="card article-card shadow h-100">

<div class="article-image">

<i class="fas fa-book-open"></i>

</div>

<div class="card-body">

<span class="badge badge-primary mb-2">

{{ $a['kategori'] }}

</span>

<h4>

{{ $a['title'] }}

</h4>

<p class="text-muted">

<i class="fas fa-user"></i>

{{ $a['penulis'] }}

<br>

<i class="fas fa-calendar"></i>

{{ $a['tanggal'] }}

</p>

<p>

Artikel ini membahas materi secara lengkap dan mudah dipahami oleh siswa.

</p>

<a href="#"
class="btn btn-primary btn-block rounded-pill">

<i class="fas fa-book-reader"></i>

Baca Selengkapnya

</a>

</div>

</div>

</div>

@endforeach

</div>

</div>

@endsection