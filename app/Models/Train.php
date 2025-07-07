<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Train extends Model
{
    protected $fillable = ['name', 'type', 'seat_count'];
}
