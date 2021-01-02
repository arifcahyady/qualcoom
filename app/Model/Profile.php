<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Profile extends Model
{
    protected $table = 'profiles';

    protected $fillable = ['nomor_telepon','alamat','image'];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
