<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemberitahuan extends Model
{
    use HasFactory;

    protected $fillable = ['isi', 'level_user', 'status', 'kategori_id', 'buku_id'];

    public function buku()
    {
        return $this->belongsTo(Buku::class);
    }
    public function kategori()
    {
        return $this->belongsTo(Buku::class);
    }
}