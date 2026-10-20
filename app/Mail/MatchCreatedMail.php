<?php

namespace App\Mail;

use App\Models\Booking;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class MatchCreatedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $booking;

    /**
     * Create a new message instance.
     */
    public function __construct(Booking $booking)
    {
        $this->booking = $booking;
    }

    /**
     * Email settings
     */
    public function envelope(): Envelope
{
    return new Envelope(
        subject: 'Înscrie-te la meci!',
    );
}

    /**
     * Email content
     */
    public function content(): Content
    {
        return new Content(
            view: 'mails.match-created',
        );
    }

    /**
     * Attachments
     */
    public function attachments(): array
    {
        return [];
    }
}