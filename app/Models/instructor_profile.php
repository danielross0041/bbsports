<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class instructor_profile extends Model
{
    protected $primaryKey = 'id';
  	protected $table = 'instructor_profile';
    protected $guarded = [];
}
