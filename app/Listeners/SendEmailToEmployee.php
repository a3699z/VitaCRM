<?php

namespace App\Listeners;

use App\Events\ReseverationBooked;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendEmailToEmployee
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ReseverationBooked $event): void
    {
        dd($event->reservation_key);
    }
}
