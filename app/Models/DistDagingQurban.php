<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DistDagingQurban extends Model
{
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
