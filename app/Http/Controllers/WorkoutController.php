<?php

namespace App\Http\Controllers;

use App\Models\Workout;
use App\Http\Requests\StoreWorkoutRequest;
use App\Http\Requests\UpdateWorkoutRequest;
use App\Http\Resources\WorkoutResource;

class WorkoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return WorkoutResource::collection(Workout::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreWorkoutRequest $request): WorkoutResource
    {
        $workout = Workout::create($request->validated());
        return new WorkoutResource($workout);
    }

    /**
     * Display the specified resource.
     */
    public function show(Workout $workout): WorkoutResource
    {
        return new WorkoutResource($workout);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateWorkoutRequest $request, Workout $workout): WorkoutResource
    {
        $workout->update($request->validated());
        return new WorkoutResource($workout);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Workout $workout)
    {
        $workout->delete();

        return response()->noContent();
    }
}
