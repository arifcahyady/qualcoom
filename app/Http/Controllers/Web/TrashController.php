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

    public function update($id)
    {
        $trash = Sampah::where('id', $id)->first();

        return view('trash.edit', compact('trash'));
    }

    public function edit(Request $request, $id)
    {
        $trash = Sampah::where('id', $id)->first();
        $trash->jenis_sampah = $request->jenis_sampah;
        $trash->harga = $request->harga;
        $trash->save();

        return redirect('sampah');
    }

    public function delete($id)
    {
        $trash = Sampah::where('id', $id);
        $trash->delete();

        return redirect('sampah');
    }
}
