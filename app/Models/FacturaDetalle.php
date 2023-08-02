<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacturaDetalle extends Model
{
    use HasFactory;
    public function factura(){
        return $this->belongsTo(FacturaEncabezado::class,'factura_id');;
    }
}
