<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReservationTerrain extends Model
{
    protected $fillable = [
        'reservation_id',
        'terrain_type',
        'name',
        'price',
        'size',
    ];

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }
}
