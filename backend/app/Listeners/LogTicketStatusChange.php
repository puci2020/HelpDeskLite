<?php

namespace App\Listeners;

use App\Events\TicketStatusChanged;
use App\Models\TicketStatusChange;

class LogTicketStatusChange
{
    public function handle(TicketStatusChanged $event)
    {
        TicketStatusChange::create([
            'ticket_id'  => $event->ticket->id,
            'previous_status' => $event->previousStatus,
            'new_status' => $event->newStatus,
            'changed_by' => auth()->id(),
        ]);
    }
}
