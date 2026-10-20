<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Content;

class PasswordOtpMail extends Mailable
{
    use Queueable, SerializesModels;

    public $otp;

    public function __construct($otp)
    {
        $this->otp = $otp;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Cod resetare parolă',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'mails.password-otp',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}