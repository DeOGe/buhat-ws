<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use App\Http\Requests\StoreExerciseRequest;
use App\Http\Requests\UpdateExerciseRequest;
use App\Http\Resources\ExerciseResource;
use Illuminate\Http\JsonResponse;

class ExerciseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ExerciseResource::collection(Exercise::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreExerciseRequest $request): ExerciseResource
    {
        $exercise = Exercise::create($request->validated());
        return new ExerciseResource($exercise);
    }

    /**
     * Display the specified resource.
     */
    public function show(Exercise $exercise): ExerciseResource
    {
        return new ExerciseResource($exercise);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateExerciseRequest $request, Exercise $exercise): ExerciseResource
    {
        $exercise->update($request->validated());
        return new ExerciseResource($exercise);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Exercise $exercise): JsonResponse
    {
        $exercise->delete();
        return response()->json(['message' => 'Exercise deleted successfully.']);
    }
}
