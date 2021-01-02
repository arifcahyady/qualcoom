<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Sampah extends Model
{
    protected $table = 'jenis_sampah';

    protected $fillable = ['jenis_sampah','harga'];
}
