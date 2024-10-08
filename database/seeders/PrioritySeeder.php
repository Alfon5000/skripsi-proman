<?php

namespace Database\Seeders;

use App\Models\Priority;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PrioritySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $priorities = [
            [
                'name' => 'No Priority',
                'weight' => 1,
            ],
            [
                'name' => 'Low',
                'weight' => 2,
            ],
            [
                'name' => 'Medium',
                'weight' => 3,
            ],
            [
                'name' => 'High',
                'weight' => 4,
            ],
        ];

        foreach ($priorities as $priority) {
            Priority::create($priority);
        }
    }
}
