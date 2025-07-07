<?php

namespace App\Http\Controllers;

use App\Models\WorkoutExercise;
use App\Http\Requests\StoreWorkoutExerciseRequest;
use App\Http\Requests\UpdateWorkoutExerciseRequest;
use App\Http\Resources\WorkoutExerciseResource;

class WorkoutExerciseController extends Controller
{
    public function index()
    {
        return WorkoutExerciseResource::collection(WorkoutExercise::all());
    }

    public function store(StoreWorkoutExerciseRequest $request): WorkoutExerciseResource
    {
        $workoutExercise = WorkoutExercise::create($request->validated());
        return new WorkoutExerciseResource($workoutExercise);
    }

    public function show(WorkoutExercise $workoutExercise): WorkoutExerciseResource
    {
        return new WorkoutExerciseResource($workoutExercise);
    }

    public function update(UpdateWorkoutExerciseRequest $request, WorkoutExercise $workoutExercise): WorkoutExerciseResource
    {
        $workoutExercise->update($request->validated());
        return new WorkoutExerciseResource($workoutExercise);
    }

    public function destroy(WorkoutExercise $workoutExercise)
    {
        $workoutExercise->delete();
        return response()->noContent();
    }
}
