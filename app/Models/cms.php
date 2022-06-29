<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cms extends Model
{
    protected $primaryKey = 'id';
  	protected $table = 'cms';
    protected $guarded = [];  
}
