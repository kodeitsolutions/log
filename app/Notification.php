<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notification extends Model
{
    //
    use SoftDeletes;

    protected $softDelete = true;

    protected $fillable = ['user_id', 'conditions','status'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function operation($id)
    {
        $operation = Operation::find($id);
        return $operation->getName();
    }

    public function category($id)
    {
        $category = Categorie::find($id);
        return $category->getName();
    }        

    public function company($id)
    {
        $company = Companie::find($id);
        return $company->getName();
    }

    public function material($id)
    {
        $material = Material::find($id);
        return $material->getName();
    }    

    public function conditions()
    {
        return json_decode($this->conditions, true);
    }  
}
