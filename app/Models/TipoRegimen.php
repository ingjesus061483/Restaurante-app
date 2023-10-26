<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoRegimen extends Model
{    
    use HasFactory;
    public function empresas(){
        return $this->hasMany(Empresa::class,'tipo_regimen_id');        
    }
}
