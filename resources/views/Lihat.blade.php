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
    </style>
</head>
<body>
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
                    <tbody id="data-tbody">
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
