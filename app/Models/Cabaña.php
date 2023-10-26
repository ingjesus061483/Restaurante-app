<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cabaña extends Model
{
    use HasFactory;
    public function ordens(){
        return $this->hasMany(OrdenEncabezado::class,'cabaña_id');
    }        
    public function factura_detalles(){
        return $this->hasMany(FacturaDetalle::class,'cabaña_id');
    } 
}