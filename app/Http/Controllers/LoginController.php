<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
class LoginController extends Controller
{
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
            'password' => ['required'],
        ]);
        if(!Auth::validate(['email'=>$request->input('email'),
                   'password'=>$request->input('password')]))
        {
            return redirect()->to('/login')->withErrors('auth.failed');
        }
        $user =Auth::getProvider()
                    ->retrieveByCredentials([
                        'email'=>$request->input('email'),
                         'password'=>$request->input('password')
                ]);
        Auth::login($user);
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
        Session::flush();
        Auth::logout();
        return redirect()->to('/login');    
        //
    }
}
