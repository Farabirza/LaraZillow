<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'isAdmin' => true,
        ]);
        \App\Models\User::factory()->create([
            'name' => 'Second User',
            'email' => 'test2@example.com',
        ]);
        
        \App\Models\Listing::factory(20)->create([
            'user_id' => User::where('email', 'test@example.com')->first()->id,
        ]);
        \App\Models\Listing::factory(10)->create([
            'user_id' => User::where('email', 'test2@example.com')->first()->id,
        ]);
    }
}
