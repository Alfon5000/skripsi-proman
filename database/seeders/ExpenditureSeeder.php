<?php

namespace Database\Seeders;

use App\Models\Expenditure;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExpenditureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Expenditure::factory(100)->create();
    }
}
