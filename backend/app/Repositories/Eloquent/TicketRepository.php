<?php

namespace App\Repositories\Eloquent;

use App\Models\Ticket;
use App\Repositories\Interfaces\TicketRepositoryInterface;

class TicketRepository implements TicketRepositoryInterface
{
    public function create(array $data): Ticket
    {
        $ticket = Ticket::create($data);

        if (isset($data['tags'])) {
            $ticket->tags()->sync($data['tags']);
        }

        return $ticket;
    }

    public function update(Ticket $ticket, array $data): Ticket
    {
        $ticket->update($data);

        if (isset($data['tags'])) {
            $ticket->tags()->sync($data['tags']);
        }

        return $ticket;
    }

    public function findById(int $id): ?Ticket
    {
        return Ticket::with(['reporter:id,name', 'assignee:id,name', 'tags:id,name', 'statusChanges'])->find($id);
    }

    public function filter(array $filters)
    {
        $query = Ticket::query()
            ->with('tags:name')
            ->when(!empty($filters['status'] ?? null), fn($q) =>
            $q->where('status', $filters['status'])
            )
            ->when(!empty($filters['priority'] ?? null), fn($q) =>
            $q->where('priority', $filters['priority'])
            )
            ->when(!empty($filters['assignee'] ?? null), fn($q) =>
            $q->where('assignee_id', $filters['assignee'])
            )
            ->when(!empty($filters['tags'] ?? null) && is_array($filters['tags']), fn($q) =>
            $q->whereHas('tags', fn($q2) =>
            $q2->whereIn('tags.id', $filters['tags'])
            )
            );

        // Ograniczenie widoczności dla reporterów
        if (!auth()->user()->hasAnyRole(['admin', 'agent'])) {
            $userId = auth()->id();
            $query->where(function($q) use ($userId) {
                $q->where('reporter_id', $userId)
                    ->orWhere('assignee_id', $userId);
            });
        }

        return $query->get();
    }

}
