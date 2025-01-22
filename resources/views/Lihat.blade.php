<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Anak Magang</title>
    <link rel="icon" href="{{ asset('images/45.png') }}" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
    <style>
        html, body {
            height: 100%;
            margin: 0;
            display: flex;
            flex-direction: column;
        }

        .page-container {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .content {
            flex: 1;
            padding: 20px;
        }

        footer {
            margin-top: auto;
        }

        .table-container {
            margin-top: 30px;
        }

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

        body {
    position: relative;
    background-image: url('{{ asset('images/IMG20250113080613.jpg') }}');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    height: 100vh;
}

body::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('{{ asset('images/IMG20250113080613.jpg') }}') no-repeat center center;
    background-size: cover;
    filter: blur(8px);  /* Sesuaikan tingkat blur di sini */
    z-index: -1;  /* Agar gambar blur berada di belakang konten */
}

.page-container {
    display: flex;
    flex-direction: column;
    min-height: 100vh;
    position: relative;
    z-index: 1;  /* Agar konten berada di atas gambar blur */
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
<body style="background-image: url('{{ asset('images/IMG20250113080613.jpg') }}'); background-size: cover; background-position: center; background-repeat: no-repeat;"></body>
<nav class="navbar navbar-expand-lg">
        <div class="container d-flex align-items-center">
            <img src="{{ asset('storage/kalbar-logo.png') }}" alt="logo">
            <a class="navbar-brand text-white" style="margin-left: 15px; position: absolute; padding-left: 25px;">PESERTA MAGANG DISPERKIM KALBAR</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <button onclick="location.href='/'" class="btn btn-secondary btn-lg" style="margin-right: 0px;">Kembali</button>
        </div>
    </nav>
<div class="page-container">
    <div class="content">
        <div class="container mt-4">
            <h1 class="text-center">Data Anak Magang</h1>
            <div class="row mt-4">
                <div class="col-md-4">
                    <label for="filterYear" class="form-label">Cari Tahun</label>
                    <select name="year" id="filterYear" class="form-select">
                        <option value="all">Semua Tahun</option>
                        @foreach ($uniqueYears as $year)
                            <option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>
                                {{ $year }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-8">
                    <label for="search-input" class="form-label">Cari</label>
                    <input type="text" id="search-input" class="form-control" placeholder="Masukkan kata kunci">
                </div>
            </div>
            <div class="table-container">
                <table class="table table-striped table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>Nama</th>
                            <th>Instansi</th>
                            <th>Nomor Induk</th>
                            <th>Jurusan</th>
                            <th>Status</th>
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Selesai</th>
                        </tr>
                    </thead>
                    <tbody id="data-tbody" class="table-dark">
                        @foreach ($pesertaMagang as $peserta)
                            @php
                                $startYear = optional($peserta->penempatan_magang)->tanggal_mulai 
                                    ? \Carbon\Carbon::parse($peserta->penempatan_magang->tanggal_mulai)->year 
                                    : null;
                            @endphp
                            <tr data-year="{{ $startYear ?? '' }}" 
                                data-search="{{ strtolower($peserta->nama . ' ' . optional($peserta->instansi)->nama_instansi . ' ' . $peserta->nomor_induk . ' ' . $peserta->jurusan . ' ' . $peserta->status) }}">
                                <td>{{ $peserta->nama }}</td>
                                <td>{{ optional($peserta->instansi)->nama_instansi }}</td>
                                <td>{{ $peserta->nomor_induk }}</td>
                                <td>{{ $peserta->jurusan }}</td>
                                <td>{{ $peserta->status }}</td>
                                <td>{{ optional($peserta->penempatan_magang)->tanggal_mulai }}</td>
                                <td>{{ optional($peserta->penempatan_magang)->tanggal_selesai }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @include('layouts.footer')
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const filterYear = document.getElementById('filterYear');
        const searchInput = document.getElementById('search-input');
        const rows = document.querySelectorAll('#data-tbody tr');

        function filterData() {
            const yearValue = filterYear.value;
            const searchValue = searchInput.value.toLowerCase().trim();

            rows.forEach(row => {
                const rowYear = row.getAttribute('data-year');
                const rowSearch = row.getAttribute('data-search');
                const matchesYear = yearValue === 'all' || rowYear === yearValue;
                const matchesSearch = !searchValue || rowSearch.includes(searchValue);

                row.style.display = matchesYear && matchesSearch ? '' : 'none';
            });
        }

        filterYear.addEventListener('change', filterData);
        searchInput.addEventListener('input', filterData);
    });
</script>
</body>
</html>
