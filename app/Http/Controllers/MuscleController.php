<?php

namespace App\Http\Controllers;

use App\Models\Muscle;
use App\Http\Requests\StoreMuscleRequest;
use App\Http\Requests\UpdateMuscleRequest;
use App\Http\Resources\MuscleResource;

class MuscleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return MuscleResource::collection(Muscle::get());
    }

    /**
     * Display the specified resource.
     */
    public function show($muscleId)
    {
        return new MuscleResource(Muscle::findOrFail($muscleId));
    }
}
