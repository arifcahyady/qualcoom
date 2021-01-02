<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\User;

class AuthController extends Controller
{
    public function login()
    {
    	return view('auth.login');
    }

    public function postlogin(Request $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect('/dashboard');
        }

        return redirect('/login');
   
    }

     public function registerasi()
    {
    	return view('auth.registerasi');
    }

    public function postregister(Request $request)
    {
    	$request->validate([
    		'name' => 'required|string',
    		'email' => 'required|string|unique:users',
    		'password' => 'required|string|min:8',
    	]);
        
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => hash::make($request->password),
            'role' => 'admin'
        ]);

        
       return redirect('/login');
    }
    
    public function logout()
      {
        if (Auth::check()) 
        {
          Auth::user()->AauthAcessToken()->delete();
        }

        return redirect('/');
      }
}
