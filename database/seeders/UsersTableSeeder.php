<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            // You can add more users here
            [
                'name' => 'John Doe',
                'username' => 'john_doe',
                'password' => 'password123',
                'email' => 'john@example.com',
                'is_active' => 1,
            ],
        ];

        // Create additional random users
        for ($i = 1; $i <= 14; $i++) {
            $users[] = [
                'name' => 'User ' . $i,
                'username' => 'user_' . $i,
                'password' => 'password' . $i,
                'email' => 'user' . $i . '@example.com',
                'is_active' => 1,
            ];
        }

        foreach ($users as $user) {
            User::create([
                'name' => $user['name'],
                'username' => $user['username'],
                'password' => Hash::make($user['password']),
                'email' => $user['email'],
                'is_active' => $user['is_active'],
            ]);
        }
    }
}
