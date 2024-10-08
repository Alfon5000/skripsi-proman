<?php

namespace Database\Seeders;

use App\Models\Position;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $positions = [
            [
                'name' => 'Commisioner',
            ],
            [
                'name' => 'Director',
            ],
            [
                'name' => 'Manager',
            ],
            [
                'name' => 'Staff',
            ],
        ];

        foreach ($positions as $position) {
            Position::create($position);
        }
    }
}
