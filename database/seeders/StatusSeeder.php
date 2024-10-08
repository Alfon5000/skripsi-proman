<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [
            [
                'name' => 'To Do',
            ],
            [
                'name' => 'In Progress',
            ],
            [
                'name' => 'In Review',
            ],
            [
                'name' => 'Done',
            ],
        ];

        foreach ($statuses as $status) {
            Status::create($status);
        }
    }
}
