<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class new_feeds extends Model
{
    use HasFactory;
    protected $table = 'new_feeds';
    protected $primaryKey = 'id';
    protected $fillable = ['is_active', 'resp_data','is_deleted'];
}
