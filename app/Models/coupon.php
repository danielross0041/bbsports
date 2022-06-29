<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class coupon extends Model
{
    protected $primaryKey = 'id';
  	protected $table = 'coupon';
    protected $guarded = [];
}
