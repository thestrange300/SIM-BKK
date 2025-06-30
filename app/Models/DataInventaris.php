<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataInventaris extends Model
{
    protected $table = 'data_inventaris';

    protected $fillable = [
        'kode_barang',
        'nama_barang',
        'serial_number',
        'jumlah',
        'tipe_inventaris_id',
        'kategori',
        'lokasi',
        'kondisi',
        'keterangan',
    ];

    public function tipeInventaris()
    {
        return $this->belongsTo(TipeInventaris::class, 'tipe_inventaris_id');
    }
}
