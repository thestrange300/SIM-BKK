<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataHewan extends Model
{
    public $table = 'data_hewan';

    protected $fillable = [
        'id_hewan',
        'jenis_hewan',
        'berat',
        'tanggal',
        'deskripsi',
    ];

    
}
