<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use App\Http\Requests\StoreEquipmentRequest;
use App\Http\Requests\UpdateEquipmentRequest;
use App\Http\Resources\EquipmentResource;

class EquipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return EquipmentResource::collection(Equipment::get());
    }

    /**
     * Display the specified resource.
     */
    public function show($equipmentId)
    {
        return new EquipmentResource(Equipment::findOrFail($equipmentId));
    }
}
