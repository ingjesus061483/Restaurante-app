<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;
    public function orden_encabezado(){
        return $this->belongsTo(OrdenEncabezado::class,'orden_id');
    }
    public function pago_detalle(){
        return $this->hasMany(PagoDetalle::class,'pago_id');
    }
    protected $fillable=[
        'codigo','fecha_hora', 'subtotal','impuesto','descuento','total_pagar',
        'recibido','cambio',  'observaciones','orden_id'
    ];
}
