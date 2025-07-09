<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use App\Http\Requests\StoreExerciseRequest;
use App\Http\Requests\UpdateExerciseRequest;
use Illuminate\Http\JsonResponse;

class ExerciseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $exercises = Exercise::all();
        return response()->json(['data' => $exercises]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreExerciseRequest $request): JsonResponse
    {
        $exercise = Exercise::create($request->validated());
        return response()->json(['data' => $exercise], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Exercise $exercise): JsonResponse
    {
        return response()->json(['data' => $exercise]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateExerciseRequest $request, Exercise $exercise): JsonResponse
    {
        $exercise->update($request->validated());
        return response()->json(['data' => $exercise]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Exercise $exercise): JsonResponse
    {
        $exercise->delete();
        return response()->json(null, 204);
    }
}
