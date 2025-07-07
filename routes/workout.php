<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WorkoutController;

Route::apiResource('workouts', WorkoutController::class);
