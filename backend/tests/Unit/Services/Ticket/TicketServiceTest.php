<?php

namespace Tests\Unit\Services\Ticket;

use App\Events\TicketStatusChanged;
use App\Models\Ticket;
use App\Repositories\Interfaces\TicketRepositoryInterface;
use App\Services\Ticket\TicketService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class TicketServiceTest extends TestCase
{
    public function test_create_adds_reporter_id_and_calls_repository()
    {
        Auth::shouldReceive('id')->andReturn(5);

        $input = [
            'title' => 'Test ticket',
            'status' => 'open',
        ];

        $expected = $input;
        $expected['reporter_id'] = 5;

        $ticket = new Ticket();
        $ticket->id = 1;

        $repo = $this->createMock(TicketRepositoryInterface::class);
        $repo->expects($this->once())
            ->method('create')
            ->with($expected)
            ->willReturn($ticket);

        $service = new TicketService($repo);

        $result = $service->create($input);

        $this->assertEquals(1, $result->id);
    }

    public function test_update_dispatches_ticket_status_changed_event()
    {
        Event::fake();

        $ticket = new Ticket();
        $ticket->id = 1;
        $ticket->status = 'open';

        $data = ['status' => 'closed'];

        $repo = $this->createMock(TicketRepositoryInterface::class);
        $repo->expects($this->once())
            ->method('update')
            ->with($ticket, $data)
            ->willReturn($ticket);

        $service = new TicketService($repo);

        $service->update($ticket, $data);

        Event::assertDispatched(TicketStatusChanged::class, function ($event) use ($ticket) {
            return $event->ticket === $ticket
                && $event->previousStatus === 'open'
                && $event->newStatus === 'closed';
        });
    }

    public function test_filter_calls_repository_and_returns_collection()
    {
        $filters = ['status' => 'open'];

        $collection = new Collection();

        $repo = $this->createMock(TicketRepositoryInterface::class);
        $repo->expects($this->once())
            ->method('filter')
            ->with($filters)
            ->willReturn($collection);

        $service = new TicketService($repo);

        $result = $service->filter($filters);

        $this->assertEquals($collection, $result);
    }
}
