<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Operation extends Model
{
    //
    use SoftDeletes;

    protected $softDelete = true;

	protected $fillable = ['name','user_id'];

    public function user()
    {
    	return $this->belongsTo(User::class, 'user_id', 'id');
    }    	

    public function entries()
    {
    	return $this->hasMany(Entrie::class,'operation_id');
    }
    
    public function getName()
    {
        return $this->name;
    }
}
