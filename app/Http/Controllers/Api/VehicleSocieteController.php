<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\VehicleSociete;
use App\Http\Requests\VehicleSocieteRequest;
use App\Http\Resources\VehicleSocieteResource;

class VehicleSocieteController extends Controller
{
    /**
     * Liste tous les véhicules de la société.
     */
    public function index()
    {
        $vehicles = VehicleSociete::all();

        return VehicleSocieteResource::collection($vehicles);
    }

    /**
     * Crée un nouveau véhicule société.
     */
    public function store(VehicleSocieteRequest $request)
    {
        $vehicle = VehicleSociete::create($request->validated());

        return new VehicleSocieteResource($vehicle);
    }

    /**
     * Affiche un véhicule société spécifique.
     */
    public function show(VehicleSociete $vehiclessociete)
    {
        /* dd($vehicleSociete); */
        return new VehicleSocieteResource($vehiclessociete);
    }

    /**
     * Met à jour un véhicule société existant.
     */
    public function update(VehicleSocieteRequest $request, VehicleSociete $vehiclessociete)
    {
        $vehiclessociete->update($request->validated());

        return new VehicleSocieteResource($vehiclessociete);
    }

    /**
     * Supprime un véhicule société.
     */
    public function destroy(VehicleSociete $vehiclessociete)
    {
        $vehiclessociete->delete();

        return response()->json(['message' => 'Supprimé avec succès'], 204);
    }
}
