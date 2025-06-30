<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipeInventaris extends Model
{
    protected $table = 'tipe_inventaris';

    protected $fillable = [
        'nama',
        'deskripsi',
    ];

    public function dataInventaris()
    {
        return $this->hasMany(DataInventaris::class, 'tipe_inventaris_id');
    }
}
