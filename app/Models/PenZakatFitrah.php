<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenZakatFitrah extends Model
{
    use HasFactory;
    
    protected $table = 'pen_zakat_fitrah';

    protected $fillable = [
        'tanggal_penerimaan',
        'nama_muzakki',
        'alamat',
        'tipe_zakat_fitrah_id',
        'jumlah_makanan_pokok',
        'jumlah_uang',
        'keterangan',
    ];

    protected $casts = [
        'tanggal_penerimaan' => 'date',
    ];

    public function tipeZakatFitrah()
    {
        return $this->belongsTo(TipeZakatFitrah::class, 'tipe_zakat_fitrah_id');
    }
}
