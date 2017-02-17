<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Companie extends Model
{
    //
    protected $fillable = ['name','user_id'];

    public function user()
    {
    	return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
