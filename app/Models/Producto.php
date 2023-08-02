<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;
    public function existencias(){
        return $this->hasMany(Existencia::class,'producto_id');
    }
  
    public function categoria(){
       return $this->belongsTo(Categoria::class,'categoria_id');
    }
    public function unidad_medida(){
        return $this->belongsTo(UnidadMedida::class,'unidad_medida_id');    
    }
    public function factura_detalles(){
        return $this->hasMany(FacturaDetalle::class,'producto_id');
    } 
    public function preparacions(){
        return $this->hasMany(Preparacion::class,'producto_id');
    }
    public function orden_detalles()
    {
        return $this->hasMany(OrdenDetalle::class,'producto_id');
    }
    protected $fillable=[  'codigo','nombre','preparacion',
                           'costo_unitario','precio','descripcion',
                           'foraneo','imagen','unidad_medida_id',
                           'categoria_id','materia_prima','tiempo_coccion'];


}
