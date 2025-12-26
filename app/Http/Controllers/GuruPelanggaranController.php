<?php

namespace App\Http\Controllers;

use App\Models\ListPelanggaran;
use App\Models\KategoriPelanggaran;
use App\Models\Siswa;
use Illuminate\Http\Request;

class GuruPelanggaranController extends Controller
{
    // Tampilkan daftar pelanggaran
    public function index()
    {
        $pelanggaran = ListPelanggaran::with('siswa', 'kategoriPelanggaran')
            ->latest()
            ->paginate(10);

        return view('guru.pelanggaran.index', compact('pelanggaran'));
    }

    // Form tambah pelanggaran
    public function create()
    {
        $kategori = KategoriPelanggaran::all();
        $siswa = Siswa::all();
        $pelaporOptions = ['Guru BK', 'Wali Kelas', 'Guru', 'Siswa'];

        return view('guru.pelanggaran.create', compact('kategori', 'siswa', 'pelaporOptions'));
    }

    // Simpan pelanggaran baru
    public function store(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required|exists:siswa,id',
            'kategori_pelanggaran_id' => 'required|exists:kategori_pelanggarans,id',
            'pelapor' => 'required|string|max:255',
            'note' => 'nullable|string',
        ]);

        $siswa = Siswa::find($request->siswa_id);

        ListPelanggaran::create([
            'siswa_id' => $siswa->id,
            'nisn' => $siswa->nis,
            'nama_siswa' => $siswa->nama,
            'kelas' => $siswa->kelas,
            'kategori_pelanggaran_id' => $request->kategori_pelanggaran_id,
            'pelapor' => $request->pelapor,
            'note' => $request->note,
        ]);

        return redirect()->route('guru.pelanggaran.index')
                         ->with('success', 'Data pelanggaran berhasil ditambahkan.');
    }

    // Form edit pelanggaran
    public function edit($id)
    {
        $pelanggaran = ListPelanggaran::findOrFail($id);
        $kategori = KategoriPelanggaran::all();
        $siswa = Siswa::all();
        $pelaporOptions = ['Guru BK', 'Wali Kelas', 'Guru', 'Siswa'];

        return view('guru.pelanggaran.edit', compact('pelanggaran', 'kategori', 'siswa', 'pelaporOptions'));
    }

    // Update pelanggaran
    public function update(Request $request, $id)
    {
        $request->validate([
            'siswa_id' => 'required|exists:siswa,id',
            'kategori_pelanggaran_id' => 'required|exists:kategori_pelanggarans,id',
            'pelapor' => 'required|string|max:255',
            'note' => 'nullable|string',
        ]);

        $pelanggaran = ListPelanggaran::findOrFail($id);
        $siswa = Siswa::find($request->siswa_id);

        $pelanggaran->update([
            'siswa_id' => $siswa->id,
            'nisn' => $siswa->nis,
            'nama_siswa' => $siswa->nama,
            'kelas' => $siswa->kelas,
            'kategori_pelanggaran_id' => $request->kategori_pelanggaran_id,
            'pelapor' => $request->pelapor,
            'note' => $request->note,
        ]);

        return redirect()->route('guru.pelanggaran.index')
                         ->with('success', 'Data pelanggaran berhasil diperbarui.');
    }

    // Hapus pelanggaran
    public function destroy($id)
    {
        $pelanggaran = ListPelanggaran::findOrFail($id);
        $pelanggaran->delete();

        return redirect()->route('guru.pelanggaran.index')
                         ->with('success', 'Data pelanggaran berhasil dihapus.');
    }
}
