<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'siswa';

    protected $fillable = [
        'nis',
        'nama',
        'kelas',
        'jurusan',
    ];

    /**
     * Relasi ke pelanggaran
     */
    public function pelanggaran()
    {
        return $this->hasMany(ListPelanggaran::class, 'siswa_id');
    }
}
