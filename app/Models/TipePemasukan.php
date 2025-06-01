<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipePemasukan extends Model
{
    protected $table = 'tipe_pemasukan';

    protected $fillable = [
        'nama',
    ];

    public function keuangan()
    {
        return $this->hasMany(Keuangan::class, 'tipe_id');
    }
}
