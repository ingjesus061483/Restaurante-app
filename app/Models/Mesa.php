<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mesa extends Model
{
    use HasFactory;
    public function ordens(){
        return $this->hasMany(OrdenEncabezado::class,'mesa_id');
    }
    public function dependencia()
    {
        return $this->belongsTo(Dependencia::class,'dependencia_id');
    }

}
