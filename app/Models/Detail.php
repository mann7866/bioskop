<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    use HasFactory;

    protected $table = 'detail';
    protected $guarded = [];

    public function genres()
    {
        return $this->belongsToMany(genre::class, 'genre_detail', 'id_detail','id_genre');
    }
}
    