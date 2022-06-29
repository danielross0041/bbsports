<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class leave_application extends Model
{
    use HasFactory;
    protected $table = 'leave_application';
    protected $primaryKey = 'id';
    protected $fillable = ['title', 'start_date', 'end_date'];

    public function designations()
    {
        return $this->belongsTo('App\Models\attributes', 'designation', 'id');
    }

    public function departments()
    {
        return $this->belongsTo('App\Models\attributes', 'department', 'id');
    }

    public function employee(){
    	return $this->belongsTo('App\Models\User', 'emp_id' , 'emp_id');
    }
    
    public function linemanager(){
    	return $this->belongsTo('App\Models\User', 'update_by' , 'emp_id');
    }
}
