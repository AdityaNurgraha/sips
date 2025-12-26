<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\ListPelanggaran;
use App\Models\KategoriPelanggaran;
use Illuminate\Http\Request;

class GuruController extends Controller
{
    /**
     * Dashboard Guru
     */
    public function index()
    {
        // Pastikan user adalah guru
        if (auth()->user()->role !== 'guru') {
            abort(403, 'Unauthorized access.');
        }

        // Data summary cards
        $jumlahSiswa       = Siswa::count();
        $jumlahPelanggaran = KategoriPelanggaran::count();
        $siswaMelanggar    = ListPelanggaran::distinct('nisn')->count('nisn');

        // Top 5 pelanggaran paling sering
        $topPelanggaran = ListPelanggaran::select('kategori_pelanggaran_id')
            ->selectRaw('COUNT(*) as total')
            ->with('kategoriPelanggaran')
            ->groupBy('kategori_pelanggaran_id')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        // Top 5 siswa dengan poin tertinggi
        $topSiswa = ListPelanggaran::select('nisn', 'nama_siswa')
            ->selectRaw('SUM(kategori_pelanggarans.poin) as total_poin')
            ->join('kategori_pelanggarans', 'list_pelanggarans.kategori_pelanggaran_id', '=', 'kategori_pelanggarans.id')
            ->groupBy('nisn', 'nama_siswa')
            ->orderByDesc('total_poin')
            ->limit(5)
            ->get();

        return view('guru.dashboard', compact(
            'jumlahSiswa',
            'jumlahPelanggaran',
            'siswaMelanggar',
            'topPelanggaran',
            'topSiswa'
        ));
    }

    /**
     * Tampilkan halaman edit profil guru
     */
    public function editProfile()
    {
        $user = auth()->user(); // ambil data guru yang login
        return view('guru.profile.edit', compact('user'));
    }

    /**
     * Update data profil guru
     */
    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'photo' => 'nullable|image|max:2048', // max 2MB
        ]);

        $user->name  = $request->name;
        $user->email = $request->email;

        // Upload foto profil jika ada
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('photos', 'public');
            $user->photo = $path;
        }

        $user->save();

        return redirect()->route('guru.profile.edit')->with('status', 'profile-updated');
    }
}
