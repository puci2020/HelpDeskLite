<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    public function run(): void
    {
        $roles = ['admin', 'agent', 'reporter'];

        foreach ($roles as $role) {
            // Sprawdzenie, czy rola już istnieje, żeby uniknąć duplikatów
            if (!Role::where('name', $role)->exists()) {
                Role::create(['name' => $role]);
            }
        }

        $this->command->info('Roles seeded successfully.');
    }
}
