<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entrie extends Model
{
    //

    protected $fillable = ['operation','type', 'company','destination','time','person_name','person_id','person_occupation','vehicle','vehicle_plate','material_type','material_quantity','material_unit','user_id'];

    public function user()
    {
    	return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
