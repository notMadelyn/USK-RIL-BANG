<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode',
        'nama'
    ];

    public function bukus()
    {
        return $this->hasMany(Buku::class);
    }
    public function pemberitahuans()
    {
        return $this->hasMany(Pemberitahuan::class);
    }
}
