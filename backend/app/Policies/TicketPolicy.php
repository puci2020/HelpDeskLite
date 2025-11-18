<?php

namespace App\Policies;

use App\Models\Ticket;
use App\Models\User;

class TicketPolicy
{
    public function view(User $user, Ticket $ticket): bool
    {
        if ($user->hasAnyRole(['admin', 'agent'])) {
            return true;
        }

        return $ticket->reporter_id === $user->id || $ticket->assignee_id === $user->id;
    }

    public function update(User $user, Ticket $ticket): bool
    {
        if ($user->hasAnyRole(['admin', 'agent'])) {
            return true;
        }

        return $ticket->reporter_id === $user->id;
    }

    public function delete(User $user, Ticket $ticket): bool
    {
        if ($user->hasAnyRole(['admin', 'agent'])) {
            return true;
        }

        return $ticket->reporter_id === $user->id;
    }

    public function create(User $user): bool
    {
        return true; // każdy może tworzyć
    }
}
