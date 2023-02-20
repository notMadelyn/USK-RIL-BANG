<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    protected $fillable = ['judul', 'kategori_id', 'penerbit_id', 'pengarang', 'tahun_terbit', 'photo', 'isbn', 'j_buku_baik', 'j_buku_buruk'];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function penerbit()
    {
        return $this->belongsTo(Penerbit::class);
    }

    public function peminjaman()
    {
        return $this->hasOne(Peminjaman::class);
    }
    public function pemberitahuans()
    {
        return $this->hasMany(Pemberitahuan::class);
    }
}
