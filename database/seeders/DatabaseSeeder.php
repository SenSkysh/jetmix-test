<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Modules\User\Models\User;
use \App\Modules\Feedback\Models\Feedback;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Feedback::factory()->count(10)->create();
        User::factory()->create([
            'email' => 'test@example.com',
            'password' => 'test',
            'role' => 'manager',
        ]);
    }
}
