<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bidang;

class BidangController extends Controller
{
    // Menampilkan daftar semua bidang
    public function index()
    {
        $bidang = Bidang::all();
        return view('bidang.index', compact('bidang'));
    }

    // Menampilkan form untuk membuat bidang baru
    public function create()
    {
        return view('bidang.create');
    }

    // Menyimpan bidang baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'nama_bidang' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        Bidang::create($request->all());
        return redirect()->route('bidang.index')->with('success', 'Bidang berhasil ditambahkan.');
    }

    // Menampilkan detail bidang berdasarkan id
    public function show($id)
    {
        $bidang = Bidang::findOrFail($id);
        return view('bidang.show', compact('bidang'));
    }

    // Menampilkan form untuk mengedit bidang
    public function edit($id)
    {
        $bidang = Bidang::findOrFail($id);
        return view('bidang.edit', compact('bidang'));
    }

    // Mengupdate data bidang
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_bidang' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        $bidang = Bidang::findOrFail($id);
        $bidang->update($request->all());

        return redirect()->route('bidang.index')->with('success', 'Bidang berhasil diperbarui.');
    }

    // Menghapus bidang dari database
    public function destroy($id)
    {
        $bidang = Bidang::findOrFail($id);
        $bidang->delete();

        return redirect()->route('bidang.index')->with('success', 'Bidang berhasil dihapus.');
    }
}
