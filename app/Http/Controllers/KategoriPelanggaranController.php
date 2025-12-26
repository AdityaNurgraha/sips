<?php

namespace App\Http\Controllers;

use App\Models\KategoriPelanggaran;
use Illuminate\Http\Request;

class KategoriPelanggaranController extends Controller
{
    /**
     * Tampilkan semua data kategori pelanggaran, dikelompokkan per kategori.
     */
    public function index()
    {
        // Ambil semua data tanpa pagination agar bisa dikelompokkan dengan groupBy di view
        $kategori = KategoriPelanggaran::orderBy('kategori', 'asc')->get();

        return view('admin.kategori.index', compact('kategori'));
    }

    /**
     * Form tambah data baru.
     */
    public function create()
    {
        return view('admin.kategori.create');
    }

    /**
     * Simpan data baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_pelanggaran' => 'required|string|max:255',
            'poin'             => 'required|integer|min:1',
            'kategori'         => 'required|string|max:100',
            'deskripsi'        => 'nullable|string',
        ]);

        KategoriPelanggaran::create([
            'nama_pelanggaran' => $request->nama_pelanggaran,
            'poin'             => $request->poin,
            'kategori'         => $request->kategori,
            'deskripsi'        => $request->deskripsi,
        ]);

        return redirect()
            ->route('admin.kategori.index')
            ->with('success', 'Data kategori pelanggaran berhasil ditambahkan!');
    }

    /**
     * Form edit data.
     */
    public function edit($id)
    {
        $kategori = KategoriPelanggaran::findOrFail($id);
        return view('admin.kategori.edit', compact('kategori'));
    }

    /**
     * Update data kategori.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_pelanggaran' => 'required|string|max:255',
            'poin'             => 'required|integer|min:1',
            'kategori'         => 'required|string|max:100',
            'deskripsi'        => 'nullable|string',
        ]);

        $kategori = KategoriPelanggaran::findOrFail($id);
        $kategori->update([
            'nama_pelanggaran' => $request->nama_pelanggaran,
            'poin'             => $request->poin,
            'kategori'         => $request->kategori,
            'deskripsi'        => $request->deskripsi,
        ]);

        return redirect()
            ->route('admin.kategori.index')
            ->with('success', 'Data kategori pelanggaran berhasil diperbarui!');
    }

    /**
     * Hapus data kategori.
     */
    public function destroy($id)
    {
        $kategori = KategoriPelanggaran::findOrFail($id);
        $kategori->delete();

        return redirect()
            ->route('admin.kategori.index')
            ->with('success', 'Data kategori pelanggaran berhasil dihapus!');
    }
}
