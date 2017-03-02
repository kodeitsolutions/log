<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entrie extends Model
{
    //

    protected $fillable = ['operation', 'type', 'company', 'destination','time', 'date', 'person_name', 'person_id','person_occupation', 'person_company', 'vehicle', 'vehicle_plate', 'driver_name', 'driver_id', 'material_type','material_quantity', 'material_unit','user_id'];

    protected $guarded = ['']; //opposite from fillable
 
    protected $dates = ['date'];

    public function user()
    {
    	return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
