<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order_details extends Model
{
    protected $primaryKey = 'id';
  	protected $table = 'order_details';
    protected $guarded = [];
}