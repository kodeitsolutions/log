<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Companie extends Model
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
    	return $this->hasMany(Entrie::class);
    }

    public function workers()
    {
        return $this->hasMany(Worker::class);
    }

    public function getName()
    {
        return $this->name;
    }
}
