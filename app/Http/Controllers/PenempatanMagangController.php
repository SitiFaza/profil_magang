<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PenempatanMagang;
use App\Models\PesertaMagang;
use App\Models\Bidang;
use App\Models\penempatan_magang;

class PenempatanMagangController extends Controller
{
    // Menampilkan daftar penempatan magang
    public function index(Request $request)
    {
        // Tahun yang tersedia
        $availableYears = Penempatan_Magang::selectRaw('YEAR(tanggal_mulai) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');

        // Tahun yang dipilih (default: tahun sekarang)
        $selectedYear = $request->input('year', date('Y'));

        // Statistik per bulan
        $magangPerBulan = Penempatan_Magang::selectRaw('MONTH(tanggal_mulai) as month, COUNT(*) as total')
            ->whereYear('tanggal_mulai', $selectedYear)
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->mapWithKeys(function ($item) {
                return [(int)$item->month => $item->total];
            });

        $monthlyData = collect(range(1, 12))->map(function ($month) use ($magangPerBulan) {
            return $magangPerBulan[$month] ?? 0;
        });

        $chartData = [
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'],
            'data' => $monthlyData,
            'label' => "Jumlah Penempatan Magang Tahun $selectedYear",
        ];

        return view('penempatan.index', compact('chartData', 'availableYears', 'selectedYear'));
    }

    // Menampilkan form untuk menambahkan penempatan magang
    public function create()
    {
        $pesertaMagang = penempatan_magang::all();
        $bidang = Bidang::all();
        return view('penempatan.create', compact('pesertaMagang', 'bidang'));
    }

    // Menyimpan data penempatan magang
    public function store(Request $request)
    {
        $request->validate([
            'id_peserta' => 'required|exists:peserta_magang,id_peserta',
            'id_bidang' => 'required|exists:bidang,id_bidang',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'status' => 'required|string|max:50',
        ]);

        penempatan_magang::create($request->all());

        return redirect()->route('penempatan.index')->with('success', 'Penempatan magang berhasil ditambahkan.');
    }

    // Menampilkan detail penempatan magang
    public function show($id)
    {
        $penempatanMagang = penempatan_magang::with(['peserta', 'bidang'])->findOrFail($id);
        return view('penempatan.show', compact('penempatanMagang'));
    }

    // Menampilkan form untuk mengedit data penempatan magang
    public function edit($id)
    {
        $penempatanMagang = penempatan_magang::findOrFail($id);
        $pesertaMagang = penempatan_magang::all();
        $bidang = Bidang::all();
        return view('penempatan.edit', compact('penempatanMagang', 'pesertaMagang', 'bidang'));
    }

    // Mengupdate data penempatan magang
    public function update(Request $request, $id)
    {
        $penempatanMagang = penempatan_magang::findOrFail($id);

        $request->validate([
            'id_peserta' => 'required|exists:peserta_magang,id_peserta',
            'id_bidang' => 'required|exists:bidang,id_bidang',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'status' => 'required|string|max:50',
        ]);

        $penempatanMagang->update($request->all());

        return redirect()->route('penempatan.index')->with('success', 'Penempatan magang berhasil diperbarui.');
    }

    // Menghapus data penempatan magang
    public function destroy($id)
    {
        $penempatanMagang = penempatan_magang::findOrFail($id);
        $penempatanMagang->delete();

        return redirect()->route('penempatan.index')->with('success', 'Penempatan magang berhasil dihapus.');
    }
}
