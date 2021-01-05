<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Sampah;
use App\Models\Pengurus1;
use App\Models\Tabungan;
use Carbon\Carbon;

class Pengurus1Controller extends Controller
{
    public function create(Request $request)
    {
    	$baru = Sampah::where('id', $request->jenis_sampah_id)->first();

    	$request->validate([
    		'jenis_sampah_id' => 'required',
    		'keterangan' => 'required|string',
    		'berat' => 'required|string'
    	]);

    	$pengurus = new Pengurus1;
    	$pengurus->jenis_sampah_id = $request->jenis_sampah_id;
    	$pengurus->date = Carbon::now();
    	$pengurus->keterangan = $request->keterangan;
    	$pengurus->jenis_sampah = $baru->jenis_sampah;
    	$pengurus->berat = $request->berat;

    	if ($request->keterangan == 'dijemput') {
    		$pengurus->harga_satuan = $baru->harga;
    	}else {
    		$pengurus->harga_satuan = $baru->harga * 20 / 100;
    	}
    	$pengurus->save();

    	$tabungan = new Tabungan;

    	$tabungan->debit = $pengurus->harga_satuan * $pengurus->berat;

    	return response()->json([
    		'status' => 'success',
    		'data' => $pengurus,
    		'tabungan' => $tabungan
    	]);
    }
}
