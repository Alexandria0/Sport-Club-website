<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Booking;
use Carbon\Carbon;

class DeleteOldBookings extends Command
{
    protected $signature = 'bookings:delete-old';

    protected $description = 'Șterge rezervările și meciurile expirate';

    public function handle()
    {
        $now = Carbon::now();

        $bookings = Booking::all();

        foreach ($bookings as $booking) {

            $bookingDateTime = Carbon::parse(
                $booking->date . ' ' . $booking->end_time
            );

            // 🔥 dacă a trecut
            if ($bookingDateTime < $now) {

                // șterge participanți
                $booking->participants()->delete();

                // șterge comentarii
                $booking->comments()->delete();

                // șterge booking
                $booking->delete();
            }
        }

        $this->info('Rezervările expirate au fost șterse.');
    }
}