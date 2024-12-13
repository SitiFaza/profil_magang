<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instansi extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'instansi';

    // Primary key dari tabel
    protected $primaryKey = 'id_instansi';

    // Kolom yang dapat diisi (fillable)
    protected $fillable = [
        'nama_instansi',
        'alamat',
        'email',
    ];

    // Menentukan apakah tabel menggunakan timestamps (created_at, updated_at)
    public $timestamps = true;
}
