<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class FacturaEncabezado extends Model
{
    use HasFactory;
    public function factura_detalles(){
       return $this->hasMany(FacturaDetalle::class,'factura_id');
    }
    public function cliente(){
        return $this->belongsTo(Cliente::class,'cliente_id');
    }
    public function cabaña(){
        return $this->belongsTo(Cabaña::class,'cabaña_id');
    }
    public function empleado(){
        return $this->belongsTo(Empleado::class,'empleado_id');
    }
    public function forma_pago(){
        return $this->belongsTo(FormaPago::class,'forma_pago_id');        
    }
    public function tipo_documento(){
        return $this->belongsTo(TipoDocumento::class ,'tipo_documento_id');
    }
}
