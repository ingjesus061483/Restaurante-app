<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CuentasCobrar extends Model
{
    use HasFactory;
    public function OrdenEncabezado(){
        return $this->belongsTo(OrdenEncabezado::class,'orden_id');        
    }  
    
    public function DetalleCuentaCobrar(){
        return $this->hasMany(CuentasCobrarDetalles::class,'cuenta_cobrar_id');        
    }
    public function TipoCobro(){
        return $this->belongsTo(TipoCobro::class,'tipo_cobro_id');        
    } 
    protected $fillable=['fecha','tiempo','monto','interes','orden_id','tipo_cobro_id'];
      

}
