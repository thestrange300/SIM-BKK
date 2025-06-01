<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class PetugasKeagamaan extends Model
{
    protected $table = 'petugas_keagamaan';

    protected $fillable = [
        'nama',
        'alamat',
        'kontak',
        'keterangan',
        'kategori',
    ];

    protected $casts = [
        'kategori' => 'array'
    ];

    public function khutbahJumat()
    {
        return $this->hasMany(KhutbahJumat::class, 'khotib_id');
    }

    public function imamJumat()
    {
        return $this->hasMany(KhutbahJumat::class, 'imam_id');
    }

    public function scopeImam(Builder $query): Builder
    {
        return $query->whereJsonContains('kategori', 'imam');
    }

    public function scopeKhotib(Builder $query): Builder
    {
        return $query->whereJsonContains('kategori', 'khotib');
    }

    public function scopePenceramah(Builder $query): Builder
    {
        return $query->whereJsonContains('kategori', 'penceramah');
    }
}
