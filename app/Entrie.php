<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Entrie extends Model
{
    //
    use SoftDeletes;

    protected $softDelete = true;

    protected $fillable = ['operation_id', 'categorie_id', 'companie_id', 'destination','time', 'date', 'person_name', 'person_id','person_occupation', 'person_company', 'vehicle', 'vehicle_plate', 'driver_name', 'driver_id', 'material_type','material_quantity', 'unit_id','user_id', 'material_observations', 'person_observations', 'vehicle_observations', 'material_id'];

    //protected $guarded = ['id','created_at','updated_at', 'deleted_at']; //opposite from fillable
 
    //protected $dates = ['date'];

    public function user()
    {
    	return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function operation()
    {
        return $this->belongsTo(Operation::class, 'operation_id', 'id');
    }

    public function company()
    {
        return $this->belongsTo(Companie::class, 'companie_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(Categorie::class, 'categorie_id', 'id');
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id', 'id');
    }

    public function material()
    {
        return $this->belongsTo(Material::class, 'material_id', 'id');
    }

    public function getFormatDate($value)
    {   
        return date('Y-m-d', strtotime(str_replace('/', '-', $value)));
    }

    public function setFormatDate($value)
    {
        # code...
        $this->attributes['date'] = date('Y-m-d', strtotime(str_replace('/', '-', $value)));
    }

    public function getFormatTime($value)
    {
        return date("H:i", strtotime($value));
    }

    public function setFormatTime($value)
    {
        $this->attributes['time'] = date("H:i", strtotime($value));
    }

    public function dateView()
    {
        return date("d/m/y", strtotime($this->date));
    }

    public function timeView()
    {
        return date("g:i A", strtotime($this->time));
    }       
}
