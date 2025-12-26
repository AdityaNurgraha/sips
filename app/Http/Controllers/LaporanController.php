<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ListPelanggaran;
use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        $awal    = $request->awal;
        $akhir   = $request->akhir;

        $hasilOne   = null;
        $hasilAll   = collect();
        $hasilTotal = (object)[
            'total_pelanggaran' => 0,
            'total_point'       => 0,
        ];
        $message = null;

        // Range tanggal
        $start = $end = null;
        if ($awal && $akhir) {
            $start = Carbon::parse($awal)->startOfDay();
            $end   = Carbon::parse($akhir)->endOfDay();
        }

        // Cek apakah tabel kategori_pelanggarans ada
        $hasKategori = Schema::hasTable('kategori_pelanggarans');

        if ($keyword) {
            // Cari siswa sesuai nama / nisn / kelas
            $hasilOne = ListPelanggaran::where('nisn', 'LIKE', "%{$keyword}%")
                ->orWhere('nama_siswa', 'LIKE', "%{$keyword}%")
                ->orWhere('kelas', 'LIKE', "%{$keyword}%")
                ->first();

            if ($hasilOne) {
                $query = ListPelanggaran::query()
                    ->where(function ($q) use ($keyword) {
                        $q->where('nisn', 'LIKE', "%{$keyword}%")
                          ->orWhere('nama_siswa', 'LIKE', "%{$keyword}%")
                          ->orWhere('kelas', 'LIKE', "%{$keyword}%");
                    })
                    ->orderBy('list_pelanggarans.created_at', 'asc');

                if ($hasKategori) {
                    $query->leftJoin(
                        'kategori_pelanggarans',
                        'list_pelanggarans.kategori_pelanggaran_id',
                        '=',
                        'kategori_pelanggarans.id'
                    )
                    ->addSelect(
                        'list_pelanggarans.*',
                        'kategori_pelanggarans.kategori as kategori_label',
                        'kategori_pelanggarans.nama_pelanggaran as kategori_name',
                        'kategori_pelanggarans.poin as kategori_point',
                        'kategori_pelanggarans.deskripsi as kategori_desc'
                    );
                } else {
                    $query->select('list_pelanggarans.*');
                }

                if ($start && $end) {
                    $query->whereBetween('list_pelanggarans.created_at', [$start, $end]);
                }

                $hasilAll = $query->get();

                if ($hasilAll->isEmpty()) {
                    $message = "Siswa ini tidak melakukan pelanggaran pada rentang waktu tersebut.";
                }

                $hasilTotal->total_pelanggaran = $hasilAll->count();
                $hasilTotal->total_point = $hasilAll->sum(function ($item) {
                    return $item->kategori_point ?? $item->poin ?? $item->point ?? 0;
                });
            } else {
                $message = "Siswa / Kelas dengan kata kunci '{$keyword}' tidak ditemukan.";
            }
        }

        return view('admin.laporan.index', compact(
            'hasilOne',
            'hasilAll',
            'hasilTotal',
            'awal',
            'akhir',
            'keyword',
            'message'
        ));
    }

    /**
     * Export laporan ke PDF ukuran A4
     */
    public function exportPdf(Request $request)
    {
        // Ambil data sama seperti index()
        $data = $this->index($request)->getData();

        $pdf = Pdf::loadView('admin.laporan.pdf', (array) $data)
            ->setPaper('A4', 'portrait');

        return $pdf->stream('laporan_pelanggaran.pdf');
    }
}
