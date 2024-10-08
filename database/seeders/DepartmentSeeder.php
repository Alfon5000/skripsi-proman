<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = [
            [
                'name' => 'Administration',
            ],
            [
                'name' => 'Design',
            ],
            [
                'name' => 'Engineering',
            ],
            [
                'name' => 'Programming',
            ],
        ];

        foreach ($departments as $department) {
            Department::create($department);
        }
    }
}
