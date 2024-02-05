<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rules\Password;
class UserController extends Controller
{
    protected UserRepository $_userRepository; 
    public function __construct(UserRepository $userRepoitory,)
    {
        $this->_userRepository=$userRepoitory;       
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
        $users=$this->_userRepository->UsersAdmin();              
        $data=[            
            'msg'=>'La operacion ha sido realizada con exito'        
        ];
            return json_encode($data);
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('User.edit');
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validation=$request->validate([  
            'current_password'=>['required',Password::default()],          
            'password'=>['required','confirmed',Password::default()],            
        ]);
        if(!Auth::validate(['email'=>$request->input('user_email'),
        'password'=>$request->input('current_password')])){
        //     return redirect()->to('/login')->withErrors('auth.failed');
        return back()->withErrors('auth.failed');
        }
        //$user =Auth::getProvider()->retrieveByCredentials(['email'=>$request->input('email'),
        //'password'=>$request->input('password')]);
        $user=User::find($id);
        $user->password=Hash::make($request->input('password'));
        $user->save();
        session::flush();
        Auth::logout();
        return redirect()->to('/login');    
        //print_r( $request->all());
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
