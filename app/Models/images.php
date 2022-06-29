<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class images extends Model
{
    protected $primaryKey = 'id';
  	protected $table = 'images';
    protected $guarded = [];
}
