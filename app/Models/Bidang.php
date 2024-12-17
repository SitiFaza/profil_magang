<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bidang extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'bidang';

    // Primary key dari tabel
    protected $primaryKey = 'id_bidang';

    // Kolom yang dapat diisi (fillable)
    protected $fillable = [
        'nama_bidang',
        'deskripsi',
    ];

    // Menentukan apakah tabel menggunakan timestamps (created_at, updated_at)
    public $timestamps = true;
}
