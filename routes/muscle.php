<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MuscleController;

Route::prefix('/muscle')->group(function () {
    Route::get('/', [MuscleController::class, 'index'])->name('muscle.index');
    Route::get('/{muscleId}', [MuscleController::class, 'show'])->name('muscle.show');
});
