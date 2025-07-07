<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SetController;

Route::apiResource('sets', SetController::class);
