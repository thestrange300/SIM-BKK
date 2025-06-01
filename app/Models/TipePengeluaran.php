<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipePengeluaran extends Model
{
    protected $table = 'tipe_pengeluaran';

    protected $fillable = [
        'nama',
    ];

    public function keuangan()
    {
        return $this->hasMany(Keuangan::class, 'tipe_id');
    }
}
