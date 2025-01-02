@extends('layouts.app')

@section('content')
<nav class="navbar navbar-expand-lg" style="background-color: orange;">
    <div class="container d-flex align-items-center">
        <!-- Update path gambar -->
        <img src="{{ asset('storage/kalbar-logo.png') }}" alt="logo" style="height: 50px; margin-right: 15px;">
        <a class="navbar-brand text-white text-start" href="#" style="flex: 1;">PESERTA MAGANG DINAS PERUMAHAN RAKYAT DAN KAWASAN PERMUKIMAN PROVINSI KALIMANTAN BARAT</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link text-white" href="#">Tentang Kami</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container d-flex justify-content-center align-items-center" style="height: 80vh; background: url('/path/to/your/background-image.jpg') no-repeat center center; background-size: cover;">
    <div class="text-center">
        <button onclick="location.href='/adminPerkim'" class="btn btn-primary btn-lg mb-3">Login sebagai Admin</button>
        <br>
        <button onclick="location.href='/peserta-magang'" class="btn btn-secondary btn-lg">Lihat Peserta Magang</button>
    </div>
</div>
@endsection
