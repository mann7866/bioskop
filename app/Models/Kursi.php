<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kursi extends Model
{
    use HasFactory;
    protected $table = 'kursi';
    protected $fillable = ['id_studio', 'kursi'];

    public function studio()
    {
        return $this->belongsTo(Studio::class,'id_studio','id');
    }
    public function kursi()
    {
        return $this->hasMany(Kursi::class);
    }
    
}
