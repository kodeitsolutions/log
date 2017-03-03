<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use SoftDeletes;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'telephone', 'password',
    ];

    //protected $dates = ['deleted_at'];
    protected $softDelete = true;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function isAdmin()
    {
        return $this->isAdmin;
    }

    public function operations()
    {
        return $this->hasMany(Operation::class);
    }

    public function categories()
    {
        return $this->hasMany(Categorie::class);
    }
        
    public function companies()
    {
        return $this->hasMany(Companie::class);
    }

    public function units()
    {
        return $this->hasMany(Unit::class);
    }        
        
    public function entries()
    {
        return $this->hasMany(Entrie::class);
    }
}
