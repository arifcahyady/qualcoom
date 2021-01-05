<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Model\Sampah;

class Pengurus1 extends Model
{
    protected $table = 'pengurus1';

    protected $fillable = ['jenis_sampah_id','tanggal','keterangan','jenis_sampah','harga_satuan','berat','debit'];

    public function JenisSampah()
    {
    	return $this->hasOne(Sampah::class);
    }
}
