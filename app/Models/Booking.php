<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Schedule;
use App\Models\Ticket;

class Booking extends Model
{
    protected $fillable = [
        'user_id', 'schedule_id', 'passenger_count', 'status', 'payment_status', 'payment_proof'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }

    public function ticket()
    {
        return $this->hasOne(Ticket::class);
    }
}
