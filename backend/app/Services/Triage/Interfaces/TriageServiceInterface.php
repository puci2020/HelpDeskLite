<?php

namespace App\Services\Triage\Interfaces;

use App\Models\Ticket;

interface TriageServiceInterface
{
    public function suggest(Ticket $ticket): array;

}
