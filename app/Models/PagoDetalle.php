<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PagoDetalle extends Model
{
    use HasFactory;
    public function pagos()
    {
       return $this->belongsTo(Pago::class,'pago_id');
    }
    public function forma_pago()
    {
      return  $this->belongsTo(FormaPago::class,'forma_pago_id');
    }
}
