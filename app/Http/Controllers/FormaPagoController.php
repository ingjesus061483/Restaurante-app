<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\AutorizeRequest;
use App\Repositories\FormaPagoRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FormaPagoController extends Controller
{
    protected FormaPagoRepository $_formapagoRepository;
    public function __construct(FormaPagoRepository $formaPagoRepository) {
        $this->_formapagoRepository = $formaPagoRepository;
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
            'formapagos'=>$this->_formapagoRepository->GetAll()
        ];
        return view('FormaPago.index',$data);
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(AutorizeRequest $request)
    {
        if(!Auth::check())
        {
            return redirect()->to('login');
        }  
        return view('FormaPago.create'); 
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {  if(!Auth::check())
        {
            return redirect()->to('login');
        }
        if(!$this-> autorizar(Auth::user()))
        {
            return back();            
        }     
        $validacion=$request->validate(['nombre'=>'required|max:50']);
        $this->_formapagoRepository->Store((object)$request->all());
        return redirect()->to(url('/formapagos'));  
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AutorizeRequest $request, string $id)
    {
        if(!Auth::check())
        {
            return redirect()->to('login');
        }
        $formapago=$this->_formapagoRepository->Find($id);
        $data=[    
            'formapago'=>$formapago
        ];
        return view('FormaPago.edit',$data);
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if(!Auth::check())
        {
            return redirect()->to('login');
        }
        if(!$this-> autorizar(Auth::user()))
        {
            return back();            
        }     
        $validacion=$request->validate(['nombre'=>'required|max:50']);
        $this->_formapagoRepository->Update($id,(object)$request->all());
        return redirect()->to(url('/formapagos'));       
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AutorizeRequest $request, string $id)
    {
        if(!Auth::check())
        {
            return redirect()->to('login');
        }
        $this->_formapagoRepository->Delete($id);
        return redirect()->to(url('/formapagos'));    
        //
    }
}
