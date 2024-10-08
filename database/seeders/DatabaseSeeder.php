<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            DepartmentSeeder::class,
            PositionSeeder::class,
            UserSeeder::class,
            CategorySeeder::class,
            ProjectSeeder::class,
            ProjectMemberSeeder::class,
            DocumentSeeder::class,
            ExpenditureSeeder::class,
            PrioritySeeder::class,
            StatusSeeder::class,
            DiscussionSeeder::class,
            CommentSeeder::class,
            EventSeeder::class,
            TaskSeeder::class,
        ]);
    }
}
