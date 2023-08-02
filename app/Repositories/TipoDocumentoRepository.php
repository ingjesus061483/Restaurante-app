<?php
namespace App\Repositories;

use App\Contracts\IRepository;
use App\Models\TipoDocumento;


class TipoDocumentoRepository implements IRepository{
    public function GetAll()
    {
        return  TipoDocumento::all();
    } 
    public function Find($id)
    {
        
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