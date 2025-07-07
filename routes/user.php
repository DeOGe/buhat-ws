<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/my/profile', [UserController::class, 'show'])->name('profile.show');
Route::put('/update/profile', [UserController::class, 'update'])->name('profile.update');
