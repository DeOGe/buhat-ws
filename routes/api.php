<?php

use App\Http\Controllers\MuscleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\Auth\GoogleController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::prefix('auth/google')->group(function () {
    Route::get('/redirect', [GoogleController::class, 'redirectToGoogle'])->name('google.redirect');
    Route::get('/callback', [GoogleController::class, 'handleGoogleCallback'])->name('google.callback');
});


Route::middleware('auth:sanctum')->group(function () {
    // Route::post('/auth/logout', [LoginController::class, 'logout'])->name('logout');

    require 'user.php';
    require 'muscle.php';
    // require 'exercise.php';
    // require 'category.php';
    require 'equipment.php';
    require 'set.php';
    require 'workout.php';
    require 'workoutexercise.php';
});
