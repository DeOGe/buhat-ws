<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Workout;
use App\Models\User;
use Carbon\Carbon;

class WorkoutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first();

        if (!$user) {
            $this->command->warn('No user found. Please seed the users table first.');
            return;
        }

        Workout::create([
            'user_id' => $user->id,
            'workout_date' => Carbon::today(),
            'start_time' => '08:00:00',
            'end_time' => '09:00:00',
            'notes' => 'Leg day workout',
        ]);

        Workout::create([
            'user_id' => $user->id,
            'workout_date' => Carbon::yesterday(),
            'start_time' => '07:00:00',
            'end_time' => '08:00:00',
            'notes' => 'Upper body session',
        ]);
    }
}
