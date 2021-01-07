<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Model\Sampah;

class Pengurus2 extends Model
{
    protected $table = 'Pengurus2';

    protected $fillable = ['jenis_sampah_id','tanggal','nama','phone','jenis_sampah','harga_satuan','berat'];

    public function JenisSampah()
    {
    	return $this->belongsTo(Sampah::class);
    }
}
