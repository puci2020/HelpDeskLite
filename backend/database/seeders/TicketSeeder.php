<?php

namespace Database\Seeders;

use App\Models\Tag;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();

        // Pobieramy przykładowe tagi
        $tags = Tag::all();

        $ticketsData = [
            [
                'title' => 'Cannot login to account',
                'description' => 'User reports that login is failing with correct credentials.',
                'priority' => 'high',
                'status' => 'open',
                'assignee_id' => $users->random()->id,
                'reporter_id' => $users->random()->id,
                'tags' => ['Bug', 'Urgent']
            ],
            [
                'title' => 'Add dark mode feature',
                'description' => 'Client requests dark mode for the dashboard.',
                'priority' => 'medium',
                'status' => 'open',
                'assignee_id' => $users->random()->id,
                'reporter_id' => $users->random()->id,
                'tags' => ['Feature Request', 'UI']
            ],
            [
                'title' => 'Server error on checkout',
                'description' => 'Checkout process fails with a 500 error intermittently.',
                'priority' => 'high',
                'status' => 'in_progress',
                'assignee_id' => $users->random()->id,
                'reporter_id' => $users->random()->id,
                'tags' => ['Bug', 'Backend', 'High Priority']
            ],
        ];

        foreach ($ticketsData as $data) {
            $ticket = Ticket::create([
                'title' => $data['title'],
                'description' => $data['description'],
                'priority' => $data['priority'],
                'status' => $data['status'],
                'assignee_id' => $data['assignee_id'],
                'reporter_id' => $data['reporter_id'],
            ]);

            // Przypisanie tagów
            $ticketTags = $tags->whereIn('name', $data['tags'])->pluck('id')->toArray();
            $ticket->tags()->attach($ticketTags);
        }
    }

}
