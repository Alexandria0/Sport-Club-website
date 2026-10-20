<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReservationImage extends Model
{
    protected $fillable = [
        'reservation_id',
        'image'
    ];

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }
}