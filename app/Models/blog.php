<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class blog extends Model
{
    protected $primaryKey = 'id';
  	protected $table = 'blog';
    protected $guarded = [];
}
