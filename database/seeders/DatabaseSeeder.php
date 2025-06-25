<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Pet;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $admin = User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin'),
            'birthdate' => '1990-01-01',
        ]);

        $user1 = User::factory()->create();
        $user2 = User::factory()->create();

        Pet::factory()->count(5)->create(['user_id' => $user1->id]);
        Pet::factory()->count(5)->create(['user_id' => $user2->id]);
    }
}
