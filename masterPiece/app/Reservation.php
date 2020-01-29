<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'booking_start_at', 'booking_end_at', 'car_id', 'renter_id', 'is_booking'
    ];

    public function post(){
        return $this->belongsTo('App\Post');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }
}
