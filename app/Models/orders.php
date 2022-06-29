<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class orders extends Model
 {
    protected $primaryKey = 'id';
  	protected $table = 'orders';
    protected $guarded = [];


    public function order_details(){
    	return $this->belongsTo('App\Models\order_details', 'order_details_id' , 'id');
    }


    public function product(){
    	return $this->belongsTo('App\Models\product', '	product_id' , 'id');
    }
}