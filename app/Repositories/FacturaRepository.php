<?php
namespace App\Repositories;

use App\Contracts\IRepository;
use App\Models\FacturaEncabezado;

class FacturaRepository implements IRepository{

    protected ImpuestoRepository $_impuestoRepository;
    public function __construct(ImpuestoRepository $impuestoRepository ) {
        $this->_impuestoRepository = $impuestoRepository;
    }
    public function CalcularImpuestos($subtotal)
    {
        $impuestos =$this->_impuestoRepository->GetAll();
        $sum=0;
        foreach($impuestos as $item){
            $impuesto=$subtotal*($item->valor/100);
            $sum=$sum+$impuesto;
        }
        return $sum;
    }
    public function GetAll()
    {
        return FacturaEncabezado::all();
    }
    public function Find($id)
    {
        return FacturaEncabezado::find($id);
    }
    public function Store($request)
    {
        
    }
    public function Update($id, $request)
    {

    }
    public function Delete($id)
    {

    }
}



