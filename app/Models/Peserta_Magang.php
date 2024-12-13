<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peserta_Magang extends Model
{
    use HasFactory;

    protected $table = 'peserta_magang';
    protected $primaryKey = 'id_peserta';

    protected $fillable = [
        'id_instansi',
        'nama',
        'nim_nisn',
        'tanggal_lahir',
        'jenis_kelamin',
        'alamat',
        'no_hp',
        'email',
        'asal_instansi',
        'jurusan',
        'berkas',
    ];

    // Relasi ke tabel instansi
    public function instansi()
    {
        return $this->belongsTo(Instansi::class, 'id_instansi');
    }
}
