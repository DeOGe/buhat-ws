<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/my/profile', [UserController::class, 'show'])->name('profile.show');
    Route::put('/update/profile', [UserController::class, 'update'])->name('profile.update');
    // Add more routes here later if needed
});
