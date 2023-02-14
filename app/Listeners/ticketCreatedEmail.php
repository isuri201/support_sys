<?php

namespace App\Listeners;

use App\Events\ticketEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Mail\TicketCreated as NewTicketMail;
use App\Models\Ticket;
use Illuminate\Support\Facades\Mail;

class ticketCreatedEmail
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Ticket $ticket)
    {
        $this->ticket = $ticket;
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\ticketEmail  $event
     * @return void
     */
    public function handle(ticketEmail $event)
    {
        if (isset($event->ticket->email)) {
            // send the new ticket notification to user
            Mail::to($event->ticket->email)->send(new NewticketMail($event->ticket));
        }
    }
}
