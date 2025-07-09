<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DistZakatFitrah extends Model
{
    use HasFactory;
    
    protected $table = 'dist_zakat_fitrah';

    protected $fillable = [
        'tanggal_penerimaan',
        'nama_mustahik',
        'alamat',
        'tipe_zakat_fitrah_id',
        'jumlah_makanan_pokok',
        'jumlah_uang',
        'keterangan',
    ];

    public function tipeZakatFitrah()
    {
        return $this->belongsTo(TipeZakatFitrah::class, 'tipe_zakat_fitrah_id');
    }
}
