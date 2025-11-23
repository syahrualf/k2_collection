<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Produk extends Model
{
     protected $table = 'produk';
    use HasFactory;

    protected $fillable = [
        'kategori_id',
        'nama',
        'slug',
        'harga',
        'foto',
        'detail',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

   
}
