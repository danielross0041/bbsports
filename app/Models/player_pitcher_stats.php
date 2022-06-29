<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class player_pitcher_stats extends Model
{
    protected $primaryKey = 'id';
  	protected $table = 'player_pitcher_stats';
    protected $guarded = [];
}
