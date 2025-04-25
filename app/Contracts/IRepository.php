<?php
namespace App\Contracts;
interface IRepository
{
     /**
     * Devuelve todos los registros de una tabla determinada .
     *
     * @return array
     */   
    function GetAll();

    /**
     * Almacena un registro en una tabla determinada.
     *
     * @param  mixed  $request
     * @return void
     */
    function Store($request);

    /**
     * Devuelve un registro de una tabla determinada.
     *
     * @param  int  $id
     * @return mixed
     */
    function Find($id);

    /**
     * Actualiza un registro de una tabla determinada.
     *
     * @param  int  $id
     * @param  mixed  $request
     * @return void
     */
    function Update($id,$request);

    /**
     * Elimina un registro de una tabla determinada.
     *
     * @param  int  $id
     * @return void
     */
    function Delete($id);
}