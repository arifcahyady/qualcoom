<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\User;
use GuzzleHttp\Client;

class AuthController extends Controller
{
    public function index()
    {
        $user = User::all();

        return response()->json([
            'data' => $user
        ]);
    }

    public function login(Request $request)
    {
    	$request->validate([
    		'email' => 'required',
    		'password' => 'required|string'
    	]);

    	$credentials = request(['email', 'password']);

    	if (!Auth::attempt($credentials)) {
    		return response()->json([
    			'status' => 'error',
    			'message' => 'Unauthorizied'
    		], 401);
    	}

    	$user = $request->user();
    	$tokenResult = $user->createToken('Personal Access Token');
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
    		$user->role = 'nasabah';
            $user->nomor_telepon = $request->nomor_telepon;
            $user->alamat = $request->alamat;

            if ($request->hasFile('image')) {
            
           $image = base64_encode(file_get_contents($request->file('image')));

            $client = new \GuzzleHttp\Client();

            $response = $client->request('POST', 'https://freeimage.host/api/1/upload', [
                    'form_params' => [
                        'key' => '6d207e02198a847aa98d0a2a901485a5',
                        'action' => 'upload',
                        'source' => $image,
                        'format' => 'json'
                      ]
            ], 200);
            $body = $response->getBody();
            $response = json_decode($body);
            $image = $response->image->display_url;

            $user->image = $image;
            
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
            
          $image = base64_encode(file_get_contents($request->file('image')));

            $client = new \GuzzleHttp\Client();

            $response = $client->request('POST', 'https://freeimage.host/api/1/upload', [
                    'form_params' => [
                        'key' => '6d207e02198a847aa98d0a2a901485a5',
                        'action' => 'upload',
                        'source' => $image,
                        'format' => 'json'
                      ]
            ], 200);
            $body = $response->getBody();
            $response = json_decode($body);
            $image = $response->image->display_url;

            $user->image = $image;
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
