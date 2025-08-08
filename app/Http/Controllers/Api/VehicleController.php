<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use App\Http\Resources\VehicleResource; 
use App\Http\Requests\VehicleRequest;

class VehicleController extends Controller
{
    public function index()
    {
        // Charge avec les relations utiles
        $vehicles = Vehicle::with(['typeVehicle', 'plannings.users', 'retrofits', 'retrofits.photo'])->get();
        return VehicleResource::collection($vehicles);
    }

    public function show(Vehicle $vehicle)
    {
        return new VehicleResource(
            $vehicle->load(['typeVehicle', 'retrofits', 'plannings.users'])
        );
    }

    public function store(VehicleRequest $request)
    {
        $vehicle = Vehicle::create($request->validated());
        return new VehicleResource($vehicle->load('typeVehicle'));
    }

    public function update(VehicleRequest $request, Vehicle $vehicle)
    {
        $vehicle->update($request->validated());
        return new VehicleResource($vehicle->load('typeVehicle'));
    }

    public function destroy(Vehicle $vehicle)
    {
        $vehicle->delete();
        return response()->json(null, 204);
    }
}
