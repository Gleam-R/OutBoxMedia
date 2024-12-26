<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kategori extends Model
{
    use HasFactory;

    protected $table = 'kategoris';

    protected $fillable = [
        'nama_kategori',
    ];

    //untuk pivot tabel
    public function beritas()
    {
        return $this->belongsToMany(beritas::class, 'berita_category', 'category_id', 'berita_id');
    }
}
