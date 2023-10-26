<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caja extends Model
{
    use HasFactory;
    public function usuarios(){
      return  $this->hasMany(User::class,'caja_id');
    }
    public function movimientos()
    {
      return $this->hasMany(CajaMovimiento::class,'caja_id');


    }
    protected $fillable=[
        'codigo','nombre','valor_inicial','abierta','descripcion'
    ];
}
