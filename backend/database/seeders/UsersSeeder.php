<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Tworzenie użytkowników
        $users = [
            [
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => 'password', // zostanie zahashowane
                'role' => 'admin'
            ],
            [
                'name' => 'Agent User',
                'email' => 'agent@example.com',
                'password' => 'password',
                'role' => 'agent'
            ],
            [
                'name' => 'Reporter User',
                'email' => 'reporter@example.com',
                'password' => 'password',
                'role' => 'reporter'
            ],
        ];

        foreach ($users as $userData) {
            $user = User::updateOrCreate([
                'email' => $userData['email']
            ],
                [
                'name' => $userData['name'],
                'email' => $userData['email'],
                'password' => Hash::make($userData['password']),
            ]);

            $user->assignRole($userData['role']);
        }

        $this->command->info('3 users with roles created successfully.');
    }
}
