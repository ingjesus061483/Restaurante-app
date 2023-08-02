<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoDocumento extends Model
{
    use HasFactory;
    public function facturas(){
        return $this->hasMany(FacturaEncabezado::class,'tipo_documento_id');
    }
    
}