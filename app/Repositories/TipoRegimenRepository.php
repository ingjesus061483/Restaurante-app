<?php
namespace App\Repositories;

use App\Contracts\IRepository;
use App\Models\TipoRegimen;

class TipoRegimenRepository implements IRepository{
    public function GetAll()
    {
        return  TipoRegimen::all();
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