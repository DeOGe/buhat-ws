<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\GoogleController;

Route::get('/', function () {
    return response()->json([
        'message' => 'Welcome to the API',
        'status' => 'success'
    ]);
});

// Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle']);
// Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

// testing