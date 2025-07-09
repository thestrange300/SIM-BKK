<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Testing\Fluent\Concerns\Has;

class DistDagingQurban extends Model
{
    use HasFactory;
    
    public $table = 'dist_daging_qurban';

    protected $fillable = [
        'tanggal_penerimaan',
        'nama_penerima',
        'alamat',
        'jumlah',
        'keterangan',
        'tipe_daging_qurban'
    ];

    protected $casts = [
        'tipe_daging_qurban' => 'array'
    ];

    public function tipeDagingQurban()
    {
        return $this->belongsToMany(TipeDagingQurban::class, 'dist_daging_qurban_tipe');
    }
}
