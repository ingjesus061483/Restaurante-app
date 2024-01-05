<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Repositories\CabanaRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use League\CommonMark\Extension\SmartPunct\EllipsesParser;

class HomeController extends Controller
{
    protected CabanaRepository $_cabanaRepository;
    public function __construct(CabanaRepository $cabanaRepository) 
    {
        $this->_cabanaRepository = $cabanaRepository;
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
        $cabanas=$this->_cabanaRepository->GetCabanasDesocupadas();
        $data=["cabanas"=>$cabanas];
        return view('Home.index',$data);
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if(!Auth::check())
        {
            return redirect()->to('login');
        }    
        $cabana =$this->_cabanaRepository->Find($id);
        session(['cabana' => $cabana]);   
        if (session()->has('detalles'))
        {
          return  redirect()->to('ordendetalles');
        }    
        else
        {
            return redirect()->to(url('/ordendetalles/create'));        
        }
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
