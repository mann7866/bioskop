<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'order';
    protected $guarded = [] ;

    public function details()
    {
        return $this->belongsTo(Detail::class, 'detail_id');
    }

}
