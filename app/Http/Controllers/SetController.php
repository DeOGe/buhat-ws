<?php

namespace App\Http\Controllers;

use App\Models\Set;
use App\Http\Requests\StoreSetRequest;
use App\Http\Requests\UpdateSetRequest;
use App\Http\Resources\SetResource;

class SetController extends Controller
{
    public function index()
    {
        return SetResource::collection(Set::all());
    }

    public function store(StoreSetRequest $request)
    {
        $set = Set::create($request->validated());
        return new SetResource($set);
    }

    public function show(Set $set)
    {
        return new SetResource($set);
    }

    public function update(UpdateSetRequest $request, Set $set)
    {
        $set->update($request->validated());
        return new SetResource($set);
    }

    public function destroy(Set $set)
    {
        $set->delete();
        return response()->noContent();
    }
}
