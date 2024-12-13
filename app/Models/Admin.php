<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;

    // Nama tabel di database
    protected $table = 'admin';

    // Primary key dari tabel
    protected $primaryKey = 'id_admin';

    // Kolom yang dapat diisi (fillable)
    protected $fillable = [
        'nama',
        'username',
        'password',
        'email',
    ];

    // Kolom yang disembunyikan saat serialisasi
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Atur default nilai atribut timestamps (jika tabel menggunakan timestamps)
    public $timestamps = true;

    /**
     * Setter untuk hashing password saat disimpan
     *
     * @param string $value
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }
}
