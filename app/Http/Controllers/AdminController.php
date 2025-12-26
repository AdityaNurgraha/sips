<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\User;
use App\Models\Guru;
use App\Models\ListPelanggaran;
use App\Models\KategoriPelanggaran;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        // Pastikan hanya admin yang bisa akses
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized access.');
        }

        // Data summary cards
        $jumlahSiswa           = Siswa::count(); // total semua siswa
        $jumlahSiswaMelanggar  = ListPelanggaran::distinct('nisn')->count('nisn'); // siswa yang pernah melanggar
        $jumlahPelanggaran     = KategoriPelanggaran::count(); // total kategori pelanggaran
        $jumlahUser            = User::count();
        $jumlahGuru            = User::where('role', 'guru')->count();

        // 🔥 Top 5 Pelanggaran paling sering dilakukan
        $topPelanggaran = ListPelanggaran::select('kategori_pelanggaran_id')
            ->selectRaw('COUNT(*) as total')
            ->with('kategoriPelanggaran:id,nama_pelanggaran,poin') // ambil nama & poin
            ->groupBy('kategori_pelanggaran_id')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        // 🔥 Top 5 Siswa berdasarkan total poin pelanggaran
        $topSiswa = ListPelanggaran::select('nisn', 'nama_siswa')
            ->selectRaw('SUM(kategori_pelanggarans.poin) as total_poin')
            ->join('kategori_pelanggarans', 'list_pelanggarans.kategori_pelanggaran_id', '=', 'kategori_pelanggarans.id')
            ->groupBy('nisn', 'nama_siswa')
            ->orderByDesc('total_poin')
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact(
            'jumlahSiswa',
            'jumlahSiswaMelanggar',
            'jumlahPelanggaran',
            'jumlahUser',
            'jumlahGuru',
            'topPelanggaran',
            'topSiswa'
        ));
    }
}
