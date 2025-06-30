<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipeDagingQurban extends Model
{
    protected $table = 'tipe_daging_qurban';

    protected $fillable = [
        'nama',
        'deskripsi',
    ];
}
