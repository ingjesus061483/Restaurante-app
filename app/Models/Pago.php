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
    public function forma_pago(){
        return $this->belongsTo(FormaPago::class,'forma_pago_id');
    }
}
