<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = [
            'Bug',
            'Feature Request',
            'Urgent',
            'Support',
            'UI',
            'Backend',
            'High Priority'
        ];

        foreach ($tags as $tagName) {
            Tag::firstOrCreate(['name' => $tagName]);
        }
    }
}
