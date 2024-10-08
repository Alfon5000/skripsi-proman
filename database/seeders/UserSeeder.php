<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Administrator',
                'email' => 'administrator@gmail.com',
                'password' => bcrypt('password'),
                'phone_number' => '081236665362',
                'email_verified_at' => now(),
                'role_id' => 1,
                'department_id' => random_int(1, 4),
                'position_id' => random_int(1, 4),
            ],
            [
                'name' => 'Alfonso Lai',
                'email' => 'alfonso@gmail.com',
                'password' => bcrypt('password'),
                'phone_number' => '081236665363',
                'email_verified_at' => now(),
                'role_id' => 2,
                'department_id' => random_int(1, 4),
                'position_id' => random_int(1, 4),
            ],
            [
                'name' => 'Alan Lie',
                'email' => 'alan@gmail.com',
                'password' => bcrypt('password'),
                'phone_number' => '081236665364',
                'email_verified_at' => now(),
                'role_id' => 2,
                'department_id' => random_int(1, 4),
                'position_id' => random_int(1, 4),
            ],
            [
                'name' => 'Andre Go',
                'email' => 'andre@gmail.com',
                'password' => bcrypt('password'),
                'phone_number' => '081236665365',
                'email_verified_at' => now(),
                'role_id' => 2,
                'department_id' => random_int(1, 4),
                'position_id' => random_int(1, 4),
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }

        User::factory(17)->create();
    }
}
