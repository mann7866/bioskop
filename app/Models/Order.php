<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'order';
    protected $guarded = [] ;

    public function detail()
    {
        return $this->belongsTo(Detail::class, 'id_detail', 'id');
    }
    public function studio()
    {
        return $this->belongsTo(Studio::class,'id_studio','id');
    }
    public function kursi()
    {
        return $this->belongsTo(Kursi::class, 'id_studios', 'id');
    }

}
