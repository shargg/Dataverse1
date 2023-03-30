<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            'technical_manager' => 'Technical Manager',
            'user_and_subscriber_manager' => 'User and Subscriber Manager',
            'questions_answers_manager' => 'Questions/Answers Manager',
            'content_manager' => 'Content Manager',
            'jurisprudence_legislation_manager' => 'Jurisprudence - Legislation Manager',
            'newsletter_and_news_manager' => 'Newsletter and News Manager',
        ];

        foreach ($roles as $key => $value) {
            Role::create([
                'name' => $value,
                'is_active' => 1,
            ]);
        }
    }
}

