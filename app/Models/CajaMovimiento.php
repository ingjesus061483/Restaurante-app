<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CajaMovimiento extends Model
{
    use HasFactory;
    public function caja()
    {
        return $this->belongsTo(caja::class,'caja_id');
    }
}
