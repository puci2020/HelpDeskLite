<?php

namespace App\Repositories\Interfaces;

use App\Models\Ticket;

interface TicketRepositoryInterface
{
    public function create(array $data): Ticket;

    public function update(Ticket $ticket, array $data): Ticket;

    public function findById(int $id): ?Ticket;

    public function filter(array $filters);
}
