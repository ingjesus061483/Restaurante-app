<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MateriaPrima extends Model
{
    use HasFactory;
    public function categoria(){
        return $this->belongsTo(Categoria::class,'categoria_id');
     }
     public function unidad_medida(){
         return $this->belongsTo(UnidadMedida::class,'unidad_medida_id');
     }
     public function existencias(){
         return $this->hasMany(Existencia::class,'materia_prima_id');
     }
     public function preparacion(){
        return $this->hasMany(Preparacion::class,'materia_prima_id');
    }
  
     protected $fillable=[
                            'codigo','nombre','descripcion',
                            'costo_unitario','imagen',
                            'unidad_medida_id','categoria_id',
                         ];
 
}
