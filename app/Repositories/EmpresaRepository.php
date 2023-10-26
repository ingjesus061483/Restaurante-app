<?php
namespace App\Repositories;
use App\Contracts\IRepository;
use App\Models\Empresa;
use App\Repositories\FileRepository;
use Exception;
class EmpresaRepository implements IRepository{
    protected FileRepository $_filerepository;
    public function __construct(FileRepository $fileRepository) {
        $this->_filerepository = $fileRepository;
    }    
    public function GetAll()
    {
        return  Empresa::all();
    } 
    public function Find($id)
    {
        return Empresa::find($id);
    }
    public function Store($request)
    {
        $nit=$request->input('nit');
        $nombre =$request->input('nombre');  
        $nombreimagen=$this->_filerepository-> getImage($request, $nit.'_'.$nombre);
        $empresa=new Empresa();
        $empresa->nit=$request->input('nit');
        $empresa->nombre=$request->input('nombre');
        $empresa->camara_de_comercio=$request->input('camara_de_comercio');
        $empresa->direccion=$request->input('direccion');
        $empresa->telefono=$request->input('telefono');
        $empresa->email=$request->input('email');
        $empresa->contacto=$request->input('contacto');
        $empresa->logo=$nombreimagen;
        $empresa->slogan=$request->input('slogan');
        $empresa->tipo_regimen_id=$request->input('tipo_regimen');
        $empresa->save();
    } 
    public function Update($id, $request)
    {
        $nit=$request->input('nit');
        $nombre =$request->input('nombre');  
        $nombreimagen=$this->_filerepository-> getImage($request, $nit.'_'.$nombre);
        $empresa= $this->Find($id);
        $empresa->nit=$request->input('nit');
        $empresa->nombre=$request->input('nombre');
        $empresa->camara_de_comercio=$request->input('camara_de_comercio');
        $empresa->direccion=$request->input('direccion');
        $empresa->telefono=$request->input('telefono');
        $empresa->email=$request->input('email');
        $empresa->contacto=$request->input('contacto');
        $empresa->logo=$nombreimagen!=null?$nombreimagen:$empresa->logo;
        $empresa->slogan=$request->input('slogan');
        $empresa->tipo_regimen_id=$request->input('tipo_regimen');
        $empresa->save();
    }
    public function Delete($id)
    {
        $empresa=Empresa::find($id);
        $users=$empresa->usuarios;
        if(count($users)>0){
            throw new Exception("No se puede eliminar esta empresa ,ya posee muchos empleados");
        }
        $empresa->delete();        
    }
}