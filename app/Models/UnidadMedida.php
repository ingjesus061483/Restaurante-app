<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnidadMedida extends Model
{
    use HasFactory;
    public function productos(){
        return $this->hasMany(Producto::class,'unidad_medida_id');
    }
    public function materia_primas(){
        return $this->hasMany(MateriaPrima::class,'unidad_medida_id');
    }
}
