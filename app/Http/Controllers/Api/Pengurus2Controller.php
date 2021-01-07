<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengurus2;
use App\Models\Kas;
use App\Model\Sampah;
use Carbon\Carbon;

class Pengurus2Controller extends Controller
{
    public function create(Request $request)
    {
    	$data = Sampah::where('id', $request->jenis_sampah_id)->first();

    	$request->validate([
    		'jenis_sampah_id' => 'required',
    		'nama' => 'required|min:3',
    		'phone' => 'min:10',
    		'berat' => 'required'
    	]);

    	$pengurus = new Pengurus2;
    	$pengurus->jenis_sampah_id = $request->jenis_sampah_id;
    	$pengurus->tanggal = Carbon::now();
    	$pengurus->nama = $request->nama;
    	$pengurus->phone = $request->phone;
    	$pengurus->jenis_sampah = $data->jenis_Sampah;
    	$pengurus->harga_satuan = $data->harga;
    	$pengurus->berat = $request->berat;

    	$pengurus->save();

    	$kas = new Kas;
    	$kas->debit = $pengurus->harga_satuan * $pengurus->berat + 2000;
    	$kas->save();

    	return response()->json([
    		'status' => 'succes',
    		'data' => $pengurus,
    		'debit' => $kas
    	]);
    }
}
