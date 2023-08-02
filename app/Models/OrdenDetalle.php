<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdenDetalle extends Model
{
    use HasFactory;
    public function producto(){
        return $this->belongsTo(Producto::class,'producto_id');
    }
    public function orden_encabezado(){
        return $this->belongsTo(OrdenEncabezado::class,'orden_encabezado_id');
    }
}
