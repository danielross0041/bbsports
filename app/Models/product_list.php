<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product_list extends Model
{
    protected $primaryKey = 'id';
  	protected $table = 'product_list';
    protected $guarded = [];
}
