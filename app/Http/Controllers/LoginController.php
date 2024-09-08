<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rules\Password;
class LoginController extends Controller
{
    protected UserRepository $_userRepository;
    public function  __construct(UserRepository $userRepository) {
        $this->_userRepository = $userRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
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
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required',Password::default()],
        ]);
        if(!$this->_userRepository->Login($request))
        {
            return redirect()->to('/login')->withErrors('Auth.failed');
        }        
        return redirect()->to('/');      
        //
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        if(Auth::check()){
            return redirect()->to('/');
        }
        return view('Auth.login');
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
        $this->_userRepository->Logout();    
        return redirect()->to('/login');    
        //
    }
}
