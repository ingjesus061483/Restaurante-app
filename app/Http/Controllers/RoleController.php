<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Repositories\RoleRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
    protected RoleRepository $_repository;
    public function __construct(RoleRepository $repository) {
        $this->_repository = $repository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(!Auth::check())
        {
            return redirect()->to('login');
        }        
        $data=[          
            'roles'=> $this->_repository->GetAll()
        ];
        return view ('Role.index',$data);
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(!Auth::check())
        {
            return redirect()->to('login');
        }        
        return view ('Role.create');
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(!Auth::check())
        {
            return redirect()->to('login');
        }        
        $validacion=$request->validate(['nombre'=>'required|max:50']);
        $this->_repository->Store((object)$request->all());        
        return redirect()->to(url('/roles'));       
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        if(!Auth::check())
        {
            return redirect()->to('login');
        }        
        $data=[            
            'role'=>$this->_repository->Find($id)
        ];
        return view ('Role.edit',$data);
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        if(!Auth::check())
        {
            return redirect()->to('login');
        }        
        $this->_repository->Update($id , (object)$request->all());
        return redirect()->to(url('/roles'));       
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        if(!Auth::check())
        {
            return redirect()->to('login');
        }        
        $this->_repository->delete($id);
        return redirect()->to(url('/roles'));       
        //
    }
}
