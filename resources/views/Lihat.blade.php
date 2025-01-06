<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Anak Magang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .table-container {
            margin-top: 30px;
        }
    </style>
</head>
<body>
<div class="container mt-4">
    <h1 class="text-center">Data Anak Magang</h1>

    <!-- Filter dan Search -->
    <div class="row mt-4">
        <div class="col-md-4">
            <label for="search-nama" class="form-label">Cari Tahun</label>
            <select name="year" id="filterYear" class="form-select">
                <option value="all">Semua Tahun</option>
                @php
                    $uniqueYears = $pesertaMagang
                        ->filter(function ($peserta) {
                            return $peserta->penempatan_magang !== null;
                        })
                        ->map(function ($peserta) {
                            return \Carbon\Carbon::parse($peserta->penempatan_magang->tanggal_mulai)->year;
                        })
                        ->unique()
                        ->sort()
                        ->values();
                @endphp
                @foreach ($uniqueYears as $year)
                    <option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>
                        {{ $year }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-8">
            <label for="search-nama" class="form-label">Cari Nama</label>
            <input type="text" id="search-nama" class="form-control" placeholder="Masukkan nama">
        </div>
    </div>
    
    <!-- Tabel Data Anak Magang -->
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
                </tr>
            </thead>
            <tbody id="data-tbody">
                @foreach ($pesertaMagang as $peserta)
                    @php
                        $startYear = optional($peserta->penempatan_magang)->tanggal_mulai 
                            ? \Carbon\Carbon::parse($peserta->penempatan_magang->tanggal_mulai)->year 
                            : null;
                    @endphp
                    <tr data-year="{{ $startYear ?? '' }}" data-nama="{{ strtolower($peserta->nama) }}">
                        <td>{{ $peserta->nama }}</td>
                        <td>{{ optional($peserta->instansi)->nama_instansi }}</td>
                        <td>{{ $peserta->nomor_induk }}</td>
                        <td>{{ $peserta->jurusan }}</td>
                        <td>{{ $peserta->status }}</td>
                        <td>{{ optional($peserta->penempatan_magang)->tanggal_mulai }}</td>
                    </tr>
                @endforeach
            </tbody>            
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const filterYear = document.getElementById('filterYear');
        const searchName = document.getElementById('search-nama');
        const rows = document.querySelectorAll('#data-tbody tr');

        function filterData() {
            const yearValue = filterYear.value;
            const nameValue = searchName.value.toLowerCase().trim();

            rows.forEach(row => {
                const rowYear = row.getAttribute('data-year');
                const rowName = row.getAttribute('data-nama');

                const matchesYear = yearValue === 'all' || rowYear === yearValue;
                const matchesName = !nameValue || rowName.includes(nameValue);

                if (matchesYear && matchesName) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        filterYear.addEventListener('change', filterData);
        searchName.addEventListener('input', filterData);
    });
</script>
</body>
</html>