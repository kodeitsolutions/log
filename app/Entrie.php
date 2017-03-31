<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Entrie extends Model
{
    //
    use SoftDeletes;

    protected $softDelete = true;

    protected $fillable = ['operation_id', 'categorie_id', 'companie_id', 'destination','time', 'date', 'person_name', 'person_id','person_occupation', 'person_company', 'vehicle', 'vehicle_plate', 'driver_name', 'driver_id', 'material_type','material_quantity', 'unit_id','user_id', 'material_observations', 'person_observations', 'vehicle_observations'];

    //protected $guarded = ['id','created_at','updated_at', 'deleted_at']; //opposite from fillable
 
    protected $dates = ['date'];

    protected $dateFormat = 'Y-m-d';

    private function getDateValue() {
        return date('d/m/Y', strtotime($this->attributes['date']));
      }
 
    private function setDateValue($value) {
        $date_parts = explode('/', $value);
        $this->attributes['date'] = $date_parts[2].'-'.$date_parts[1].'-'.$date_parts[0];
    }

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
}
