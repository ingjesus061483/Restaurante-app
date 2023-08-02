<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdenEncabezado extends Model
{
    use HasFactory;
    public function cabaña(){
        return $this->belongsTo(Cabaña::class,'cabaña_id');
    }
    public function cliente(){
        return $this->belongsTo(cliente::class,'cliente_id');
    }
    public function empleado(){
        return  $this->belongsTo(Empleado::class,'empleado_id');
    }
    public function estado(){
        return $this->belongsTo(Estado::class,'estado_id');        
    }
    public function orden_detalles(){
        return $this->hasMany(OrdenDetalle::class,'orden_encabezado_id');
    }
    protected $fillable=[
        'codigo','tipo_documento_id','fecha','hora','hora_entrega','observaciones','total',
        'cabaña_id','cliente_id','empleado_id','estado_id',
    ];
}
