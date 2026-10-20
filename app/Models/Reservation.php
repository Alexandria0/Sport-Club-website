<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
  use App\Models\ReservationImage;


class Reservation extends Model
{

protected $fillable = [
    'title',
    'sport',
    'sector', 
    'address',
    'details',
    'working_days',
    'start_time',
    'end_time',
    'background_image'
];

protected $casts = [
    'working_days' => 'array'
];

public function images()
{
    return $this->hasMany(ReservationImage::class);
}
public function bookings()
{
    return $this->hasMany(Booking::class);
}

public function terrains()
{
    return $this->hasMany(ReservationTerrain::class);
}
}
