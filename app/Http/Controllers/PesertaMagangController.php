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
        $pesertaMagang = peserta_magang::findOrFail($id);
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
}