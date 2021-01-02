<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Sampah;

class TrashController extends Controller
{
    public function index()
    {
    	$sampah = Sampah::all();
    	return view('trash.index', compact('sampah'));
    }

    public function create(Request $request)
    {
    	$request->validate([
    		'jenis_sampah' => 'required',
    		'harga' => 'required'
    	]);

    	$trash = new Sampah;
    	$trash->jenis_sampah = $request->jenis_sampah;
    	$trash->harga = $request->harga;
    	$trash->save();

    	return redirect('sampah');
    }
}
