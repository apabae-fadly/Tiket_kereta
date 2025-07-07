<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = [
        'train_id', 'date', 'departure_time', 'arrival_time', 'price'
    ];

    public function train()
    {
        return $this->belongsTo(Train::class);
    }
}
