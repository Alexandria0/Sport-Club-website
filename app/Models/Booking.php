<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ReservationTerrain;

class Booking extends Model
{
    protected $fillable = [
        'user_id',
        'reservation_id',

        'terrain_id',

        'date',
        'start_time',
        'end_time',

        'is_match',
        'people',
        'details'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

public function participants()
{
    return $this->hasMany(\App\Models\MatchParticipant::class);
}

public function organizer()
{
    return $this->belongsTo(\App\Models\User::class, 'user_id');
}

public function reservation()
{
    return $this->belongsTo(\App\Models\Reservation::class);
}
public function comments()
{
    return $this->hasMany(MatchComment::class, 'booking_id');
}
public function terrain()
{
    return $this->belongsTo(ReservationTerrain::class, 'terrain_id');
}
}