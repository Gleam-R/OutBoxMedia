<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class beritas extends Model
{
    use HasFactory;

    protected $table = 'beritas';

    protected $fillable = [
        'judul',
        'isi',
        'gambar',
        'penulis_id',
    ];

    //tiap berita itu ada banyak komentar
    public function komentar()
    {
        return $this->hasMany(komentar::class,'berita_id','id');
    }

    //tiap berita juga ada banyak rating
    public function rating()
    {
        return $this->hasMany(ratings::class,'berita_id','id');
    }

    //tiap berita hanya ada 1 penulis
    public function penulis()
    {
        return $this->belongsTo(User::class, 'penulis_id', 'user_id');
    }

    //untuk pivot tabel
    public function kategori()
    {
        return $this->belongsToMany(kategori::class, 'berita_category', 'berita_id', 'category_id');
    }
}
