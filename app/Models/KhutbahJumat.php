<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KhutbahJumat extends Model
{
    protected $table = 'khutbah_jumat';

    protected $fillable = [
        'tanggal',
        'judul',
        'catatan',
        'imam_id',
        'khotib_id',
        'tempat',
    ];

    public function khotib()
    {
        return $this->belongsTo(PetugasKeagamaan::class, 'khotib_id');
    }
    public function imam()
    {
        return $this->belongsTo(PetugasKeagamaan::class, 'imam_id');
    }
}
