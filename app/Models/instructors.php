<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class instructors extends Model
{
    protected $primaryKey = 'id';
  	protected $table = 'instructors';
    protected $guarded = [];
}
