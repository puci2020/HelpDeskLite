<?php

namespace Feature\Http\Controllers\Api;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class TicketControllerTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->actingAs($this->user);
    }

    /** @test */
    public function index_returns_list_of_tickets(): void
    {
        $ticket1 = Ticket::factory()->create(['reporter_id' => $this->user->id, 'status' => 'open']);
        $ticket2 = Ticket::factory()->create(['reporter_id' => $this->user->id, 'status' => 'closed']);

        $response = $this->getJson('/api/tickets');

        $response->assertStatus(200)
            ->assertJsonCount(2)
            ->assertJsonFragment(['id' => $ticket1->id])
            ->assertJsonFragment(['id' => $ticket2->id]);
    }

    /** @test */
    public function store_creates_ticket()
    {
        $payload = [
            'title' => 'Test Ticket',
            'description' => 'Opis testowy',
            'status' => 'open',
            'priority' => 'low',
            'reporter_id' => \App\Models\User::factory()
        ];

        $response = $this->postJson('/api/tickets', $payload);

        $response->assertStatus(201)
            ->assertJsonFragment(['title' => 'Test Ticket'])
            ->assertJsonFragment(['message' => 'Ticket created successfully']);

        $this->assertDatabaseHas('tickets', [
            'title' => 'Test Ticket',
            'reporter_id' => $this->user->id
        ]);
    }
}
