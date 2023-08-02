<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;
    public function usuario(){
        return  $this->belongsTo(User::class,'user_id');
      }
    public function ordens(){
        return $this->hasMany(OrdenEncabezado::class,'cliente_id');
    }
    public function facturas(){
        return $this->hasMany(FacturaEncabezado::class,'cliente_id');
    } 
  
}

