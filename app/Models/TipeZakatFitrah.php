<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipeZakatFitrah extends Model
{
    protected $table = 'tipe_zakat_fitrah';

    protected $fillable = [
        'nama',
        'deskripsi',
    ];

    public function penZakatFitrah()
    {
        return $this->hasMany(PenZakatFitrah::class, 'tipe_zakat_fitrah_id');
    }

    public function distZakatFitrah()
    {
        return $this->hasMany(DistZakatFitrah::class, 'tipe_zakat_fitrah_id');
    }
}
