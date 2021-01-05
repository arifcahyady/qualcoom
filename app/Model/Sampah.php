<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Models\Pengurus1;

class Sampah extends Model
{
    protected $table = 'jenis_sampah';

    protected $fillable = ['jenis_sampah','harga'];

    public function Pengurus1()
    {
    	return $this->hasMany(Pengurus1::class);
    }
}
