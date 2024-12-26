<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class komentar extends Model
{
    use HasFactory;

    protected $table = 'komentars';

    protected $fillable = [
        'berita_id',
        'user_id',
        'komentar',
    ];

    public function berita()
    {
        return $this->belongsTo(beritas::class, 'berita_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
