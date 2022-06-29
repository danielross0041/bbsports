<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class payslip extends Model
{
    protected $table = 'payslip';
	public $primaryKey = 'id';
    protected $fillable = [
    	'is_active','is_deleted'
    ];

    public function user(){
    	return $this->belongsTo('App\Models\User', 'emp_id' , 'emp_id');
    }
}
