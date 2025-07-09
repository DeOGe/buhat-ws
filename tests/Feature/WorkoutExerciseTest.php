<?php

use App\Models\User;
use App\Models\WorkoutExercise;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    // Ensure related record exists
    $this->user = User::factory()->create();
    $this->actingAs($this->user, 'sanctum');
});

it('can list workout exercises', function () {
    WorkoutExercise::factory()->count(3)->create();

    $response = $this->getJson('/api/workout-exercises');

    $response->assertOk()
        ->assertJsonCount(3, 'data');
});

it('can show a workout exercise', function () {
    $workoutExercise = WorkoutExercise::factory()->create();

    $response = $this->getJson('/api/workout-exercises/' . $workoutExercise->workout_exercise_id);

    $response->assertOk()
        ->assertJsonFragment([
            'workoutExerciseId' => $workoutExercise->workout_exercise_id,
        ]);
});

it('can create a workout exercise', function () {
    $workout = \App\Models\Workout::factory()->create();
    $exercise = \App\Models\Exercise::factory()->create();

    $data = [
        'workout_id' => $workout->workout_id,
        'exercise_id' => $exercise->exercise_id,
        'exercise_order' => 1,
    ];

    $response = $this->postJson('/api/workout-exercises', $data);

    $response->assertStatus(201)
        ->assertJsonFragment(['exerciseOrder' => 1]);
});

it('can update a workout exercise', function () {
    $workoutExercise = WorkoutExercise::factory()->create();

    $response = $this->putJson("/api/workout-exercises/{$workoutExercise->workout_exercise_id}", [
        'exercise_order' => 2,
    ]);

    $response->assertOk()
        ->assertJsonFragment(['exerciseOrder' => 2]);
});

it('can delete a workout exercise', function () {
    $workoutExercise = WorkoutExercise::factory()->create();

    $response = $this->deleteJson('/api/workout-exercises/' . $workoutExercise->workout_exercise_id);

    $response->assertNoContent();

    $this->assertDatabaseMissing('workout_exercises', [
        'workout_exercise_id' => $workoutExercise->workout_exercise_id,
    ]);
});
