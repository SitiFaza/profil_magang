<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Instansi;

class InstansiController extends Controller
{
    // Menampilkan daftar semua instansi
    public function index()
    {
        $instansi = Instansi::all();
        return view('instansi.index', compact('instansi'));
    }

    // Menampilkan form untuk membuat instansi baru
    public function create()
    {
        return view('instansi.create');
    }

    // Menyimpan instansi baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'nama_instansi' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:instansi',
        ]);

        Instansi::create($request->all());
        return redirect()->route('instansi.index')->with('success', 'Instansi berhasil ditambahkan.');
    }

    // Menampilkan detail instansi berdasarkan id
    public function show($id)
    {
        $instansi = Instansi::findOrFail($id);
        return view('instansi.show', compact('instansi'));
    }

    // Menampilkan form untuk mengedit instansi
    public function edit($id)
    {
        $instansi = Instansi::findOrFail($id);
        return view('instansi.edit', compact('instansi'));
    }

    // Mengupdate data instansi
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_instansi' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:instansi,email,' . $id . ',id_instansi',
        ]);

        $instansi = Instansi::findOrFail($id);
        $instansi->update($request->all());

        return redirect()->route('instansi.index')->with('success', 'Instansi berhasil diperbarui.');
    }

    // Menghapus instansi dari database
    public function destroy($id)
    {
        $instansi = Instansi::findOrFail($id);
        $instansi->delete();

        return redirect()->route('instansi.index')->with('success', 'Instansi berhasil dihapus.');
    }
}
