<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Booking;
use App\Models\User;

class Ticket extends Model
{
    protected $fillable = [
        'booking_id', 'code', 'issued_at'
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function user()
    {
        return $this->booking ? $this->booking->user : null;
    }
}
