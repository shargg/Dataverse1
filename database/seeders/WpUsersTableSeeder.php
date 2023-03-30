<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WpUsersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('wp_users')->insert([
            [
                'user_login' => 'admin',
                'user_pass' => bcrypt('password'),
                'user_nicename' => 'admin',
                'user_email' => 'admin@example.com',
                'user_url' => '',
                'user_activation_key' => '',
                'user_status' => 0,
                'display_name' => 'Admin'
            ],
            [
                'user_login' => 'user1',
                'user_pass' => bcrypt('password'),
                'user_nicename' => 'user1',
                'user_email' => 'user1@example.com',
                'user_url' => '',
                'user_activation_key' => '',
                'user_status' => 0,
                'display_name' => 'User 1'
            ],
            [
                'user_login' => 'user2',
                'user_pass' => bcrypt('password'),
                'user_nicename' => 'user2',
                'user_email' => 'user2@example.com',
                'user_url' => '',
                'user_activation_key' => '',
                'user_status' => 0,
                'display_name' => 'User 2'
            ]
        ]);
    }
}
