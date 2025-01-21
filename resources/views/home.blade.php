@extends('layouts.footer')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peserta Magang</title>
    <!-- Tambahkan Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom CSS */
        .navbar {
            background-color: orange;
        }

        .navbar-brand {
            font-weight: bold;
            font-size: 1.2rem;
            margin-left: 70px; 
            padding-left: 0;
        }

        .navbar-brand img {
            height: 50px;
            margin-right: 100px;
        }


        .nav-link {
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .nav-link:hover {
            color: #ffcc00 !important;
        }

        .hero-section {
            height: 80vh;
            background: url('{{ asset("storage/background-image.jpg") }}') no-repeat center center;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .hero-section .btn {
            width: 200px;
            margin-bottom: 10px;
            font-size: 1.2rem;
            transition: transform 0.3s ease, background-color 0.3s ease;
        }

        .hero-section .btn:hover {
            transform: scale(1.05);
        }

        .btn-primary {
            background-color: rgba(0, 123, 255, 0.5); /* 50% transparan dengan warna biru */
            border-color: rgba(0, 123, 255, 0.5); /* 50% transparan dengan warna biru */
            color: white; /* Pastikan teks tetap terlihat */
        }

        .btn-secondary {
            background-color: rgba(108, 117, 125, 0.5); /* 50% transparan dengan warna abu-abu */
            border-color: rgba(108, 117, 125, 0.5); /* 50% transparan dengan warna abu-abu */
            color: white; /* Pastikan teks tetap terlihat */
        }

        .btn-primary:hover {
            background-color: rgba(0, 123, 255, 0.8); /* Darken the button on hover */
            border-color: rgba(0, 123, 255, 0.8); /* Darken the border on hover */
        }

        .btn-secondary:hover {
            background-color: rgba(108, 117, 125, 0.8); /* Darken the button on hover */
            border-color: rgba(108, 117, 125, 0.8); /* Darken the border on hover */
        }


        @media (max-width: 768px) {
            .hero-section {
                height: 100vh;
            }

            .navbar-brand {
                font-size: 1rem;
            }

            .hero-section .btn {
                width: 100%;
                margin-bottom: 10px;
            }

        }
    </style>
</head>
<body style="background-image: url('{{ asset('images/IMG20250113080613.jpg') }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">
    <nav class="navbar navbar-expand-lg">
        <div class="container d-flex align-items-center">
            <img src="{{ asset('storage/kalbar-logo.png') }}" alt="logo">
            <a class="navbar-brand text-white" style="margin-left: 15px; position: absolute; padding-left: 25px;">PESERTA MAGANG DISPERKIM KALBAR</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <button onclick="location.href='/peserta-magang'" class="btn btn-secondary btn-lg" style="margin-right: 0px;">Lihat Peserta Magang</button>
        </div>
    </nav>
    <div class="container mt-4 center">
        <div class="hero-section">
            <div class="text">
                {{-- <button onclick="location.href='/adminPerkim'" class="btn btn-primary btn-lg">Login sebagai Admin</button>
                <br> --}}
            </div>
        </div>
    </div>
    

    <!-- Tambahkan Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
