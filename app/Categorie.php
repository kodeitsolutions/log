<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categorie extends Model
{
    //
    use SoftDeletes;

    protected $softDelete = true;

    protected $fillable = ['name','user_id','description'];

    public function user()
    {
    	return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
