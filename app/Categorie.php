<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    //
    protected $fillable = ['name','user_id','description'];

    public function user()
    {
    	return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
