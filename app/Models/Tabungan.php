<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Pengurus1;

class Tabungan extends Model
{
    protected $table = 'tabungan';

    protected $fillable = ['debit','kredit','saldo','user_id'];

}
