<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('password'), // or bcrypt('password')
            'google_id' => '1234567890',
            'avatar' => 'https://i.pravatar.cc/150?img=1',
            'weight' => 70, // in kg
            'height' => 175, // in cm
            'gender' => 'male',
            'date_of_birth' => Carbon::parse('1995-01-01'),
        ]);

        // Add more dummy users if needed
        User::factory()->count(5)->create(); // optional, uses UserFactory
    }
}
