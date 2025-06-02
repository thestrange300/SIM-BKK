<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipePeminjaman extends Model
{
    protected $table = 'tipe_peminjaman';

    protected $fillable = [
        'nama',
        'deskripsi',
    ];

    public function peminjamanTempat()
    {
        return $this->hasMany(PeminjamanTempat::class, 'tipe_peminjaman_id');
    }
}
