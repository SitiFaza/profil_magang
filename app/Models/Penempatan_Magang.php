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
    protected $primaryKey = 'id_penempatan';

    // Kolom yang dapat diisi (fillable)
    protected $fillable = [
        'id_peserta',
        'id_bidang',
        'tanggal_mulai',
        'tanggal_selesai',
        'keterangan',
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

    protected static function booted()
    {
        static::saving(function ($model) {
            if ($model->tanggal_mulai > $model->tanggal_selesai) {
                throw new \Exception("Tanggal selesai harus setelah tanggal mulai.");
            }
        });
    }
}
