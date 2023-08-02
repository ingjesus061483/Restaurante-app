<?php
namespace App\Repositories;

use App\Contracts\IRepository;
use App\Models\FormaPago;

class FormaPagoRepository implements IRepository{
    public function GetAll()
    {
        return FormaPago::all();
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
