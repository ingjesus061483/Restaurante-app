<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Preparacion extends Model
{
    public function producto(){
        return $this->belongsTo(Producto::class,'producto_id');
    }

    public function materia_prima(){
        return $this->belongsTo(MateriaPrima::class,'materia_prima_id');
    }
    use HasFactory;
}
