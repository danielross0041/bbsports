<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class videos extends Model
{
    protected $primaryKey = 'id';
  	protected $table = 'videos';
    protected $guarded = [];
}
