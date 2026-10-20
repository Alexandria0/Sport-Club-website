<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MatchComment extends Model
{
    protected $fillable = ['booking_id', 'user_id', 'comment'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function match()
    {
        return $this->belongsTo(Booking::class, 'booking_id');
    }
}