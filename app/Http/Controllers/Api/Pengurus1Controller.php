<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Sampah;
use App\Models\Pengurus1;
use App\Models\Tabungan;
use Carbon\Carbon;
use App\User;

class Pengurus1Controller extends Controller
{
    public function index()
    {
    	$user = User::where('role', 'nasabah')->get();
    

    	return response()->json([
    		'status' => 'success',
    		'data' => $user
    	]);
	}
    public function create(Request $request,$id)
    {
    	$baru = Sampah::where('id', $request->jenis_sampah_id)->first();

    	$request->validate([
    		'jenis_sampah_id' => 'required',
    		'keterangan' => 'required|string',
    		'berat' => 'required|string'
    	]);

    	$pengurus = new Pengurus1;
    	$pengurus->jenis_sampah_id = $request->jenis_sampah_id;
    	$pengurus->tanggal = Carbon::now();
    	$pengurus->keterangan = $request->keterangan;
    	$pengurus->jenis_sampah = $baru->jenis_sampah;
    	$pengurus->berat = $request->berat;

    	if ($request->keterangan == 'dijemput') {
    		$pengurus->harga_satuan = $baru->harga;
    	}else {
    		$pengurus->harga_satuan = $baru->harga * 20 / 100;
    	}
    	// dd($pengurus);
    	$pengurus->save();

    	$tabungan = new Tabungan;
    	$tabungan->user_id = $id;
    	$tabungan->debit = $pengurus->harga_satuan * $pengurus->berat;
    	$tabungan->save();

    	return response()->json([
    		'status' => 'success',
    		'data' => $pengurus,
    		'tabungan' => $tabungan
    	]);
    }
}
