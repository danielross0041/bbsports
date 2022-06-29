<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    protected $primaryKey = 'id';
  	protected $table = 'category';
    protected $guarded = [];
}
