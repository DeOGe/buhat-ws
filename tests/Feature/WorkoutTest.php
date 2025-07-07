<?php

use App\Models\Workout;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Carbon\Carbon;

uses(RefreshDatabase::class);

it('can list workouts', function () {
    Workout::factory()->count(3)->create();

    $response = $this->getJson('/api/workouts');

    $response->assertOk()
        ->assertJsonCount(3, 'data');
});

it('can show a single workout', function () {
    $workout = Workout::factory()->create();

    $response = $this->getJson('/api/workouts/' . $workout->workout_id);

    $response->assertOk()
        ->assertJsonFragment(['workoutId' => $workout->workout_id]);
});

it('can create a workout', function () {
    $user = User::factory()->create();

    $data = [
        'user_id' => $user->id,
        'workout_date' => '2025-06-25',
        'start_time' => '08:00:00',
        'end_time' => '09:00:00',
        'notes' => 'Upper Body Day',
    ];

    $response = $this->postJson('/api/workouts', $data);

    $response->assertStatus(201)
        ->assertJsonFragment(['notes' => 'Upper Body Day']);
});

it('can update a workout', function () {
    $workout = Workout::factory()->create();

    $response = $this->putJson("/api/workouts/{$workout->workout_id}", [
        'user_id' => $workout->user_id,
        'workout_date' => Carbon::parse($workout->workout_date)->format('Y-m-d'),
        'start_time' => $workout->start_time,
        'end_time' => $workout->end_time,
        'notes' => 'Updated workout notes',
    ]);

    $response->assertOk()
        ->assertJsonFragment(['notes' => 'Updated workout notes']);
});

it('can delete a workout', function () {
    $workout = Workout::factory()->create();

    $response = $this->deleteJson('/api/workouts/' . $workout->workout_id);

    $response->assertNoContent();

    $this->assertDatabaseMissing('workouts', [
        'workout_id' => $workout->workout_id,
    ]);
});
