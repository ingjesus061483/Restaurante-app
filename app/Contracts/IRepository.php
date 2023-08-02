<?php
namespace App\Contracts;
interface IRepository{    
    function GetAll();
    function Store($request);
    function Find($id);
    function Update($id,$request);
    function Delete($id);
}