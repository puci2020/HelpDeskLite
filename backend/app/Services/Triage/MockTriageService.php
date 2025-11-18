<?php

namespace App\Services\Triage;

use App\Models\Ticket;
use App\Services\Triage\Interfaces\TriageServiceInterface;

class MockTriageService implements TriageServiceInterface
{

    public function suggest(Ticket $ticket): array
    {
        return [
            'priority' => 'high',
            'assignee_id' => 2,
        ];
    }
}
