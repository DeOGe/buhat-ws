<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EquipmentController;

Route::get('/equipment', [EquipmentController::class, 'index']);
Route::get('/equipment/{equipmentId}', [EquipmentController::class, 'show']);
