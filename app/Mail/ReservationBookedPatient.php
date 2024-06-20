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

class ReservationBookedPatient extends Mailable
{
    use Queueable, SerializesModels;

    // protected $reservation_key;

    protected $reservation;

    protected $user;


    protected $employee;
    /**
     * Create a new message instance.
     */


    public function __construct($reservation, $user, $employee)
    {
        // $this->reservation_key = $reservation_key;
        // $this->reservation = Database::getOneWhere('reservations', 'reservation_key', $reservation_key);
        // $this->user = Auth::getUserData();
        // $this->employee = Auth::getUser($this->reservation['employee_uid']);

        // dd($reservation_key);

        $this->reservation = $reservation;
        $this->user = $user;
        $this->employee = $employee;
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
            'employee' => $this->employee,
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
            view: 'mail.resbooked_patient'
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
