<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Worker extends Model
{
    //
    use SoftDeletes;

    protected $softDelete = true;

    protected $fillable = ['name','worker_id','companie_id','department','position','user_id','status'];

    public function company()
    {
        return $this->belongsTo(Companie::class, 'companie_id', 'id');
    }

    public function user()
    {
    	return $this->belongsTo(User::class, 'user_id', 'id');
    } 

    public function hasEntry($type)
    {
        # code...   
        $operation = Operation::where('name','LIKE','%'.$type.'%')->first();
        $type = $operation->id;

        $entry = Entrie::whereDate('date',date('Y-m-d'))
                    ->where('companie_id',$this->companie_id)
                    ->where('person_id',$this->worker_id)
                    ->where('operation_id',$type)
                    ->get();
        //dd($entry);
        return ($entry->isEmpty()) ? false : true;
    }

    public function getEntry($type)
    {
        $operation = Operation::where('name','LIKE','%'.$type.'%')->first();
        $type = $operation->id;

        $entry = Entrie::whereDate('date',date('Y-m-d'))
                    ->where('companie_id',$this->companie_id)
                    ->where('person_id',$this->worker_id)
                    ->where('operation_id',$type)
                    ->first();

        return (empty($entry)) ? null : $entry->time;
    }
}
