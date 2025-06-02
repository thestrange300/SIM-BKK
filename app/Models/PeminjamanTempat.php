<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PeminjamanTempat extends Model
{
    protected $table = 'peminjaman_tempat';

    protected $fillable = [
        'nama_peminjam',
        'kontak',
        'tanggal',
        'waktu_mulai',
        'waktu_selesai',
        'tipe_peminjaman_id',
        'keterangan',
    ];

    public function tipePeminjaman()
    {
        return $this->belongsTo(TipePeminjaman::class, 'tipe_peminjaman_id');
    }
}
