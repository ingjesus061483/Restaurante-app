<?php
namespace App\Repositories;

use App\Contracts\IFileRepository;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Str;
class FileRepository implements IFileRepository{
    public function getImage($request,$nombre){
        $nombreimagen=null;
        if($request->hasFile('imagen'))     
        {
            $imagen=$request->file('imagen');
            $nombreimagen=Str::slug($nombre).".".$imagen->guessExtension();
            if (!file_exists('img'))
            {
                 mkdir("img");
            } 
            $ruta=public_path("img/");
            if(file_exists($ruta.$nombreimagen))
            {
                unlink($ruta.$nombreimagen);
            }            
            copy($imagen->getRealPath(),$ruta.$nombreimagen);
        }
        return $nombreimagen;
    }
    public function GetPdf($view,$data ){        
        $pdf=Pdf::loadView($view,$data);        
        return $pdf->stream();
    }
}