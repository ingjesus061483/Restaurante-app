<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoCobro extends Model
{
    use HasFactory;
    public function CuentaCobrar(){
        return $this->hasMany(CuentasCobrar::class,'tipo_cobro_id');        
    }
}
