<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TicketStoreRequest;
use App\Http\Requests\TicketUpdateRequest;
use App\Services\Ticket\Interfaces\TicketServiceInterface;
use App\Services\Triage\Interfaces\TriageServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class TicketController extends Controller
{
    use AuthorizesRequests;

    public function __construct(
        private TicketServiceInterface $service,
        private TriageServiceInterface $triageService
    ) {}

    public function index(Request $request): JsonResponse
    {
        $filters = $request->only(['status', 'priority', 'assignee', 'tags']);
        $tickets = $this->service->filter($filters);

        return response()->json($tickets);
    }

    public function store(TicketStoreRequest $request): JsonResponse
    {
        $ticket = $this->service->create($request->validated(), auth()->id());

        return response()->json([
            'data' => $ticket,
            'message' => 'Ticket created successfully'
        ], 201);
    }

    public function show(int $id): JsonResponse
    {
        $ticket = $this->service->find($id);
        if (!$ticket) {
            return response()->json(['data' => null, 'message' => 'Ticket not found'], 404);
        }

        $this->authorize('view', $ticket);

        return response()->json($ticket);
    }

    public function update(TicketUpdateRequest $request, int $id): JsonResponse
    {
        $ticket = $this->service->find($id);
        if (!$ticket) {
            return response()->json(['data' => null, 'message' => 'Ticket not found'], 404);
        }

        $this->authorize('update', $ticket);

        $updated = $this->service->update($ticket, $request->validated());

        return response()->json([
            'data' => $updated,
            'message' => 'Ticket updated successfully'
        ]);
    }

    public function destroy(int $id): JsonResponse
    {
        $ticket = $this->service->find($id);
        if (!$ticket) {
            return response()->json(['data' => null, 'message' => 'Ticket not found'], 404);
        }

        $this->authorize('delete', $ticket);

        $this->service->delete($ticket);

        return response()->json([
            'data' => null,
            'message' => 'Ticket deleted successfully'
        ]);
    }

    public function suggestTriage(int $id): JsonResponse
    {
        $ticket = $this->service->find($id);
        $this->authorize('view', $ticket);

        $suggestion = $this->triageService->suggest($ticket);

        return response()->json($suggestion);
    }
}
