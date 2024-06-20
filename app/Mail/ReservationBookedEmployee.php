<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Http\Facades\Database;
use App\Http\Facades\Auth;

use function Laravel\Prompts\text;

class ReservationBookedEmployee extends Mailable
{
    use Queueable, SerializesModels;

    // protected $reservation_key;

    protected $reservation;

    protected $user;

    protected $patient;
    /**
     * Create a new message instance.
     */


    public function __construct($reservation, $user, $patient)
    {
        // $this->reservation_key = $reservation_key;
        // $this->reservation = Database::getOneWhere('reservations', 'reservation_key', $reservation_key);
        // $this->user = Auth::getUserData();
        // $this->patient = Auth::getUser($this->reservation['user_uid']);
        // dd($reservation_key);

        $this->reservation = $reservation;
        $this->user = $user;
        $this->patient = $patient;
    }

    /**
     * Build the message.
     */
    public function build(): self
    {
        return $this->with([
            // 'reservation_key' => $this->reservation_key,
            'reservation' => $this->reservation,
            'user' => $this->user,
            'patient' => $this->patient,
        ]);
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
            view: 'mail.resbooked_employee'
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
