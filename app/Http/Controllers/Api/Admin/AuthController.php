<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
    	$request->validate([
    		'email' => 'required',
    		'password' => 'required|string'
    	]);

    	$credentials = request(['email', 'password']);
    	// dd($credentials);

    	if (!Auth::attempt($credentials)) {
    		return response()->json([
    			'status' => 'error',
    			'message' => 'Unauthorizied'
    		], 401);
    	}

    	$admin = $request->user();
    	$tokenResult = $admin->createToken('Personal Access Token');
    	$token = $tokenResult->token;
    	$token->expires_at = Carbon::now()->addWeeks(1);
    	$token->save();

    	return response()->json([
    		'user' => Auth::user(),
    		'token' => $tokenResult->accessToken,
    		'token_type' => 'Bearer',
    		'expires_at' => Carbon::parse($tokenResult->token->expires_at)->toDateTimeString()
    	]);
    }

    public function register(Request $request)
    {
    	$request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users',
            'password' => 'required|string|min:8',
            'nomor_telepon' => 'min:11',
            'alamat' => 'min:5',
            'image' => 'mimes:jpg,jpeg,svg,png',
        ]);

    	$user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = hash::make($request->password);
            $user->role = 'admin';
            $user->nomor_telepon = $request->nomor_telepon;
            $user->alamat = $request->alamat;

            if ($request->hasFile('image')) {
            
            $request->file('image')->move('images/', $request->file('image')->getClientOriginalName());
            $profile->image = $request->file('image')->getClientOriginalName();
            
        }
        $user->save();
    	return response()->json([
    		'status' => 'success',
    		'message' => 'user has been registered'
    	], 200);
    }

    public function update(Request $request)
    {
        $user = User::where('id', Auth::id())->first();
        $user->name = $request->name;
        $user->nomor_telepon = $request->nomor_telepon;
        $user->alamat = $request->alamat;

        if ($request->hasFile('image')) {
            
            $request->file('image')->move('images/', $request->file('image')->getClientOriginalName());
            $user->image = $request->file('image')->getClientOriginalName();
        }

        $user->update();

        return response()->json([
            'status' => 'success',
            'data' => $user
        ]);
    }

    public function logout(Request $request)
    {
    	if (Auth::check()) {
    		Auth::user()->AauthAcessToken()->delete();
    	}

    	return response()->json([
    		'status' => 'success',
    		'message' => 'user has been logout'
    	]);
    }
}
