<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    //
    protected $fillable = ['code','name','user_id'];

    public function user()
    {
    	return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
