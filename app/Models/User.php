<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'username',
        'email',
        'phone',
        'password',
        'role',
        'description',
        'bio',
        'avatar',
        'show_activity',
        'notify_matches'
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'show_activity' => 'boolean',
        'notify_matches' => 'boolean',
    ];

    /**
     * Verifică dacă utilizatorul este admin
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }
    public function bookings()
{
    return $this->hasMany(Booking::class);
}
public function matchParticipants()
{
    return $this->hasMany(MatchParticipant::class);
}
}