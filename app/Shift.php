<?php

namespace App;

use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Shift extends Model
{
    //
    use SoftDeletes;
    
    protected $softDelete = true;

    protected $fillable = ['description','start','end','user_id'];

    public function user()
    {
    	return $this->belongsTo(User::class, 'user_id', 'id');
    } 

    public function between($input)
    {
    	$f = DateTime::createFromFormat('H:i:s', $this->start);
		$t = DateTime::createFromFormat('H:i:s', $this->end);
		$i = DateTime::createFromFormat('H:i:s', $input);
		
    	if ($f > $t) $t->modify('+1 day');

		return ($f <= $i && $i <= $t) || ($f <= $i->modify('+1 day') && $i <= $t);
    }

    public function timeView($time)
    {
        return date("g:i A", strtotime($time));  
    }
     	 
}
