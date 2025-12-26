<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListPelanggaran extends Model
{
    use HasFactory;

    protected $table = 'list_pelanggarans';

    protected $fillable = [
        'siswa_id',
        'nisn',
        'nama_siswa',
        'kelas',
        'note',
        'pelapor',
        'kategori_pelanggaran_id',
    ];

    /**
     * Relasi ke tabel siswa
     */
    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    /**
     * Relasi ke kategori pelanggaran
     */
    public function kategoriPelanggaran()
    {
        return $this->belongsTo(KategoriPelanggaran::class, 'kategori_pelanggaran_id');
    }
}
