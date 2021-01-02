<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Model\Profile;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
    	if ($request->has('cari')) {
    		$data = User::with('profile')->where('name', 'LIKE', '%' . $request->cari . '%')->get();
    	}else {
    		$data = User::all();
    	}
    	return view('home.dashboard', compact('data'));
    }

    public function profile($id)
    {
    	$user = User::where('id', $id)->first();

    	return view('home.profile', compact('user'));
    }

    public function createPengurus(Request $request)
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
            $user->role = $request->role;
            $user->email = $request->email;
            $user->password = hash::make($request->password);
            $user->nomor_telepon = $request->nomor_telepon;
            $user->alamat = $request->alamat;

            if ($request->hasFile('image')) {
            
            $request->file('image')->move('images/', $request->file('image')->getClientOriginalName());
            $user->image = $request->file('image')->getClientOriginalName();
            
        }
        $user->save();
        return redirect('/dashboard')->with('sukses', 'Data berhasil di tambahkan');
    }

    public function updatePengurus($id)
    {
        $user = User::where('id', $id)->first();

        return view('home.edit', compact('user'));
    }

    public function editPengurus(Request $request,$id)
    {
        $user = User::where('id', $id)->first();
        $user->name = $request->name;
        $user->nomor_telepon = $request->nomor_telepon;
        $user->role = $request->role;
        $user->alamat = $request->alamat;

        if ($request->hasFile('image')) {
            
            $request->file('image')->move('images/', $request->file('image')->getClientOriginalName());
            $user->image = $request->file('image')->getClientOriginalName();
        }

        $user->update();

        return redirect('/dashboard')->with('sukses', 'Data berhasil di update');
    }

    public function deletePengurus($id)
    {
        $user = User::where('id', $id);
        $user->delete();

        return redirect('/dashboard');
    }
}
