<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Studio extends Model
{
    use HasFactory;

    protected $table = 'studio';

    protected $fillable = ['studio'];

    public function kursi()
    {
        return $this->hasMany(Kursi::class,'id_studio','id');
    }
    public function order()
    {
        return $this->hasMany(Order::class,'id_studio','id');
    }
    public function studio()
    {
        return $this->hasMany(Studio::class,'id_studios','id');
    }
}
