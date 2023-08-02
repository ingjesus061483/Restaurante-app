<?php
namespace App\Contracts;
interface IFileRepository{
    public function GetImage($request,$nombre);
    public function GetPdf($view,$data );
}