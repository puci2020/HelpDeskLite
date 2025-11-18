<?php

namespace App\Services\Ticket;

use App\Events\TicketStatusChanged;
use App\Models\Ticket;
use App\Repositories\Interfaces\TicketRepositoryInterface;
use App\Services\Ticket\Interfaces\TicketServiceInterface;
use Illuminate\Database\Eloquent\Collection;

class TicketService implements TicketServiceInterface
{
    public function __construct(
        private TicketRepositoryInterface $repository
    ) {}

    public function create(array $data): Ticket
    {
        $data['reporter_id'] = auth()->id();

        return $this->repository->create($data);
    }

    public function update(Ticket $ticket, array $data): Ticket
    {
        // log history zmian statusu
        if (isset($data['status']) && $data['status'] !== $ticket->status) {
            event(new TicketStatusChanged(
                ticket: $ticket,
                previousStatus: $ticket->status,
                newStatus: $data['status']
            ));
        }

        return $this->repository->update($ticket, $data);
    }

    public function filter(array $filters): Collection
    {
        return $this->repository->filter($filters);
    }

    public function find(int $id): ?Ticket
    {
        return $this->repository->findById($id);
    }

    public function delete(int $id): void
    {
        $ticket = $this->repository->findById($id);

        $ticket->tags()->forceDelete();
        $ticket->statusChanges()->forceDelete();

        $ticket->forceDelete();
    }
}
