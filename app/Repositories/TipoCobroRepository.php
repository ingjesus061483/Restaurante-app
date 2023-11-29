<?php
namespace App\Repositories;

use App\Contracts\IRepository;
use App\Models\TipoCobro;

class TipoCobroRepository implements IRepository
{
    public function GetAll()
    {
       return  TipoCobro::all();
    }
    public function Find($id)
    {
        
    }
    public function Store($request)
    {
        
    }
    public function  Update($id, $request)
    {
        
    }
    public function Delete($id)
    {
        
    }
}