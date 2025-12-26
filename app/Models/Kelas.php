<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas'; // nama tabel kelas di database
    protected $primaryKey = 'id';
    protected $fillable = ['class_name', 'sub_class', 'wali_name'];

    public $timestamps = false; // sesuaikan dengan tabel
}
