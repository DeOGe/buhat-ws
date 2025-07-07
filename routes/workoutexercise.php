<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WorkoutExerciseController;

Route::apiResource('workout-exercises', WorkoutExerciseController::class);
