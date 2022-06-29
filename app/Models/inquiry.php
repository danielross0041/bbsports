<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class inquiry extends Model
{
 	protected $primaryKey = 'id';
  	protected $table = 'inquiry';
    protected $guarded = [];  

    public function user(){
    	return $this->belongsTo('App\Models\User', 'user_id' , 'id');
    }
}
