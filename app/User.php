<?php

namespace App;

use Carbon\Carbon;
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
        'name','email','telephone','password','username','isGuard', 'isAdmin', 'shift'
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

    public function isGuard()
    {
        return $this->isGuard;
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

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function shifts()
    {
        return $this->hasMany(Shift::class);
    }

    public function workers()
    {
        return $this->hasMany(Worker::class);
    }

    public function validateShift()
    {
        if ($this->isGuard){
            $time = Carbon::now()->toTimeString();
            $shift = Shift::find($this->shift);
            return $shift->between($time);
        }
        return true;        
    }
}
