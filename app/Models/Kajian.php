<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kajian extends Model
{
    protected $table = 'kajian';

    protected $fillable = [
        'tanggal',
        'waktu_mulai',
        'waktu_selesai',
        'tema',
        'catatan',
        'penceramah_id',
    ];

    public function penceramah()
    {
        return $this->belongsTo(PetugasKeagamaan::class, 'penceramah_id');
    }
}
