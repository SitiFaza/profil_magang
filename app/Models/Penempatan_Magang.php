<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penempatan_Magang extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'penempatan_magang';

    // Primary key dari tabel
    protected $primaryKey = 'id';

    // Kolom yang dapat diisi (fillable)
    protected $fillable = [
        'id_peserta',
        'id_bidang',
        'tanggal_mulai',
        'tanggal_selesai',
        'status',
        '',
    ];

    // Menentukan apakah tabel menggunakan timestamps
    public $timestamps = true;

    // Relasi dengan model PesertaMagang
    public function peserta()
    {
        return $this->belongsTo(peserta_magang::class, 'id_peserta', 'id_peserta');
    }

    // Relasi dengan model Bidang
    public function bidang()
    {
        return $this->belongsTo(Bidang::class, 'id_bidang', 'id_bidang');
    }
}
