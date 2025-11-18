<?php

namespace App\Events;

use App\Models\Ticket;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TicketStatusChanged
{
    use Dispatchable, SerializesModels;

    public Ticket $ticket;
    public string $previousStatus;
    public string $newStatus;

    public function __construct(Ticket $ticket, string $previousStatus, string $newStatus)
    {
        $this->ticket = $ticket;
        $this->previousStatus = $previousStatus;
        $this->newStatus = $newStatus;
    }
}
