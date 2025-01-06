<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peserta_Magang extends Model
{
    use HasFactory;

    protected $table = 'peserta_magang';
    protected $primaryKey = 'id_peserta';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'id_instansi',
        'nama',
        'nomor_induk',
        'tanggal_lahir',
        'jenis_kelamin',
        'alamat',
        'no_hp',
        'email',
        'jurusan',
        'berkas',
        'status',
    ];

    public function getBerkasUrlAttribute()
    {
        $berkasUrl = $this->berkas 
            ? asset('storage/' . $this->berkas) 
            : null;
        
        
        return $berkasUrl;
    }


    // Relasi ke tabel instansi
    public function instansi()
    {
        return $this->belongsTo(Instansi::class, 'id_instansi');
    }

    public function penempatan_magang()
    {
        return $this->hasOne(Penempatan_Magang::class, 'id_peserta', 'id_peserta');
    }

}

