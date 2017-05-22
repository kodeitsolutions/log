<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Material extends Model
{
    use SoftDeletes;
    
    protected $softDelete = true;

    protected $fillable = ['code','name','user_id'];

    public function user()
    {
    	return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function entries()
    {
    	return $this->hasMany(Entrie::class);
    }
}
