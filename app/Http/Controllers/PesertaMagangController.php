<?php

namespace App\Http\Controllers;

use App\Models\peserta_magang;
use Illuminate\Http\Request;
use App\Models\PesertaMagang;
use Illuminate\Support\Facades\Storage;

class PesertaMagangController extends Controller
{
    // Menampilkan profil peserta magang
    public function show($id)
    {
        $pesertaMagang = peserta_magang::with(['penempatan_magang', 'instansi'])
        ->findOrFail($id);


        return view('pesertamagang.show', compact('pesertaMagang'));
    }

    // Menampilkan form upload berkas
    public function uploadForm($id)
    {
        $pesertaMagang = peserta_magang::findOrFail($id);
        return view('pesertamagang.upload', compact('pesertaMagang'));
    }

    // Menyimpan berkas yang diupload peserta magang
    public function upload(Request $request, $id)
    {
        $pesertaMagang = peserta_magang::findOrFail($id);

        $request->validate([
            'berkas' => 'required|file|mimes:pdf,doc,docx|max:2048', // Validasi file
        ]);
        return redirect()->route('pesertamagang.show', $id)->with('success', 'Berkas berhasil diupload.');
    }

    // Controller: PesertaMagangController.php
    public function lihatPesertaMagang(Request $request)
    {
        $query = Peserta_Magang::with(['penempatan_magang', 'instansi']);

        $tahun = $request->input('tahun');
        $cari = $request->input('cari'); // Parameter pencarian tunggal untuk semua kolom

        // Filter tahun
        if ($tahun && $tahun !== 'all') {
            $query->whereHas('penempatan_magang', function ($q) use ($tahun) {
                $q->whereYear('tanggal_mulai', $tahun);
            });
        }

        // Filter berdasarkan pencarian
        if ($cari) {
            $query->where(function ($q) use ($cari) {
                $q->where('nama', 'LIKE', '%' . $cari . '%')
                ->orWhere('nomor_induk', 'LIKE', '%' . $cari . '%')
                ->orWhere('jurusan', 'LIKE', '%' . $cari . '%')
                ->orWhereHas('instansi', function ($q) use ($cari) {
                    $q->where('nama_instansi', 'LIKE', '%' . $cari . '%');
                });
            });
        }

        $pesertaMagang = $query->get();

        // Ambil tahun unik dari penempatan magang
        $uniqueYears = $pesertaMagang
            ->filter(fn($peserta) => $peserta->penempatan_magang)
            ->flatMap(fn($peserta) => [
                optional($peserta->penempatan_magang)->tanggal_mulai 
                    ? \Carbon\Carbon::parse($peserta->penempatan_magang->tanggal_mulai)->year 
                    : null,
            ])
            ->unique()
            ->sort()
            ->values();

        return view('Lihat', compact('pesertaMagang', 'uniqueYears'));
    }

}