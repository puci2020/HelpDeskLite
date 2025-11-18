<?php

namespace App\Services\Ticket\Interfaces;

use App\Models\Ticket;
use Illuminate\Database\Eloquent\Collection;

interface TicketServiceInterface
{
    public function create(array $data): Ticket;

    public function update(Ticket $ticket, array $data): Ticket;

    public function filter(array $filters): Collection;

    public function find(int $id): ?Ticket;

    public function delete(int $id): void;
}
