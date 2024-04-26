<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

use function Laravel\Prompts\text;

class ReservationBooked extends Mailable
{
    use Queueable, SerializesModels;

    protected $reservation_key;
    /**
     * Create a new message instance.
     */


    public function __construct($reservation_key)
    {
        $this->reservation_key = $reservation_key;
        // dd($reservation_key);
    }

    /**
     * Build the message.
     */
    public function build(): self
    {
        return $this;
    }
    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Reservation Booked',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        // return new Content(
        //     view: 'view.mail.reservation-booked',
        // );
        return new Content(
            view: 'mail.reservation-booked',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
