<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Keuangan extends Model
{
    use HasFactory, Notifiable, SoftDeletes;

        use HasFactory;

    protected $table = 'keuangan';

    protected $fillable = [
        'tanggal',
        'deskripsi',
        'jumlah',
        'jenis',
        'tipe_id',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tipe()
    {
        if ($this->jenis === 'pemasukan') {
            return $this->belongsTo(\App\Models\TipePemasukan::class, 'tipe_id');
        } else {
            return $this->belongsTo(\App\Models\TipePengeluaran::class, 'tipe_id');
        }
    }
}
