<?php

namespace App\Services\Triage;

use App\Models\Ticket;
use App\Services\Triage\Interfaces\TriageServiceInterface;

class LlmTriageService implements TriageServiceInterface
{

    public function suggest(Ticket $ticket): array
    {
        // TODO: Implement suggest() method for real LLM.
    }
}
