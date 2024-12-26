<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ratings extends Model
{
    use HasFactory;

    protected $table = 'ratings';

    protected $fillable = [
        'berita_id',
        'user_id',
        'rating',
    ];

    public function berita()
    {
        return $this->belongsTo(beritas::class, 'berita_id','id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
