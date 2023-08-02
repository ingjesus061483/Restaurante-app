<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;
    public function tipo_regimen(){
        return $this->belongsTo(TipoRegimen::class,'tipo_regimen_id');
    }
    public function usuarios()
    {
        return $this->hasMany(User::class,'empresa_id');
    }
}
